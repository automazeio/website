<?php tiny::layout()->default(title: 'Page not found', emptyLayout: true); ?>

<div class="flex flex-col items-center justify-center h-screen">
    <h2 class="text-2xl font-bold">404</h2>
    <?php if (@tiny::data()->error): ?>
        <div class="font-mono text-sm text-muted my-6">
            <?php echo tiny::data()->error; ?>
        </div>
    <?php else: ?>
        <div class="text-sm text-muted mt-6 mb-4">This page could not be <?php echo (tiny::user()->email) ? 'found' : 'accessed'; ?>.</div>
    <?php endif; ?>

    <?php if (tiny::user()->email): ?>
        <a href="<?php tiny::homeURL('/'); ?>" class="font-medium text-sm block w-fit mx-auto text-indigo-500 hover:text-indigo-500/80" role="button">
            <span>Back to dashboard ›</span>
        </a>
    <?php else: ?>
        <a href="<?php tiny::homeURL('/auth/login'); ?>" class="font-medium text-sm block w-fit mx-auto text-indigo-500 hover:text-indigo-500/80" role="button">
            <span>Please login to continue ›</span>
        </a>
    <?php endif; ?>

    <svg width="48" height="30" viewBox="0 0 48 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="mt-12 w-8">
        <path d="M24.0012 0C24.0012 0 35.0514 0 36.6799 0C38.3083 0 44.9245 2.03203 44.9245 9.41484C44.9245 16.7977 38.3083 18.6141 36.738 18.6141L48 30H37.5709L26.4043 18.75C26.4043 18.75 15.0446 18.75 14.3467 18.75C13.6488 18.75 11.2829 17.6227 11.2829 15.0398C11.2829 12.457 13.6488 11.25 14.3467 11.25C15.0446 11.25 35.3422 11.25 35.7493 11.25C36.1564 11.25 37.5337 10.8984 37.5337 9.41484C37.5337 7.93125 36.196 7.59844 35.7493 7.59844C35.3027 7.59844 15.0446 7.59844 14.3467 7.59844C13.6488 7.59844 7.5607 8.59453 7.5607 15.0398C7.5607 21.4852 13.6488 22.657 14.3467 22.657C15.0446 22.657 24.3897 22.657 24.3897 22.657L31.6386 29.9602C31.6386 29.9602 15.0446 29.9602 14.3467 29.9602C10.8339 29.9602 0 27.1102 0 15.0398C0 3.2625 10.8572 0 14.3467 0C16.0124 0 24.0012 0 24.0012 0Z" fill="#5667E7" />
    </svg>
</div>

<?php tiny::layout()->default('/'); ?>
