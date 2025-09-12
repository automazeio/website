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
        gtag('config', 'G-7NKW2LYNSQ', { 'anonymize_ip': true });
    </script>

    <!-- Twitter conversion tracking base code -->
    <script>
        !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
        },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
        a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
        twq('config','out85');
    </script>

    <!-- rb2b -->
    <script>!function () {var reb2b = window.reb2b = window.reb2b || [];if (reb2b.invoked) return;reb2b.invoked = true;reb2b.methods = ["identify", "collect"];reb2b.factory = function (method) {return function () {var args = Array.prototype.slice.call(arguments);args.unshift(method);reb2b.push(args);return reb2b;};};for (var i = 0; i < reb2b.methods.length; i++) {var key = reb2b.methods[i];reb2b[key] = reb2b.factory(key);}reb2b.load = function (key) {var script = document.createElement("script");script.type = "text/javascript";script.async = true;script.src = "https://s3-us-west-2.amazonaws.com/b2bjsstore/b/" + key + "/reb2b.js.gz";var first = document.getElementsByTagName("script")[0];first.parentNode.insertBefore(script, first);};reb2b.SNIPPET_VERSION = "1.0.1";reb2b.load("R6G5YHZ47765");}();</script>

    <!-- <script src="https://js.sentry-cdn.com/<?php echo $_SERVER['SENTRY_FRONTEND']; ?>.min.js" crossorigin="anonymous"></script> -->
<?php endif; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">

    <meta name="robots" content="<?php echo tiny::layout()->props('robots') ? strip_tags(tiny::layout()->props('robots')) : 'index, follow' ?>">

    <title>Automaze / <?php echo tiny::layout()->props('title') ? strip_tags(tiny::layout()->props('title')) : 'Technical Co-Founder &amp; CTO as a Service' ?></title>

    <link rel="stylesheet" type="text/css" href="<?php tiny::staticURL('/css/style.css'); ?>" media="all">

    <link href="<?php tiny::staticURL('/favicon.ico'); ?>" rel="icon" type="image/x-icon">
    <link href="<?php tiny::staticURL('/favicon.png'); ?>" rel="icon" type="image/png">
    <link rel="apple-touch-icon" sizes="512x512" href="<?php tiny::staticURL('/apple-touch-icon.png'); ?>">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Automaze">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#070914">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="https://automaze.io" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Automaze <?php echo tiny::layout()->props('title') ? strip_tags(tiny::layout()->props('title')) : 'Technical Co-Founder &amp; CTO as a Service' ?>" />
    <meta property="og:description" content="The zero-equity way for founders to bring their idea to life, attract early users, and achieve product-market fit." />
    <meta property="og:image" content="<?php tiny::layout()->props('ogImage') ?? tiny::staticURL('img/card.webp'); ?>" />

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta property="twitter:domain" content="automaze.io" />
    <meta property="twitter:site" content="@automazeio" />
    <meta property="twitter:creator" content="@aroussi" />
    <meta property="twitter:url" content="https://automaze.io" />
    <meta name="twitter:title" content="Automaze <?php echo tiny::layout()->props('title') ? strip_tags(tiny::layout()->props('title')) : 'Technical Co-Founder &amp; CTO as a Service' ?>" />
    <meta name="twitter:description" content="The zero-equity way for founders to bring their idea to life, attract early users, and achieve product-market fit." />
    <meta name="twitter:image" content="<?php tiny::layout()->props('ogImage') ?? tiny::staticURL('img/card.webp'); ?>" />
    <meta name="twitter:site" content="@automazeio" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <?php if (tiny::layout()->props('emptyLayout') === false): ?>
    <!-- <script src="<?php tiny::staticURL('/js/htmx.min.js'); ?>"></script> -->
    <?php endif; ?>

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

<body class="text-pretty antialiased bg-slate-50 <?php echo tiny::layout()->props('isHome') === true ? 'home' : ''; ?>">

<?php if (tiny::layout()->props('emptyLayout') === false) { ?>
<header class="main-nav">
    <nav hx-boost="true" hx-target="body" hx-swap="outerHTML">
        <div class="col-span-2 md:hidden">
          <a href="javascript:mobileMenu.open();" class="nav-logo"><img loading="lazy" src="<?php tiny::staticURL('img/logo-light.svg'); ?>" alt="Automaze logo" /></a>
        </div>
        <div class="col-span-2 hidden md:block">
          <a href="<?php tiny::homeURL(); ?>" class="nav-logo"><img loading="lazy" src="<?php tiny::staticURL('img/logo-light.svg'); ?>" alt="Automaze logo" /></a>
        </div>
        <ul class="col-span-8 flex items-center justify-center space-x-8">
            <li><a href="<?php tiny::homeURL('about'); ?>" class="hover:opacity-80 hover:border-b">About</a></li>
            <li><a href="<?php tiny::homeURL('services'); ?>" class="hover:opacity-80 hover:border-b">Services</a></li>
            <li><a href="https://secret.automaze.io" target="_blank" class="hover:opacity-80 hover:border-b">Perks</a></li>
            <li><a href="<?php tiny::homeURL('pricing'); ?>" class="hover:opacity-80 hover:border-b">Pricing</a></li>
        </ul>
        <div class="col-span-2 text-right">
            <a href="<?php tiny::homeURL('discovery-call'); ?>" class="nav-button">Book a Call</a>
        </div>
    </nav>
</header>
<?php } ?>
