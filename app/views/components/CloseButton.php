<?php
tiny::components()->register('CloseButton', function (...$props) {
    $props['onclick'] = $props['onclick'] ?? 'window.location=\'#\'';
    return <<<EOF
    <button role="figure" class="absolute right-4 top-4 opacity-60 hover:opacity-100 transition-opacity" @click="{$props['onclick']}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 m-1" viewBox="0 0 24 24" stroke-width="2"><path d="M6 18 18 6M6 6l12 12"/></svg>
    </button>
    EOF;
});
