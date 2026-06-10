<?php tiny::layout()->default(
    title: 'Book a Discovery Call',
    emptyLayout: true,
    robots: 'index, follow',
    ogImage: tiny::staticURL('/img/discovery-call-ogimage.webp', true)
);
?>
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
    <!-- iClosed inline widget begin -->
    <div class="iclosed-widget" data-url="https://app.iclosed.io/e/automazeio/intro" title="🤙 Intro call" style="width: 100%; height:620px; max-height:100%"></div>
    <script type="text/javascript" src="https://app.iclosed.io/assets/widget.js" async></script>
    <!-- iClosed inline widget end -->
</div>

<?php tiny::layout()->default('/'); ?>
