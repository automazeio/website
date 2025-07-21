<?php
tiny::components()->register('ValidationAlert', function (...$props) {
    $class = $props['class'] ?? '';
    $content = '<p class="mt-1 mb-2">Errors occurred while saving data:</p>';
    $props['content'] = is_array($props['content']) ? $props['content'] : [$props['content']];
    if ($props['content']) {
        $content .= '<ul class="ml-1.5 mb-2 *:mb-0"><li>' . implode('</li><li>', $props['content']) . '</li></ul>';
    }
    return "<div class=\"alert danger {$class}\">{$content}</div>";
});
