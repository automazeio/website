<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Basic Meta Tags -->
    <title><?php echo htmlspecialchars($props['meta']['title'] ?? $props['title'] ?? 'PHP React SPA Demo'); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($props['meta']['description'] ?? $props['message'] ?? $props['content'] ?? 'A modern SPA built with PHP and React'); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo htmlspecialchars($props['meta']['og_title'] ?? $props['meta']['title'] ?? $props['title'] ?? 'PHP React SPA Demo'); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($props['meta']['og_description'] ?? $props['meta']['description'] ?? $props['message'] ?? 'A modern SPA built with PHP and React'); ?>">
    <?php if (isset($props['meta']['og_image'])): ?>
    <meta property="og:image" content="<?php echo htmlspecialchars($props['meta']['og_image']); ?>">
    <?php endif; ?>
    <meta property="og:url" content="<?php echo htmlspecialchars($props['meta']['url'] ?? 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>">

    <!-- Twitter -->
    <meta name="twitter:card" content="<?php echo htmlspecialchars($props['meta']['twitter_card'] ?? 'summary_large_image'); ?>">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($props['meta']['twitter_title'] ?? $props['meta']['title'] ?? $props['title'] ?? 'PHP React SPA Demo'); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($props['meta']['twitter_description'] ?? $props['meta']['description'] ?? $props['message'] ?? 'A modern SPA built with PHP and React'); ?>">
    <?php if (isset($props['meta']['twitter_image'])): ?>
    <meta name="twitter:image" content="<?php echo htmlspecialchars($props['meta']['twitter_image']); ?>">
    <?php endif; ?>

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="<?php echo tiny::staticURL('css/style.css'); ?>"> -->

    <!-- React App -->
    <script id="page-data" type="application/json">
        <?php echo $params; ?>
    </script>
</head>
<body>
    <div id="app"><?php echo $renderedHTML; ?></div>
    <script src="<?php echo tiny::staticURL('app/app.js'); ?>"></script>
</body>
</html>
