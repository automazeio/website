<div class="scroll-snap relative -mt-24 -mb-0">
    <div class="relative max-w-5xl xl:max-w-6xl 2xl:max-w-7xl mx-auto">
        <div class="flex gap-3 absolute left-7 lg:left-auto lg:right-7 top-4 z-10 " aria-label="Services carousel controls">
            <button id="services-prev" type="button" class="size-10 cursor-pointer rounded-full border-[1.5px] border-slate-300 bg-white text-lg leading-none text-slate-500 transition-all duration-300 hover:border-slate-400 hover:shadow-md">←</button>
            <button id="services-next" type="button" class="size-10 cursor-pointer rounded-full border-[1.5px] border-slate-300 bg-white text-lg leading-none text-slate-500 transition-all duration-300 hover:border-slate-400 hover:shadow-md">→</button>
        </div>
    </div>

    <div class="bleed-wrapper no-scrollbar" id="services-scroller"
        hx-boost="true" hx-target="body" hx-swap="outerHTML">
        <!-- spacer -->
        <div class="scroll-snap-spacer"></div>

        <?php tiny::render('home/services-blocks'); ?>

        <!-- spacer -->
        <div class="scroll-snap-spacer"></div>
    </div>
</div>
