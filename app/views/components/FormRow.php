<?php
tiny::components()->register('FormRow', function (...$props) {

    $class = $props['class'] ?? '';
    $labelClass = $props['labelClass'] ?? '';
    $extra = $props['extra'] ?? '';
    $label = $props['label'] ?? '';
    $labelFor = $props['labelFor'] ?? '';
    $helpText = $props['helpText'] ?? '';
    $input = $props['input'] ?? '';
    $required = $props['required'] ?? '';

    $return = '<div class="form-row ' . $class . '" ' . $extra . '>';
    if ($labelFor) {
        $return .= '<label for="' . $labelFor . '" class="' . $labelClass . '">';
    } else {
        $return .= '<div role="label" class="' . $labelClass . '">';
    }
    $return .= $label;
    if ($required) {
        $return .= ' <span class="text-red-500">*</span>';
    }
    if ($helpText) {
        $return .= '<div class="input-help-text">' . $helpText . '</div>';
    }
    if ($labelFor) {
        $return .= '</label>';
    } else {
        $return .= '</div>';
    }
    $return .= '<div class="relative">' . tiny::trim($input) . '</div></div>';
    return $return;
});
