<!DOCTYPE html>
<html lang="en" class="relative min-h-full overscroll-none"  style="scroll-behavior: smooth">
    <head>
<?php if (@$_SERVER['ENV'] != 'local' && @$_SERVER['SENTRY_FRONTEND']): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7NKW2LYNSQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag("js", new Date());
        gtag('config', 'G-7NKW2LYNSQ');
    </script>
    <!-- <script src="https://js.sentry-cdn.com/<?php echo $_SERVER['SENTRY_FRONTEND']; ?>.min.js" crossorigin="anonymous"></script> -->
<?php endif; ?>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover" />
        <title>MUXI (by Automaze) AI Agents</title>

        <link href="<?php tiny::staticURL('/favicon.ico'); ?>" rel="icon" type="image/x-icon">
        <link href="<?php tiny::staticURL('/favicon.png'); ?>" rel="icon" type="image/png">
        <link rel="apple-touch-icon" sizes="512x512" href="<?php tiny::staticURL('/apple-touch-icon.png'); ?>">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="Automaze">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="theme-color" content="#070914">

        <?php if (@$_SERVER['ENV'] != 'local' && @$_SERVER['SENTRY_FRONTEND']): ?>
        <script src="https://js.sentry-cdn.com/<?php echo $_SERVER['SENTRY_FRONTEND']; ?>.min.js" crossorigin="anonymous"></script>
        <?php endif; ?>
        <meta name="description" content="The zero-equity way for founders to bring their idea to life, attract early users, and achieve product-market fit." />

        <!-- Facebook Meta Tags -->
        <meta property="og:url" content="https://automaze.io" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="MUXI (by Automaze) AI Agents" />
        <meta property="og:description" content="Tailor-made AI agents for founders, built around your business and workflow." />
        <meta property="og:image" content="<?php tiny::staticURL('img/muxi-card.webp'); ?>" />

        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta property="twitter:domain" content="automaze.io" />
        <meta property="twitter:site" content="@automazeio" />
        <meta property="twitter:creator" content="@aroussi" />
        <meta property="twitter:url" content="https://automaze.io" />
        <meta name="twitter:title" content="MUXI (by Automaze) AI Agents" />
        <meta name="twitter:description" content="Tailor-made AI agents for founders, built around your business and workflow." />
        <meta name="twitter:image" content="<?php tiny::staticURL('img/muxi-card.webp'); ?>" />
        <meta name="twitter:site" content="@automazeio" />

        <link rel="dns-prefetch" href="https://forms.automaze.io/" />
        <style>
            .heyform__loading-container {
                display: none !important;
            }
        </style>
    </head>

    <body style="background: #000;">

    <div
        data-heyform-id="pVXDEPcn"
        data-heyform-type="fullpage"
        data-heyform-custom-url="https://forms.automaze.io/form/"
        data-heyform-transparent-background="false"
    ></div>
    <script src="<?php tiny::staticURL('js/heyform.min.js'); ?>"></script>
</body>
</html>
