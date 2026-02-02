<?php tiny::layout()->default(title: 'Services', emptyLayout: false); ?>

<div id="main-content" class="relative z-10 bg-gradient-to-b from-indigo-50/5 via-white to-white min-h-screen ">
    <main x-class="mx-8 relative">
        <section class="pt-16">
            <div class="max-w-3xl mx-auto text-center px-6">
                <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-slate-900">
                    Our Services
                </h1>
                <p class="mt-6 text-lg text-slate-600 leading-relaxed max-w-2xl mx-auto">
                    Pick one or combine them all.
                    <strong>Our one-stop-shop approach gets you planning, development, design, automation, and infrastructure under one roof. </strong>
                    No juggling vendors, no gaps.
                </p>
            </div>

            <section id="services-grid" class="-mt-10">
                <div class="grid! grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 2xl:gap-8 sm:px-10! xl:px-8! py-0!">
                    <?php tiny::render('home/services-blocks'); ?>
                    <!-- spacer -->
                    <div class="scroll-snap-spacer"></div>
                </div>
            </section>
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
