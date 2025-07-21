<?php
tiny::components()->register('AlertBox', function (...$props) {
    $class = $props['class'] ?? '';
    $level = $props['level'] ?? '';
    $return = "<div class=\"alert {$level} {$class}\">";
    $return .= addslashes($props['content'] ?? '');
    $return .= "</div>";
    return $return;
});
