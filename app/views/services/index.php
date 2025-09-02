<?php tiny::layout()->default(title: 'Services', emptyLayout: false); ?>

<div id="main-content" class="relative z-10 bg-gradient-to-b via-indigo-50/5 from-white to-white min-h-screen ">
    <main x-class="mx-8 relative">
        <section class="pt-16">
            <div class="mask-scroll-snap">
                content
            </div>
            <?php tiny::render('home/services-slider'); ?>
        </section>

        <section>
        <h3 class="home-grid-header mt-0 mb-16 text-center">
            <span>Let's talk</span>
        </h3>
        <?php tiny::render('home/cta'); ?>
        </section>
    </main>
</div>


<?php tiny::layout()->default('/'); ?>
