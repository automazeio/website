<?php tiny::layout()->default(title: 'About Us', emptyLayout: false); ?>

<div id="main-content" class="relative z-10 bg-[#0d1226] min-h-screen">
    <main x-class="mx-8 relative">
        <section class="pt-16">
            <div>
              <div class="bg-black relative aspect-video max-w-5xl mx-auto">
                <iframe class="w-full h-full" width="560" height="315" src="https://www.youtube-nocookie.com/embed/2Bk8JLvPGE4?si=dnkPJ-YQr5D1Etbx&rel=0" title="Automaze - Pre-Call Introduction" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </section>

    </main>
</div>

<style>
  main:before, main:after, footer:before {
    display: none !important;
  }
</style>
<?php tiny::layout()->default('/'); ?>
