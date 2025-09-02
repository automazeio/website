<?php tiny::layout()->default(title: 'Managed Developers', emptyLayout: false); ?>

<div id="main-content" class="relative z-10 bg-gradient-to-b from-indigo-50/5 via-white to-white min-h-screen ">
    <main x-class="mx-8 relative">
        <section class="pt-16">
            <div>
                content
            </div>
        </section>

        <section>
            <h3 class="home-grid-header mt-24 mb-16 text-center">
                <span>Let's talk</span>
            </h3>
            <?php tiny::render('home/cta'); ?>
        </section>
    </main>
</div>


<?php tiny::layout()->default('/'); ?>
