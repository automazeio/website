<?php
tiny::components()->register('SVG', function (...$props) {
    $props['class'] = $props['class'] ?? '';
    $props['stroke'] = $props['stroke'] ?? 'currentColor';
    $props['stroke-width'] = $props['stroke-width'] ?? 0;
    $props['fill'] = $props['fill'] ?? 'currentColor';
    $file = file_get_contents(dirname(__FILE__) . '/../..' . $props['file']);
    $file = explode('<svg ', $file);
    return "<svg class=\"{$props['class']}\" stroke=\"{$props['stroke']}\" stroke-width=\"{$props['stroke-width']}\" fill=\"{$props['fill']}\" {$file[1]}";
});
