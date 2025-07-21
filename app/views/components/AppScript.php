<?php
tiny::components()->register('AppScript', function (...$props) {
    $inline = $props['inline'] ?? false;
    if ($inline) {
        $source = tiny::config()->app_path . 'html/' . tiny::config()->static_dir . '/js/app-' . ($props['script'] ?? $props[0]) . '.min.js';
        $source = file_get_contents($source);
        return '<script>' . $source . '</script>';
    }
    return '<script src="' . tiny::getStaticURL('js/app-' . ($props['script'] ?? $props[0]) . '.min.js') . '"></script>';
});
