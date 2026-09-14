<?php

/**
 * Technical Co-Founder & CTO as a Service landing page.
 *
 * Content-only page: every CTA points at /discovery-call, so there is no
 * form handling here. Per the page spec this stays unlisted (no sitemap
 * entry, noindex in the view) until the service's launch checklist is done.
 */
class ServicesCtoAsAService extends TinyController
{
    public function get($request, $response)
    {
        $response->render('services/cto-as-a-service');
    }
}
