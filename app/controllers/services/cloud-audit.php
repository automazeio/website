<?php

/**
 * Cloud cost reduction landing page + qualify form.
 *
 * The form posts back to this controller (no JS required). Every accepted lead is
 * sent to three places, in this order of importance:
 *
 *  1. iClosed (APP_ICLOSED_API_KEY) - upserted as a contact, with a note recording
 *     that the lead came from this page.
 *  2. APP_LEAD_WEBHOOK_URL - Slack incoming webhook, Zapier catch hook, etc.
 *  3. The error log - fallback, so a misconfigured or failing integration can
 *     never silently drop a lead.
 *
 * All of it runs after the response is flushed (see deliverAfterResponse), so a
 * slow third party is never visible to the person filling in the form.
 */
class ServicesCloudAudit extends TinyController
{
    /**
     * Minimum monthly spend for a free audit. Referenced in the hero, the form,
     * and the closing CTA - change it here and in app/views/services/cloud-audit.php together.
     */
    public const MIN_SPEND = '$5,000';

    private const SPEND_OPTIONS = [
        'under-5k' => 'Under $5,000',
        '5k-10k' => '$5,000-$10,000',
        '10k-50k' => '$10,000-$50,000',
        '50k-plus' => '$50,000+',
    ];

    private const PROVIDER_OPTIONS = [
        'aws' => 'AWS',
        'gcp' => 'Google Cloud',
        'azure' => 'Azure',
        'multiple' => 'Multiple',
        'other' => 'Other',
    ];

    private const US_COMPANY_OPTIONS = [
        'yes' => 'Yes',
        'no' => 'No',
    ];

    private const MIGRATION_OPTIONS = [
        'yes' => 'Yes',
        'no' => 'No',
        'unsure' => 'Not sure',
    ];

    /** Spend bracket that falls below the free-audit threshold. */
    private const BELOW_THRESHOLD = 'under-5k';

    private const UTM_FIELDS = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'];

    /** iClosed public API (https://api-docs-iclosed.redocly.app). */
    private const ICLOSED_API_BASE = 'https://public.api.iclosed.io/v1';

    /** Per-request budget. Generous because this runs after the response is sent. */
    private const ICLOSED_TIMEOUT = 8;

    /** Tag applied to every contact this form creates, so they stay segmentable. */
    private const ICLOSED_TAG = 'cloud-audit';

    /** Where a qualified lead's details wait between the POST and the redirect. */
    private const BOOKING_SESSION_KEY = 'cloud_audit_booking';

    /**
     * Field caps from the OpenAPI schema. Sending a longer value is a 400, and the
     * form allows up to 160 characters per field, so everything is trimmed to fit.
     */
    private const ICLOSED_LIMITS = [
        'firstName' => 25,
        'lastName' => 25,
        'email' => 255,
        'tag' => 100,
        'utm' => 1000,
        'country' => 2,
        'ipAddress' => 45,
        'referrerUrl' => 500,
        'note' => 10000,
    ];

    public function get($request, $response)
    {
        $query = $request->query;

        // Tiny passes $_GET through JSON_NUMERIC_CHECK, so "1" arrives as int 1.
        // Cast before comparing or these flags never match.
        $this->shareFormState(
            values: $this->emptyValues(),
            errors: [],
            tracking: $this->trackingFromQuery($query),
            sent: (string)($query['sent'] ?? '') === '1',
            below: (string)($query['below'] ?? '') === '1'
        );

        $response->render('services/cloud-audit');
    }

    public function post($request, $response)
    {
        $body = $request->body(true);
        $values = $this->sanitizeValues($body);
        $tracking = $this->trackingFromBody($body);

        // Honeypot: a real browser never fills a hidden field. Bots get a success
        // page so they stop retrying, but nothing is forwarded.
        if (trim((string)($body['company_website'] ?? '')) !== '') {
            return $response->redirect('/services/cloud-audit?sent=1#qualify');
        }

        if (!$this->withinRateLimit()) {
            return $this->renderWithErrors($response, $values, $tracking, [
                'form' => 'Too many submissions from this connection. Email hello@automaze.io and we\'ll pick it up from there.',
            ]);
        }

        $errors = $this->validate($values);
        if ($errors !== []) {
            return $this->renderWithErrors($response, $values, $tracking, $errors);
        }

        $this->deliverAfterResponse($values, $tracking);
        $this->rememberForBooking($values);

        $below = $values['monthly_spend'] === self::BELOW_THRESHOLD ? '&below=1' : '';

        return $response->redirect('/services/cloud-audit?sent=1' . $below . '#qualify');
    }

    /**
     * Below the threshold we still capture the lead, so only the email is required.
     */
    private function validate(array $values): array
    {
        $errors = [];
        $belowThreshold = $values['monthly_spend'] === self::BELOW_THRESHOLD;

        if (!isset(self::SPEND_OPTIONS[$values['monthly_spend']])) {
            $errors['monthly_spend'] = 'Pick your current monthly cloud spend.';
        }

        if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'We need a valid work email to send the audit to.';
        }

        if ($belowThreshold) {
            return $errors;
        }

        if (!isset(self::PROVIDER_OPTIONS[$values['provider']])) {
            $errors['provider'] = 'Pick your current provider.';
        }

        if (!isset(self::US_COMPANY_OPTIONS[$values['us_company']])) {
            $errors['us_company'] = 'Let us know if you\'re a US company.';
        }

        if (!isset(self::MIGRATION_OPTIONS[$values['open_to_migration']])) {
            $errors['open_to_migration'] = 'Let us know how you feel about changing provider.';
        }

        if ($values['full_name'] === '') {
            $errors['full_name'] = 'Tell us your name.';
        }

        if ($values['company'] === '') {
            $errors['company'] = 'Tell us the company or project name.';
        }

        return $errors;
    }

    /**
     * Runs every outbound integration after the redirect has been flushed to the
     * browser, so neither the webhook nor iClosed can add latency to the form.
     *
     * Under PHP-FPM fastcgi_finish_request() closes the response first; on any other
     * SAPI the work simply happens at shutdown, exactly as it did before.
     */
    private function deliverAfterResponse(array $values, array $tracking): void
    {
        register_shutdown_function(function () use ($values, $tracking): void {
            // The framework's minifying output buffer is still open here, and
            // fastcgi_finish_request() discards whatever is left in a user-level
            // buffer - so close them first or the response body never arrives.
            while (ob_get_level() > 0) {
                @ob_end_flush();
            }
            flush();

            if (function_exists('fastcgi_finish_request')) {
                @fastcgi_finish_request();
            }

            $this->deliver($values, $tracking);
            $this->syncToIClosed($values, $tracking);
        });
    }

    /**
     * Upserts the lead as an iClosed contact, then attaches a note saying it came
     * from this page. Failures are logged and swallowed - deliver() has already
     * recorded the lead by the time this runs, so nothing is lost.
     */
    private function syncToIClosed(array $values, array $tracking): void
    {
        $key = trim((string)($_SERVER['APP_ICLOSED_API_KEY'] ?? ''));
        if ($key === '') {
            return;
        }

        try {
            $contactId = $this->createIClosedContact($values, $tracking, $key);
            if ($contactId === null) {
                return;
            }

            $this->createIClosedNote($contactId, $values, $tracking, $key);
        } catch (\Throwable $e) {
            error_log('[cloud-audit-iclosed] unexpected failure: ' . $e->getMessage());
        }
    }

    /**
     * POST /v1/contacts upserts on email, so a repeat submitter updates their
     * existing contact instead of creating a duplicate.
     *
     * Deliberately does not send `status`: POTENTIAL/QUALIFIED/DISQUALIFIED are
     * pipeline states owned by whoever works the leads, and guessing at them from
     * a spend bracket would overwrite real sales judgement. The tag and the note
     * carry the qualification signal instead.
     */
    private function createIClosedContact(array $values, array $tracking, string $key): ?int
    {
        [$firstName, $lastName] = $this->splitName($values['full_name']);

        // Empty strings fail schema validation, so only send fields we actually have.
        $payload = array_filter([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $this->capped('email', $values['email']),
            'tag' => self::ICLOSED_TAG,
            'utm' => $this->utmQuery($tracking),
            'referrerUrl' => $this->httpUrl($tracking['referrer'] ?? ''),
            'ipAddress' => $this->capped('ipAddress', $this->clientIp()),
            'country' => $this->capped('country', (string)($_SERVER['HTTP_CF_IPCOUNTRY'] ?? '')),
        ], static fn ($value): bool => $value !== '' && $value !== null);

        $result = $this->iclosedPost('/contacts', $payload, $key);

        if (!$this->iclosedSucceeded($result)) {
            error_log('[cloud-audit-iclosed] contact upsert failed: ' . $this->iclosedError($result)
                . ' | email: ' . $values['email']);

            return null;
        }

        $contactId = $result->json->data->contact->id ?? null;

        if (!is_numeric($contactId)) {
            error_log('[cloud-audit-iclosed] contact upsert returned no id: ' . $this->iclosedError($result));

            return null;
        }

        return (int)$contactId;
    }

    private function createIClosedNote(int $contactId, array $values, array $tracking, string $key): void
    {
        $payload = [
            'contactId' => $contactId,
            'note' => $this->iclosedNote($values, $tracking),
        ];

        // The help centre article calls this /contacts/createContactNote, but that
        // path 404s - /contacts/notes is the one in the OpenAPI spec and the one the
        // live API accepts.
        $result = $this->iclosedPost('/contacts/notes', $payload, $key);

        if (!$this->iclosedSucceeded($result)) {
            error_log('[cloud-audit-iclosed] note failed for contact ' . $contactId . ': ' . $this->iclosedError($result));
        }
    }

    private function iclosedPost(string $path, array $payload, string $key): object
    {
        // The API requires the token to carry the iclosed_ prefix; tolerate a key
        // that was stored without it rather than failing every request with a 401.
        $token = str_starts_with($key, 'iclosed_') ? $key : 'iclosed_' . $key;

        return tiny::http()->postJSON(self::ICLOSED_API_BASE . $path, $payload, [
            'timeout' => self::ICLOSED_TIMEOUT,
            'headers' => [
                'Authorization: Bearer ' . $token,
                'Accept: application/json',
            ],
        ]);
    }

    /** The note body: provenance first, then the same summary the webhook gets. */
    private function iclosedNote(array $values, array $tracking): string
    {
        $belowThreshold = $values['monthly_spend'] === self::BELOW_THRESHOLD;

        $lines = [
            'Came from the cloud cost audit page (/services/cloud-audit).',
            '',
            $this->summary($values, $belowThreshold),
        ];

        if ($belowThreshold) {
            $lines[] = '';
            $lines[] = 'Below the ' . self::MIN_SPEND . '/mo threshold for a free audit.';
        }

        $utm = $this->utmQuery($tracking);
        if ($utm !== '') {
            $lines[] = '';
            $lines[] = 'Tracking: ' . $utm;
        }

        // iClosed stores notes as rich text (it wraps them in quill-output-html and
        // normalises tags), so plain newlines would collapse into one run-on
        // paragraph. Escape the submitted values first, then add the line breaks.
        // The plain text is capped before escaping because escaping can multiply the
        // length up to six times over, and truncating finished markup could slice a
        // tag or an entity in half.
        $plain = mb_substr(implode("\n", $lines), 0, intdiv(self::ICLOSED_LIMITS['note'], 6));

        return nl2br(htmlspecialchars($plain, ENT_QUOTES, 'UTF-8'), false);
    }

    /** `success` only means cURL worked, so the status code has to be checked too. */
    private function iclosedSucceeded(object $result): bool
    {
        $status = (int)($result->status_code ?? 0);

        return ($result->success ?? false) && $status >= 200 && $status < 300;
    }

    private function iclosedError(object $result): string
    {
        $status = (int)($result->status_code ?? 0);
        $message = $result->json->message ?? $result->error ?? '';

        if (!is_string($message)) {
            $message = json_encode($message, JSON_UNESCAPED_SLASHES);
        }

        return 'HTTP ' . $status . ($message !== '' ? ' - ' . mb_substr((string)$message, 0, 300) : '');
    }

    /** iClosed wants first and last name separately; the form asks for one field. */
    private function splitName(string $fullName): array
    {
        $parts = preg_split('/\s+/', trim($fullName), 2) ?: [];

        return [
            $this->capped('firstName', $parts[0] ?? ''),
            $this->capped('lastName', $parts[1] ?? ''),
        ];
    }

    private function utmQuery(array $tracking): string
    {
        $utm = [];
        foreach (self::UTM_FIELDS as $field) {
            if (($tracking[$field] ?? '') !== '') {
                $utm[$field] = $tracking[$field];
            }
        }

        return $utm === [] ? '' : $this->capped('utm', http_build_query($utm));
    }

    private function httpUrl(string $url): string
    {
        $url = trim($url);

        // The field is typed as a URI, so send it only when it really is one.
        if ($url === '' || !filter_var($url, FILTER_VALIDATE_URL)) {
            return '';
        }

        return $this->capped('referrerUrl', $url);
    }

    private function clientIp(): string
    {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '';

        // X-Forwarded-For can be a chain; the client is the first entry.
        return trim(explode(',', (string)$ip)[0]);
    }

    private function capped(string $field, string $value): string
    {
        return mb_substr(trim($value), 0, self::ICLOSED_LIMITS[$field]);
    }

    private function deliver(array $values, array $tracking): void
    {
        $belowThreshold = $values['monthly_spend'] === self::BELOW_THRESHOLD;

        $payload = [
            // Slack incoming webhooks render `text` and ignore everything else;
            // Zapier-style catch hooks keep the structured fields.
            'text' => $this->summary($values, $belowThreshold),
            'source' => 'cloud-audit',
            'lead_type' => $belowThreshold ? 'below_threshold' : 'qualified',
            'full_name' => $values['full_name'],
            'email' => $values['email'],
            'company' => $values['company'],
            'monthly_spend' => self::SPEND_OPTIONS[$values['monthly_spend']] ?? $values['monthly_spend'],
            'provider' => self::PROVIDER_OPTIONS[$values['provider']] ?? '',
            'us_company' => self::US_COMPANY_OPTIONS[$values['us_company']] ?? '',
            'open_to_migration' => self::MIGRATION_OPTIONS[$values['open_to_migration']] ?? '',
            'tracking' => array_filter($tracking),
            'submitted_at' => gmdate('c'),
            'ip' => $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent' => mb_substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
        ];

        $webhook = $_SERVER['APP_LEAD_WEBHOOK_URL'] ?? '';
        $delivered = false;

        if (is_string($webhook) && str_starts_with($webhook, 'http')) {
            try {
                // Short timeout: a slow or dead webhook must not hold up the form response.
                $result = tiny::http()->postJSON($webhook, $payload, ['timeout' => 3]);
                $delivered = $result->success && $result->status_code >= 200 && $result->status_code < 300;
            } catch (\Throwable $e) {
                $delivered = false;
            }
        }

        if (!$delivered) {
            error_log('[cloud-audit-lead] ' . json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }
    }

    private function summary(array $values, bool $belowThreshold): string
    {
        $lines = [
            ($belowThreshold ? '⚠️ Below threshold' : '💰 Cloud audit request') . ' - ' . ($values['company'] ?: 'no company given'),
            'Contact: ' . ($values['full_name'] ?: 'no name given'),
            'Email: ' . $values['email'],
            'Spend: ' . (self::SPEND_OPTIONS[$values['monthly_spend']] ?? 'unknown') . '/mo',
        ];

        if (!$belowThreshold) {
            $lines[] = 'Provider: ' . (self::PROVIDER_OPTIONS[$values['provider']] ?? 'unknown');
            $lines[] = 'US company: ' . (self::US_COMPANY_OPTIONS[$values['us_company']] ?? 'unknown');
            $lines[] = 'Open to moving: ' . (self::MIGRATION_OPTIONS[$values['open_to_migration']] ?? 'unknown');
        }

        return implode("\n", $lines);
    }

    private function renderWithErrors($response, array $values, array $tracking, array $errors): void
    {
        $this->shareFormState($values, $errors, $tracking, false, false);
        $response->render('services/cloud-audit');
    }

    private function shareFormState(array $values, array $errors, array $tracking, bool $sent, bool $below): void
    {
        tiny::data()->form = (object)[
            'values' => $values,
            'errors' => $errors,
            'tracking' => $tracking,
            'sent' => $sent,
            'below' => $below,
            // Only ever non-null for a lead who actually qualified in this session,
            // so a hand-typed ?sent=1 cannot conjure up the booking widget.
            'booking' => $this->bookingDetails(),
        ];

        tiny::data()->options = (object)[
            // Shared with the view so it never has to name this class - the route
            // (and therefore the class name) has moved once already.
            'minSpend' => self::MIN_SPEND,
            'spend' => self::SPEND_OPTIONS,
            'provider' => self::PROVIDER_OPTIONS,
            'usCompany' => self::US_COMPANY_OPTIONS,
            'migration' => self::MIGRATION_OPTIONS,
            'belowThreshold' => self::BELOW_THRESHOLD,
        ];
    }

    /**
     * The redirect deliberately drops the submitted values, but the booking widget
     * shown to qualified leads needs them to prefill itself. They travel in the
     * session rather than the query string, which keeps a name and an email out of
     * the URL, the browser history, and any referrer header sent to Cal.
     *
     * Not tiny::flash() on purpose: that helper round-trips the payload through a
     * cookie and unserialize()s whatever comes back, which is not a route a lead's
     * personal details should take.
     */
    private function rememberForBooking(array $values): void
    {
        // Below the threshold there is no call to book, and a stale entry from an
        // earlier qualified submission would wrongly reopen the widget.
        if ($values['monthly_spend'] === self::BELOW_THRESHOLD) {
            unset($_SESSION[self::BOOKING_SESSION_KEY]);

            return;
        }

        $_SESSION[self::BOOKING_SESSION_KEY] = [
            'name' => $values['full_name'],
            'email' => $values['email'],
            'company' => $values['company'],
        ];
    }

    /**
     * Read without consuming, so refreshing the confirmation or coming back to it
     * later in the same session still offers the booking widget.
     */
    private function bookingDetails(): ?array
    {
        $booking = $_SESSION[self::BOOKING_SESSION_KEY] ?? null;

        return is_array($booking) ? $booking : null;
    }

    private function emptyValues(): array
    {
        // Grouped the way the form asks for them: step 1 qualifies, step 2 collects contact.
        return [
            'monthly_spend' => '',
            'provider' => '',
            'us_company' => '',
            'open_to_migration' => '',
            'full_name' => '',
            'email' => '',
            'company' => '',
        ];
    }

    private function sanitizeValues(array $body): array
    {
        $values = $this->emptyValues();

        foreach (array_keys($values) as $field) {
            $values[$field] = $this->clean($body[$field] ?? '', 160);
        }

        return $values;
    }

    private function trackingFromQuery(array $query): array
    {
        $tracking = [];
        foreach (self::UTM_FIELDS as $field) {
            $tracking[$field] = $this->clean($query[$field] ?? '', 96);
        }
        $tracking['referrer'] = $this->clean($_SERVER['HTTP_REFERER'] ?? '', 255);

        return $tracking;
    }

    private function trackingFromBody(array $body): array
    {
        $tracking = [];
        foreach ([...self::UTM_FIELDS, 'referrer'] as $field) {
            $tracking[$field] = $this->clean($body[$field] ?? '', 255);
        }

        return $tracking;
    }

    private function clean(mixed $value, int $maxLength): string
    {
        // Scalars, not just strings: JSON_NUMERIC_CHECK in the framework turns any
        // numeric-looking submitted value into an int or float before we see it.
        if (!is_scalar($value)) {
            return '';
        }

        $value = preg_replace('/[\x00-\x1F\x7F]/u', '', (string)$value) ?? '';

        return mb_substr(trim($value), 0, $maxLength);
    }

    private function withinRateLimit(): bool
    {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';

        try {
            tiny::helpers(['ratelimiter']);
            $limiter = tiny::rateLimiter('cloud-audit-form', 5, 600);
            $limiter->add(15, 86400);

            return $limiter->check((string)$ip);
        } catch (\Throwable $e) {
            // No cache backend (or it's disabled) - never block a lead over rate limiting.
            return true;
        }
    }
}
