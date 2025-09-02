<?php tiny::layout()->default(title: 'Pricing', emptyLayout: false); ?>

<div id="main-content" class="relative z-10 bg-white min-h-screen">
    <main x-class="mx-8 relative">
        <section class="pt-16">
            <div>
                asdas
            </div>
        </section>

        <?php tiny::render('home/faq'); ?>

        <section>
            <h3 class="home-grid-header mt-24 mb-16 text-center">
                <span>Let's talk</span>
            </h3>
            <?php tiny::render('home/cta'); ?>
        </section>
    </main>
</div>


<?php tiny::layout()->default('/'); ?>
