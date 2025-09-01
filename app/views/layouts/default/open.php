<?php
echo '<!-- v. '. $_SERVER['APP_VERSION'] ." -->\n";
?>
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">

    <title>Automaze / <?php echo tiny::layout()->props('title') ? strip_tags(tiny::layout()->props('title')) : 'Technical Co-Founder & CTO as a Service' ?></title>

    <link rel="stylesheet" type="text/css" href="<?php tiny::staticURL('/css/style.css'); ?>" media="all">

    <link href="<?php tiny::staticURL('/favicon.ico'); ?>" rel="icon" type="image/x-icon">
    <link href="<?php tiny::staticURL('/favicon.png'); ?>" rel="icon" type="image/png">
    <link rel="apple-touch-icon" sizes="512x512" href="<?php tiny::staticURL('/apple-touch-icon.png'); ?>">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Automaze">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#070914">

    <script src="<?php tiny::staticURL('/js/htmx.min.js'); ?>"></script>

<?php if (tiny::layout()->props('scripts')):
        foreach (tiny::layout()->props('scripts') as $script): ?>
    <script src="<?php tiny::staticURL('/js/' . $script); ?>.min.js"></script>
    <?php endforeach;
    endif; ?>
<?php if (tiny::layout()->props('styles')):
        foreach (tiny::layout()->props('styles') as $style): ?>
    <link rel="stylesheet" href="<?php tiny::staticURL('/css/' . $style); ?>.min.css">
    <?php endforeach;
    endif; ?>
</head>

<body class="text-pretty antialiased bg-slate-50">

