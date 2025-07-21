<?php
tiny::components()->register('FormErrors', function (...$props) {
    $props['errors'] = $props['errors'] ?? [];
    $return = '<div x-auto-animate>';
    if (!empty($props['errors'])) {
        $return .= '<template x-if="invalids == 0">';
        $return .= tiny::components()->return('ValidationAlert', content: $props['errors']);
        $return .= '</template><script> onDocReady(() => { $("form .alert")[0].scrollIntoView(true); }, 100); </script>';
    } else {
        $return .= '<script> onDocReady(() => { window.scrollTo(0, 0); if ($("#website")) { setTimeout(() => { $("#website").focus(); $("#website").blur(); }, 10); } }); </script>';
    }
    $return .= '<template x-if="invalids > 0">';
    $return .= tiny::components()->return('AlertBox', level: "danger", content: "⚠️ Please fill out all the required fields (marked in red).");
    $return .= '</template>';
    $return .= '</div>';
    return $return;
});
