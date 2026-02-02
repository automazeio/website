<?php tiny::layout()->default(title: 'Book a Discovery Call', emptyLayout: true, robots: 'noindex, follow'); ?>
<style>
    html, body {
        background: #0a0e1e !important;
    }
    .heyform__loading-container {
        display: none !important;
    }
</style>
    <div
        data-heyform-id="8o0CZUoz"
        data-heyform-type="fullpage"
        data-heyform-custom-url="https://forms.automaze.io/form/"
        data-heyform-transparent-background="false"

        data-heyform-width-type="%"
        data-heyform-width="100"
        data-heyform-height-type="%"
        data-heyform-height="100"
        data-heyform-auto-resize-height="true"

    ></div>
    <script src="<?php tiny::staticURL('js/heyform.min.js'); ?>"></script>

    <a href="/" type="button" style="z-index: 2147483647" class="
        fixed top-4 right-4 flex items-center justify-center size-10 cursor-pointer rounded-full border-[1.5px] border-white/20 bg-white/10 text-lg leading-none text-white opacity-60 hover:opacity-100 hover:scale-110 transition-all duration-hover:shadow-md
    " onclick="history.length > 1 ? history.back() : location.href='/'">✕</a>
<?php tiny::layout()->default('/'); ?>
