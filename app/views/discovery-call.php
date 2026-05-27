<?php tiny::layout()->default(title: 'Book a Discovery Call', emptyLayout: true, robots: 'noindex, follow'); ?>
<style>
    html, body {
        height: 100%;
    }
    body:before, body:after {
        display: none !important;
    }
    /* .heyform__loading-container {
        display: none !important;
    } */
</style>
<div class="flex flex-col items-center justify-center h-full">
    <div class="bg-black rounded-full border size-20 shrink-0 hidden md:block" style="padding:0.75rem; margin-bottom:1rem"><img loading="lazy" src="<?php tiny::staticURL('img/logo-light.svg'); ?>" alt="Automaze logo" /></div>
    <!-- iClosed inline widget begin -->
    <div class="iclosed-widget" data-url="https://app.iclosed.io/e/automazeio/intro" title="🤙 Intro call" style="width: 100%; height:620px; max-height:100%"></div>
    <script type="text/javascript" src="https://app.iclosed.io/assets/widget.js" async></script>
    <!-- iClosed inline widget end -->

    <p class="hidden md:block">&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;</p>
</div>

<?php tiny::layout()->default('/'); ?>
