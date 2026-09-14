<?php
tiny::layout()->default(
    title: 'Cloud cost reduction',
    pageTitle: 'Cloud cost reduction - Automaze',
    description: 'We audit your cloud infrastructure, cut the bill, and get paid from the savings. Free audit for companies spending $5,000+ per month.',
    canonical: 'https://automaze.io/services/cloud-audit',
    emptyLayout: false,
    robots: 'index, follow'
);

$form = tiny::data()->form;
$options = tiny::data()->options;
$values = $form->values;
$errors = $form->errors;
$minSpend = $options->minSpend;

// Card recipe lifted from .timeline-card, minus the timeline connector dots.
$card = 'relative rounded-lg border border-dashed border-indigo-100 bg-gradient-to-b from-white via-white to-[#fdfdff] shadow ring-4 ring-indigo-50/50 transition-all duration-500 hover:-translate-y-1 hover:shadow-xl hover:ring-indigo-50';
$eyebrow = 'font-mono text-[11px] font-medium tracking-[0.18em] uppercase text-slate-400';
$eyebrowDark = 'font-mono text-[11px] font-medium tracking-[0.18em] uppercase text-indigo-300/70';
$primaryCTA = 'group inline-flex items-center gap-2.5 rounded-md bg-[#121834] px-7 py-4 text-[15px] font-semibold text-white shadow-xs transition-all duration-300 hover:-mt-0.5 hover:mb-0.5 hover:bg-[#0d1326] hover:shadow-xl';
$lightCTA = 'group inline-flex items-center gap-2.5 rounded-md bg-white px-7 py-4 text-[15px] font-semibold text-[#121834] shadow-xs transition-all duration-300 hover:-mt-0.5 hover:mb-0.5 hover:bg-indigo-50 hover:shadow-xl';
$fieldBase = 'w-full rounded-md bg-white px-4 py-3.5 text-[15px] text-slate-900 shadow-xs transition-all placeholder:text-slate-400 focus:outline-none focus:ring-3';
$fieldIdle = 'border border-slate-300 focus:border-indigo-400 focus:ring-indigo-100';
$fieldError = 'border border-red-400 focus:border-red-400 focus:ring-red-100';
$labelDark = 'block text-[15px] font-semibold text-slate-200';
$helpDark = 'mt-1.5 text-[13px] leading-relaxed text-slate-400';
$errorDark = 'mt-2 text-[13px] font-medium text-red-300';
// Radio groups render as one white segmented control so they read as a single
// field alongside the selects and text inputs, not as loose buttons.
$segGroup = 'mt-2.5 flex flex-col overflow-hidden rounded-md bg-white shadow-xs sm:flex-row';
$segIdle = 'border border-slate-300';
$segError = 'border border-red-400';
$segLabel = 'flex-1 cursor-pointer border-t border-slate-200 first:border-t-0 sm:border-t-0 sm:border-l sm:first:border-l-0';
$segItem = 'flex h-full items-center justify-center px-4 py-3.5 text-center text-[15px] font-medium text-slate-600 transition-colors hover:bg-slate-200 hover:text-slate-900 peer-checked:bg-[#324b7d] peer-checked:font-semibold peer-checked:text-white peer-checked:hover:bg-[#1b2350] peer-checked:hover:text-white peer-focus-visible:ring-3 peer-focus-visible:ring-inset peer-focus-visible:ring-indigo-200';
?>

<div id="main-content" class="relative z-10 min-h-screen bg-gradient-to-b from-indigo-50/5 via-white to-white">
    <main class="relative">

        <!-- ============ Hero ============ -->
        <section class="overflow-hidden pt-16">
            <div class="!pb-14 md:!pb-20">
                <div class="mx-auto max-w-3xl text-center">
                    <div class="flex items-center justify-center gap-4" data-aos="reveal">
                        <span class="h-px w-10 bg-slate-300" aria-hidden="true"></span>
                        <p class="<?php echo $eyebrow; ?>">Cloud cost reduction</p>
                        <span class="h-px w-10 bg-slate-300" aria-hidden="true"></span>
                    </div>
                    <h1 class="mt-6 text-4xl font-bold tracking-tight text-balance text-slate-900 md:text-6xl md:leading-[1.05]" data-aos="reveal" data-aos-delay="100">
                        We cut your cloud bill and get paid <span class="underline decoration-indigo-300 decoration-wavy underline-offset-8">from what we save</span>
                    </h1>
                    <div class="mx-auto mt-7 max-w-2xl text-lg leading-relaxed text-slate-600 md:text-xl" data-aos="reveal" data-aos-delay="200">
                        No fee up front. We audit your infrastructure, find the savings, do the work, and take a share of the reduction for an agreed period. If we can't find real money, you owe us nothing.
                    </div>
                    <div class="mt-10" data-aos="reveal" data-aos-delay="300">
                        <a href="#qualify" class="<?php echo $primaryCTA; ?>">
                            Start with a free audit
                            <span aria-hidden="true" class="transition-transform duration-300 group-hover:translate-y-0.5">&darr;</span>
                        </a>
                        <div class="mt-5 text-[14px] text-slate-500">
                            Free audit for companies spending <?php echo $minSpend; ?>+ per month on cloud.
                        </div>
                    </div>
                </div>

                <!-- Schematic cost curve: what we do to a cloud bill, drawn on page load. -->
                <div class="relative mx-auto mt-16 max-w-4xl md:mt-20" aria-hidden="true">
                    <svg class="h-48 w-full md:h-64" viewBox="0 0 1200 300" preserveAspectRatio="none" fill="none">
                        <defs>
                            <linearGradient id="costFade" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#6366f1" stop-opacity="0.10" />
                                <stop offset="100%" stop-color="#6366f1" stop-opacity="0" />
                            </linearGradient>
                        </defs>
                        <line x1="0" y1="60" x2="1200" y2="60" stroke="#e2e8f0" stroke-dasharray="3 6" vector-effect="non-scaling-stroke" />
                        <line x1="0" y1="130" x2="1200" y2="130" stroke="#e2e8f0" stroke-dasharray="3 6" vector-effect="non-scaling-stroke" />
                        <line x1="0" y1="200" x2="1200" y2="200" stroke="#e2e8f0" stroke-dasharray="3 6" vector-effect="non-scaling-stroke" />
                        <line x1="0" y1="270" x2="1200" y2="270" stroke="#e2e8f0" stroke-dasharray="3 6" vector-effect="non-scaling-stroke" />
                        <path d="M-20,40 L150,55 L300,48 L430,92 L560,105 L700,160 L830,180 L960,232 L1090,250 L1220,285 L1220,320 L-20,320 Z" fill="url(#costFade)" />
                        <path class="cost-curve-path" d="M-20,40 L150,55 L300,48 L430,92 L560,105 L700,160 L830,180 L960,232 L1090,250 L1220,285" stroke="#818cf8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" vector-effect="non-scaling-stroke" />
                    </svg>
                    <span class="absolute top-[20%] left-1 -mt-3 font-mono text-[10px] text-slate-500">$45K</span>
                    <span class="absolute top-[43.3%] left-1 -mt-3 font-mono text-[10px] text-slate-500">$30K</span>
                    <span class="absolute top-[66.7%] left-1 -mt-3 font-mono text-[10px] text-slate-500">$15K</span>
                    <span class="absolute top-[90%] left-1 -mt-3 font-mono text-[10px] text-slate-500">$0</span>
                    <span class="absolute top-[88.7%] left-[95.8%] -mt-[5px] -ml-[5px] size-2.5 rounded-full bg-emerald-500 shadow-[0_0_14px_3px_rgba(16,185,129,0.45)]"></span>
                </div>
            </div>
        </section>

        <!-- ============ Where the money goes ============ -->
        <section id="where-the-money-goes">
            <h3 class="home-grid-header">
                <span>01 / The problem</span>
            </h3>
            <div>
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="section-header text-balance">Where the money actually goes</h2>
                    <p class="text-balance">Most cloud bills are big for three separate reasons, and most cost-cutting only addresses one of them.</p>
                </div>

                <div class="mt-16 grid grid-cols-1 gap-6 md:grid-cols-3 2xl:gap-8">
                    <div data-aos="reveal">
                        <div class="<?php echo $card; ?> h-full p-7 before:absolute before:top-0 before:left-7 before:h-0.5 before:w-10 before:rounded-full before:bg-red-300">
                            <div class="font-mono text-[13px] font-semibold text-red-400">01</div>
                            <h3 class="mt-5 text-xl font-bold text-slate-900">Provider pricing</h3>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                The same workload costs different amounts on different clouds, and the list price is rarely the price you have to pay.
                            </p>
                        </div>
                    </div>

                    <div data-aos="reveal" data-aos-delay="100">
                        <div class="<?php echo $card; ?> h-full p-7 before:absolute before:top-0 before:left-7 before:h-0.5 before:w-10 before:rounded-full before:bg-orange-300">
                            <div class="font-mono text-[13px] font-semibold text-orange-400">02</div>
                            <h3 class="mt-5 text-xl font-bold text-slate-900">Infrastructure</h3>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                Instances sized for a load test that ran two years ago. Idle environments nobody turned off. Storage on the wrong tier. Egress nobody measured.
                            </p>
                        </div>
                    </div>

                    <div data-aos="reveal" data-aos-delay="200">
                        <div class="relative h-full rounded-lg bg-[#121834] p-7 shadow-xl ring-1 ring-white/10 transition-all duration-500 hover:-translate-y-1 hover:shadow-2xl">
                            <div class="font-mono text-[13px] font-semibold text-indigo-400">03</div>
                            <h3 class="mt-5 text-xl font-bold text-white">Software</h3>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-400">
                                The query that scans a whole table. The service that retries in a tight loop. The job that runs hourly and needs to run nightly.
                            </p>
                            <p class="mt-4 border-l-2 border-indigo-400 pl-4 text-[15px] leading-relaxed font-semibold text-white">
                                This is the expensive one, and it's the one almost nobody touches.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ What we do about each one ============ -->
        <section id="what-we-do">
            <h3 class="home-grid-header">
                <span>02 / The work</span>
            </h3>
            <div>
                <div class="mx-auto max-w-3xl">
                    <h2 class="section-header text-balance md:text-center">What we do about each one</h2>
                    <p class="md:text-center">Three problems, three different kinds of work.</p>

                    <div class="mt-16 space-y-14">
                        <div data-aos="reveal">
                            <div class="<?php echo $eyebrow; ?> flex items-center gap-2.5"><span class="size-1.5 rounded-full bg-indigo-400" aria-hidden="true"></span>Software</div>
                            <h3 class="mt-3 text-2xl font-bold tracking-tight text-slate-900">Fix the software that creates the bill</h3>
                            <div class="mt-4 text-[16px] leading-[1.9] text-slate-700">
                                <p>
                                    Profiling the hot paths, the query patterns, the retry logic, the scheduled jobs. Infrastructure changes save money once. Software fixes keep saving it every month after, including long after our fee period ends.
                                </p>
                            </div>
                        </div>

                        <div class="border-t border-dashed border-indigo-100 pt-14" data-aos="reveal">
                            <div class="<?php echo $eyebrow; ?> flex items-center gap-2.5"><span class="size-1.5 rounded-full bg-orange-400" aria-hidden="true"></span>Infrastructure</div>
                            <h3 class="mt-3 text-2xl font-bold tracking-tight text-slate-900">Right-size the infrastructure</h3>
                            <div class="mt-4 text-[16px] leading-[1.9] text-slate-700">
                                <p>
                                    Reserved and spot pricing, instance families, autoscaling that actually scales down, storage lifecycle, network paths. Unglamorous work with fast payback.
                                </p>
                            </div>
                        </div>

                        <div class="border-t border-dashed border-indigo-100 pt-14" data-aos="reveal">
                            <div class="<?php echo $eyebrow; ?> flex items-center gap-2.5"><span class="size-1.5 rounded-full bg-red-400" aria-hidden="true"></span>Provider pricing</div>
                            <h3 class="mt-3 text-2xl font-bold tracking-tight text-slate-900">Move to better economics</h3>
                            <div class="mt-4 space-y-4 text-[16px] leading-[1.9] text-slate-700">
                                <p>
                                    For US companies, provider credit programs are substantial. AWS and Google both run them, in both directions. We've moved clients between providers and claimed six figures in credits as part of the migration.
                                </p>
                                <p>
                                    Credits are never the plan on their own. They're a bonus on top of real savings, and they're yours &mdash; our fee is calculated on the actual reduction in run-rate cost, not on your invoice while credits are burning down.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!--
                        Figures are rounded pending the exact before/after numbers from Ran.
                        The bar widths are proportional to the values below, and the badge is the
                        delta between them - update the numbers, w-[13%], and -87% together.
                    -->
                    <figure class="relative mt-16 overflow-hidden rounded-xl bg-[#121834] p-8 shadow-2xl ring-1 ring-white/10 md:p-12" data-aos="reveal">
                        <div class="pointer-events-none absolute -top-32 -right-16 size-80 rounded-full bg-indigo-500/15 blur-3xl" aria-hidden="true"></div>

                        <div class="relative flex flex-wrap items-center justify-between gap-4">
                            <figcaption class="<?php echo $eyebrowDark; ?>">One client &middot; AWS &middot; monthly run-rate</figcaption>
                            <span class="rounded-full bg-emerald-400/10 px-3 py-1 font-mono text-[13px] font-semibold tabular-nums text-emerald-300 ring-1 ring-emerald-400/25">&minus;87%</span>
                        </div>

                        <div class="relative mt-9 space-y-8">
                            <div>
                                <div class="flex items-baseline justify-between gap-4">
                                    <span class="font-mono text-[12px] tracking-wide text-slate-500 uppercase">Before</span>
                                    <span class="font-mono text-2xl font-semibold tabular-nums text-slate-400 md:text-3xl">~$30,000</span>
                                </div>
                                <div class="mt-3 h-3.5 w-full rounded-full bg-white/10" data-aos="bar-grow" data-aos-duration="1200"></div>
                            </div>

                            <div>
                                <div class="flex items-baseline justify-between gap-4">
                                    <span class="font-mono text-[12px] tracking-wide text-indigo-300 uppercase">After</span>
                                    <span class="font-mono text-2xl font-semibold tabular-nums text-white md:text-3xl">~$4,000</span>
                                </div>
                                <div class="mt-3 h-3.5 w-[13%] rounded-full bg-indigo-400 shadow-[0_0_16px_2px_rgba(129,140,248,0.4)]" data-aos="bar-grow" data-aos-duration="1200" data-aos-delay="250"></div>
                            </div>
                        </div>

                        <div class="relative mt-9 border-t border-dashed border-white/10 pt-6 text-[15px] leading-relaxed text-slate-400">
                            Roughly <strong class="font-semibold text-white">$26,000 a month</strong> off the same workload &mdash; infrastructure and software together. The software fixes are still saving them money today.
                        </div>
                    </figure>
                </div>
            </div>
        </section>

        <!-- ============ How it works ============ -->
        <section id="how-it-works">
            <h3 class="home-grid-header">
                <span>03 / Process</span>
            </h3>
            <div>
                <div class="mx-auto max-w-3xl">
                    <h2 class="section-header text-balance md:text-center">How it works</h2>
                    <p class="md:text-center">Six steps, and nothing is sold before step five.</p>

                    <ol class="relative mt-16 list-none p-0 before:absolute before:top-5 before:bottom-12 before:left-[19px] before:border-l before:border-dashed before:border-indigo-200">
                        <li class="relative pb-10 pl-16" data-aos="reveal">
                            <span class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-full border border-indigo-200 bg-white font-mono text-[13px] font-medium text-indigo-400 shadow-xs">01</span>
                            <div class="pt-1.5">
                                <h4 class="text-[17px] font-semibold text-slate-900">You tell us what you spend.</h4>
                                <div class="mt-1.5 text-[15px] leading-relaxed text-slate-600">Two minutes, the form at the bottom.</div>
                            </div>
                        </li>
                        <li class="relative pb-10 pl-16" data-aos="reveal">
                            <span class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-full border border-indigo-200 bg-white font-mono text-[13px] font-medium text-indigo-400 shadow-xs">02</span>
                            <div class="pt-1.5">
                                <h4 class="text-[17px] font-semibold text-slate-900">We sign an NDA.</h4>
                                <div class="mt-1.5 text-[15px] leading-relaxed text-slate-600">Before you show us anything.</div>
                            </div>
                        </li>
                        <li class="relative pb-10 pl-16" data-aos="reveal">
                            <span class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-full border border-indigo-200 bg-white font-mono text-[13px] font-medium text-indigo-400 shadow-xs">03</span>
                            <div class="pt-1.5">
                                <h4 class="text-[17px] font-semibold text-slate-900">You give us read-only access.</h4>
                                <div class="mt-1.5 text-[15px] leading-relaxed text-slate-600">Cloud accounts and the relevant repositories. Read-only, nothing else.</div>
                            </div>
                        </li>
                        <li class="relative pb-10 pl-16" data-aos="reveal">
                            <span class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-full border border-indigo-200 bg-white font-mono text-[13px] font-medium text-indigo-400 shadow-xs">04</span>
                            <div class="pt-1.5">
                                <h4 class="text-[17px] font-semibold text-slate-900">We audit.</h4>
                                <div class="mt-1.5 text-[15px] leading-relaxed text-slate-600">Infrastructure, spend patterns, and code.</div>
                            </div>
                        </li>
                        <li class="relative pb-10 pl-16" data-aos="reveal">
                            <span class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-full border border-[#121834] bg-[#121834] font-mono text-[13px] font-bold text-white shadow-md">05</span>
                            <div class="rounded-lg bg-indigo-50/70 p-5 ring-1 ring-indigo-100">
                                <h4 class="text-[17px] font-bold text-slate-900">We come back with a number and a proposal.</h4>
                                <div class="mt-1.5 text-[15px] leading-relaxed text-slate-700">
                                    This is the first point at which any offer exists. Nothing is being sold to you before the audit is done.
                                </div>
                            </div>
                        </li>
                        <li class="relative pl-16" data-aos="reveal">
                            <span class="absolute top-0 left-0 flex size-10 items-center justify-center rounded-full border border-indigo-200 bg-white font-mono text-[13px] font-medium text-indigo-400 shadow-xs">06</span>
                            <div class="pt-1.5">
                                <h4 class="text-[17px] font-semibold text-slate-900">You decide.</h4>
                                <div class="mt-1.5 text-[15px] leading-relaxed text-slate-600">If the numbers don't work for you, we part ways and you keep the report.</div>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </section>

        <!-- ============ The deal ============ -->
        <section id="the-deal">
            <h3 class="home-grid-header">
                <span>04 / Terms</span>
            </h3>
            <div>
                <div class="mx-auto max-w-3xl">
                    <h2 class="section-header text-balance md:text-center">The deal</h2>
                    <p class="md:text-center">Nothing up front. Here's the whole invoice, in advance.</p>

                    <div class="relative mx-auto mt-16 max-w-md" data-aos="reveal">
                        <div class="relative rounded-lg border border-dashed border-indigo-200 bg-white px-7 py-9 shadow-xl shadow-indigo-100/60 ring-4 ring-indigo-50/50 md:px-9">
                            <span class="absolute -top-4 right-7 rotate-[7deg] rounded-sm border-2 border-emerald-500/60 bg-white px-2.5 py-1 font-mono text-[10px] font-bold tracking-[0.18em] text-emerald-600/90 uppercase shadow-xs select-none" aria-hidden="true">No payment due</span>

                            <div class="text-center font-mono text-[11px] font-medium tracking-[0.25em] text-slate-400 uppercase">Automaze &middot; Cloud cost audit</div>
                            <div class="mt-1.5 text-center font-mono text-[10px] tracking-[0.25em] text-slate-300 uppercase">Statement of terms</div>

                            <dl class="mt-8 space-y-4 font-mono text-[14px]">
                                <div class="flex items-baseline gap-3">
                                    <dt class="shrink-0 text-slate-500">Up front</dt>
                                    <span class="mb-1 flex-1 border-b border-dotted border-slate-300" aria-hidden="true"></span>
                                    <dd class="shrink-0 font-semibold text-slate-900">$0.00</dd>
                                </div>
                                <div class="flex items-baseline gap-3">
                                    <dt class="shrink-0 text-slate-500">Our fee</dt>
                                    <span class="mb-1 flex-1 border-b border-dotted border-slate-300" aria-hidden="true"></span>
                                    <dd class="shrink-0 text-slate-700">Share of savings</dd>
                                </div>
                                <div class="flex items-baseline gap-3">
                                    <dt class="shrink-0 text-slate-500">After the term</dt>
                                    <span class="mb-1 flex-1 border-b border-dotted border-slate-300" aria-hidden="true"></span>
                                    <dd class="shrink-0 text-slate-700">All yours</dd>
                                </div>
                            </dl>

                            <div class="relative mt-9 border-t-2 border-dashed border-slate-200 pt-7">
                                <div class="flex items-baseline justify-between gap-3">
                                    <span class="font-mono text-[12px] font-medium tracking-[0.18em] text-slate-500 uppercase">Total due today</span>
                                    <span class="font-mono text-3xl font-bold tabular-nums text-slate-900">$0.00</span>
                                </div>
                            </div>

                            <div class="mt-8 text-center font-mono text-[10px] tracking-[0.25em] text-slate-300 uppercase">Thank you &middot; automaze.io</div>
                        </div>
                    </div>

                    <div class="mt-12 text-[16px] leading-[1.9] text-slate-700" data-aos="reveal">
                        If a different structure suits you better &mdash; a fixed fee, a cap, a shorter term &mdash; we'll talk about it. The only thing we're firm on is that we don't get paid unless your bill goes down.
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ Access ============ -->
        <section id="access">
            <h3 class="home-grid-header">
                <span>05 / Trust</span>
            </h3>
            <div>
                <div class="mx-auto max-w-4xl">
                    <div class="mx-auto max-w-3xl">
                        <h2 class="section-header text-balance md:text-center">Access, and what we don't do</h2>
                        <p class="md:text-center">You're being asked to let a stranger look at production. Here's exactly how far that goes.</p>
                    </div>

                    <div class="mt-14 grid grid-cols-1 gap-6 md:grid-cols-2 2xl:gap-8">
                        <div data-aos="reveal">
                            <div class="<?php echo $card; ?> h-full p-7 md:p-8">
                                <div class="flex items-center gap-3">
                                    <span class="flex size-7 items-center justify-center rounded-full bg-indigo-50 ring-1 ring-indigo-100" aria-hidden="true">
                                        <svg class="size-3.5 text-indigo-500" viewBox="0 0 20 20" fill="none"><path d="M4 10.5l4 4 8-9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                    </span>
                                    <h3 class="text-xl font-bold text-slate-900">What we ask for</h3>
                                </div>
                                <ul role="list">
                                    <li><strong class="font-semibold text-slate-900">Read-only access, always.</strong> We don't need write access to audit.</li>
                                    <li><strong class="font-semibold text-slate-900">An NDA first.</strong> Signed before anything is shared with us.</li>
                                    <li><strong class="font-semibold text-slate-900">The relevant repositories.</strong> Read-only, and only the ones that touch the bill.</li>
                                </ul>
                            </div>
                        </div>

                        <div data-aos="reveal" data-aos-delay="100">
                            <div class="relative h-full rounded-lg border border-dashed border-rose-200/80 bg-gradient-to-b from-white via-white to-[#fffbfb] p-7 shadow ring-4 ring-rose-50/50 transition-all duration-500 hover:-translate-y-1 hover:shadow-xl hover:ring-rose-50 md:p-8">
                                <div class="flex items-center gap-3">
                                    <span class="flex size-7 items-center justify-center rounded-full bg-rose-50 ring-1 ring-rose-100" aria-hidden="true">
                                        <svg class="size-3.5 text-rose-400" viewBox="0 0 20 20" fill="none"><path d="M5 5l10 10M15 5L5 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" /></svg>
                                    </span>
                                    <h3 class="text-xl font-bold text-slate-900">What we don't do</h3>
                                </div>
                                <ul class="my-6 space-y-3 text-[15px] leading-relaxed text-neutral-700">
                                    <li class="relative pl-7">
                                        <span class="absolute top-0 left-0 text-xl leading-tight font-medium text-rose-300">&times;</span>
                                        We don't move you onto our tooling, our platform, or our hosting.
                                    </li>
                                    <li class="relative pl-7">
                                        <span class="absolute top-0 left-0 text-xl leading-tight font-medium text-rose-300">&times;</span>
                                        We don't take ownership of your accounts or your infrastructure. They stay yours.
                                    </li>
                                    <li class="relative pl-7">
                                        <span class="absolute top-0 left-0 text-xl leading-tight font-medium text-rose-300">&times;</span>
                                        We don't leave anything to unpick. Stop working with us and nothing breaks.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ Who we are ============ -->
        <section id="who-we-are">
            <h3 class="home-grid-header">
                <span>06 / About us</span>
            </h3>
            <div>
                <div class="mx-auto max-w-3xl">
                    <h2 class="section-header text-balance md:text-center">Who we are</h2>
                    <p class="md:text-center">An engineering firm, not a cost-cutting consultancy.</p>

                    <div class="mt-14 grid grid-cols-1 gap-6 sm:grid-cols-3 2xl:gap-8">
                        <div data-aos="reveal">
                            <div class="<?php echo $card; ?> p-6 text-center">
                                <div class="font-mono text-4xl font-semibold tracking-tight text-slate-900">20+</div>
                                <div class="<?php echo $eyebrow; ?> mt-2.5">Engineers &amp; designers</div>
                            </div>
                        </div>
                        <div data-aos="reveal" data-aos-delay="100">
                            <div class="<?php echo $card; ?> p-6 text-center">
                                <div class="font-mono text-4xl font-semibold tracking-tight text-slate-900">92%</div>
                                <div class="<?php echo $eyebrow; ?> mt-2.5">Client retention</div>
                            </div>
                        </div>
                        <div data-aos="reveal" data-aos-delay="200">
                            <div class="<?php echo $card; ?> p-6 text-center">
                                <div class="font-mono text-4xl font-semibold tracking-tight text-slate-900">35+</div>
                                <div class="<?php echo $eyebrow; ?> mt-2.5">Years' experience</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 space-y-4 text-[16px] leading-[1.9] text-slate-700">
                        <p>
                            Automaze works as CTO-as-a-Service: senior technical leadership and delivery for founders and companies who need it without hiring it full time. Cost work is one of the things that comes with knowing infrastructure and code equally well.
                        </p>
                        <p>
                            <a href="<?php tiny::homeURL('about'); ?>" class="cta-link">More about us</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ Qualify form ============ -->
        <section id="qualify" class="scroll-mt-24">
            <h3 class="home-grid-header">
                <span>07 / Get started</span>
            </h3>

<?php
// Qualified leads only, and only after they submit: $form->booking is set by the
// POST and lives in the session, so the widget cannot be reached by typing
// ?sent=1, and the honeypot's fake success never reaches it either. Rendering it
// conditionally also keeps the Cal embed script off the page for everyone else.
//
// The confirmation card further down is suppressed entirely while the calendar
// is on the page; the lead event at the end of this block keeps analytics whole.
$showBooking = $form->sent && !$form->below && $form->booking !== null;

if ($showBooking):
    // The Cal config below is prefilled from these three, and drops its
    // website_url key: the form never asks for a website, and the one field that
    // looks like it (company_website) is the bot honeypot.
    //
    // JSON_HEX_TAG matters here: these values go inside a <script> block, and a
    // company name containing "</script>" would otherwise close it early.
    $bookJs = static fn (string $value): string => json_encode(
        $value,
        JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
    );
?>
            <div id="cloud-audit-book" class="mb-14">
                <h2 class="mt-4 text-3xl font-semibold tracking-tight text-slate-900 text-center">Thanks &mdash; let's book a call</h2>
                <p class="mx-auto mt-4 mb-8 max-w-xl text-center text-[16px] leading-[1.8] text-slate-600">
                    Your request is in. Pick a time that suits you and we'll take it from there.
                </p>

                <!-- Cal inline embed code begins -->
                <div style="width:100%;height:100%;overflow:scroll" id="my-cal-inline-cloud-audit"></div>

                <noscript>
                    <p class="text-center text-[15px] leading-relaxed text-slate-700">
                        <a href="https://cal.com/automaze/cloud-audit?<?php echo htmlspecialchars(http_build_query([
                            'name' => $form->booking['name'],
                            'email' => $form->booking['email'],
                            'company_name' => $form->booking['company'],
                        ]), ENT_QUOTES); ?>" class="cta-link">Pick a time on our calendar</a>
                    </p>
                </noscript>
                <script type="text/javascript">
                    (function (C, A, L) { let p = function (a, ar) { a.q.push(ar); }; let d = C.document; C.Cal = C.Cal || function () { let cal = C.Cal; let ar = arguments; if (!cal.loaded) { cal.ns = {}; cal.q = cal.q || []; d.head.appendChild(d.createElement("script")).src = A; cal.loaded = true; } if (ar[0] === L) { const api = function () { p(api, arguments); }; const namespace = ar[1]; api.q = api.q || []; if(typeof namespace === "string"){cal.ns[namespace] = cal.ns[namespace] || api;p(cal.ns[namespace], ar);p(cal, ["initNamespace", namespace]);} else p(cal, ar); return;} p(cal, ar); }; })(window, "https://app.cal.com/embed/embed.js", "init");
                    Cal("init", "cloud-audit", {origin:"https://app.cal.com"});
                    Cal.config = Cal.config || {}
                    Cal.config.forwardQueryParams = true;
                    Cal.ns["cloud-audit"]("inline", {
                        elementOrSelector:"#my-cal-inline-cloud-audit",
                        config: {
                            layout: "month_view",
                            useSlotsViewOnSmallScreen: true,
                            name: <?php echo $bookJs($form->booking['name']); ?>,
                            email: <?php echo $bookJs($form->booking['email']); ?>,
                            company_name: <?php echo $bookJs($form->booking['company']); ?>

                        },
                        calLink: "automaze/cloud-audit",
                    });
                    Cal.ns["cloud-audit"]("ui", {"cssVarsPerTheme":{"light":{"cal-brand":"#292929"},"dark":{"cal-brand":"#fafafa"}},"hideEventTypeDetails":false,"layout":"month_view"});
                </script>
                <!-- Cal inline embed code ends -->
            </div>
            <script>
                // Lives here rather than in the confirmation card, which is
                // hidden while the calendar is on the page.
                if (typeof window.gtag === 'function') {
                    window.gtag('event', 'cloud_audit_lead', { page_path: window.location.pathname, transport_type: 'beacon' });
                }
            </script>
<?php endif; ?>

<?php if (!$showBooking): ?>
            <div>
                <div class="mx-auto max-w-2xl">
                    <div class="relative overflow-hidden rounded-2xl bg-[#121834] px-6 py-10 shadow-2xl ring-1 ring-white/10 sm:px-10 md:p-14" data-aos="reveal">
                        <div class="pointer-events-none absolute inset-x-0 top-0 h-64 bg-[radial-gradient(ellipse_60%_100%_at_50%_0%,rgba(99,102,241,0.16),transparent)]" aria-hidden="true"></div>

                        <div class="relative">
<?php if ($form->sent && $form->below): ?>
                            <div class="rounded-xl bg-white p-8 shadow-xl md:p-10">
                                <div class="<?php echo $eyebrow; ?>">Email received</div>
                                <h2 class="mt-4 text-3xl font-semibold tracking-tight text-slate-900">Thanks &mdash; we've got you on file</h2>
                                <div class="mt-5 space-y-4 text-[16px] leading-[1.9] text-slate-700">
                                    <p>
                                        Below <?php echo $minSpend; ?> a month, the savings usually don't justify the work, so we'd rather not take your money. If your spend grows, we'll get in touch.
                                    </p>
                                    <p>
                                        If you think your case is unusual, reply to us directly at
                                        <a href="mailto:hello@automaze.io?subject=Cloud%20cost%20audit" class="font-semibold text-blue-500 hover:border-b-[1.5px]">hello@automaze.io</a>.
                                    </p>
                                </div>
                                <div class="mt-8">
                                    <a href="<?php tiny::homeURL('/'); ?>" class="cta-link">Back to the homepage</a>
                                </div>
                            </div>
<?php elseif ($form->sent): ?>
                            <div class="rounded-xl bg-white p-8 shadow-xl md:p-10">
                                <div class="<?php echo $eyebrow; ?>">Request received</div>
                                <h2 class="mt-4 text-3xl font-semibold tracking-tight text-slate-900">We'll be in touch shortly</h2>
                                <div class="mt-5 text-[16px] leading-[1.9] text-slate-700">
                                    Here's what happens next, in order:
                                </div>
                                <ol class="mt-6 list-none space-y-4 p-0">
<?php foreach ([
    'We reply with an NDA, before you show us anything.',
    'You give us read-only access to the cloud accounts and the relevant repositories.',
    'We audit the infrastructure, the spend patterns, and the code.',
    'We come back with a number and a proposal. That\'s the first point at which any offer exists.',
] as $stepIndex => $stepText): ?>
                                    <li class="relative pl-9 text-[15px] leading-relaxed text-slate-700">
                                        <span class="absolute top-0 left-0 font-mono text-[13px] font-medium text-indigo-300"><?php echo str_pad((string)($stepIndex + 1), 2, '0', STR_PAD_LEFT); ?></span>
                                        <?php echo $stepText; ?>
                                    </li>
<?php endforeach; ?>
                                </ol>
                                <div class="mt-8 border-t border-dashed border-indigo-100 pt-6 text-[15px] leading-relaxed text-slate-600">
                                    Questions in the meantime?
                                    <a href="mailto:hello@automaze.io?subject=Cloud%20cost%20audit" class="font-semibold text-blue-500 hover:border-b-[1.5px]">hello@automaze.io</a>
                                </div>
                            </div>
                            <script>
                                if (typeof window.gtag === 'function') {
                                    window.gtag('event', 'cloud_audit_lead', { page_path: window.location.pathname, transport_type: 'beacon' });
                                }
                            </script>
<?php else: ?>
                            <h2 class="text-3xl font-semibold tracking-tight text-balance text-white md:text-4xl">See if you qualify</h2>
                            <p class="mt-4 text-[16px] leading-[1.8] text-slate-400">The audit is free if you're spending <?php echo $minSpend; ?>+ per month. The rest of these just tell us which options are open to you.</p>

<?php if (isset($errors['form'])): ?>
                            <div class="mt-8 rounded-md border border-red-400/30 bg-red-400/10 px-5 py-4 text-[15px] leading-relaxed text-red-200">
                                <?php echo htmlspecialchars($errors['form']); ?>
                            </div>
<?php elseif ($errors !== []): ?>
                            <div class="mt-8 rounded-md border border-red-400/30 bg-red-400/10 px-5 py-4 text-[15px] leading-relaxed text-red-200">
                                Almost there &mdash; <?php echo count($errors) === 1 ? 'one field needs' : count($errors) . ' fields need'; ?> a second look.
                            </div>
<?php endif; ?>

<?php
// The two-step flow is a JS enhancement. Without JS both steps render as one
// long form and the server validates the whole thing in a single POST, so the
// step state below only ever matters to Alpine.
$step1Fields = ['monthly_spend', 'provider', 'us_company', 'open_to_migration'];
$reopenAtStep = ($errors !== [] && array_intersect(array_keys($errors), $step1Fields) === []) ? 2 : 1;
$formState = htmlspecialchars(json_encode([
    'step' => $reopenAtStep,
    'belowKey' => $options->belowThreshold,
    'spend' => $values['monthly_spend'],
    'provider' => $values['provider'],
    'usCompany' => $values['us_company'],
    'migration' => $values['open_to_migration'],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), ENT_QUOTES);
?>
                            <script>
                                // Marks JS as available so the stylesheet can collapse step 2 before
                                // Alpine boots. Without JS the class is never added and both steps stay.
                                document.documentElement.classList.add('js-on');

                                window.cloudAuditForm = (initial) => ({
                                    ready: false,
                                    step: initial.step,
                                    spend: initial.spend,
                                    provider: initial.provider,
                                    usCompany: initial.usCompany,
                                    migration: initial.migration,
                                    stepErrors: {},

                                    init() {
                                        this.ready = true;
                                        // Refs only exist after Alpine walks the tree, hence nextTick.
                                        // From here on x-show owns the panel, so the CSS guard must stop.
                                        this.$nextTick(() => this.$refs.step2.setAttribute('data-step-ready', ''));
                                    },

                                    get below() {
                                        return this.spend === initial.belowKey;
                                    },

                                    // Mirrors the rules in app/controllers/services/cloud-audit.php.
                                    // The server stays the source of truth; this only saves a round trip.
                                    checkStep1() {
                                        const errors = {};
                                        if (!this.spend) {
                                            errors.monthly_spend = 'Pick your current monthly cloud spend.';
                                        }
                                        if (!this.below) {
                                            if (!this.provider) errors.provider = 'Pick your current provider.';
                                            if (!this.usCompany) errors.us_company = "Let us know if you're a US company.";
                                            if (!this.migration) errors.open_to_migration = 'Let us know how you feel about changing provider.';
                                        }
                                        this.stepErrors = errors;
                                        return Object.keys(errors).length === 0;
                                    },

                                    next() {
                                        if (!this.checkStep1()) return;
                                        this.step = 2;
                                        this.$nextTick(() => {
                                            this.$refs.formTop.scrollIntoView({ block: 'start' });
                                            this.$refs.fullName.focus({ preventScroll: true });
                                        });
                                    },

                                    back() {
                                        this.step = 1;
                                        this.$nextTick(() => {
                                            this.$refs.formTop.scrollIntoView({ block: 'start' });
                                            this.$refs.spend.focus({ preventScroll: true });
                                        });
                                    },

                                    // Enter inside step 1 must advance the form, not post it half-filled.
                                    onSubmit(event) {
                                        if (this.ready && this.step === 1) {
                                            event.preventDefault();
                                            this.next();
                                        }
                                    },
                                });
                            </script>

                            <form method="post" action="<?php tiny::homeURL('services/cloud-audit'); ?>#qualify" class="mt-10 space-y-8"
                                x-data="cloudAuditForm(<?php echo $formState; ?>)" x-on:submit="onSubmit($event)">

                                <!-- Bot trap: hidden from people, irresistible to scripted submits. -->
                                <div class="hidden" aria-hidden="true">
                                    <label for="company_website">Company website</label>
                                    <input type="text" id="company_website" name="company_website" tabindex="-1" autocomplete="off" value="">
                                </div>
<?php foreach ($form->tracking as $trackingField => $trackingValue): ?>
                                <input type="hidden" name="<?php echo $trackingField; ?>" value="<?php echo htmlspecialchars((string)$trackingValue, ENT_QUOTES); ?>">
<?php endforeach; ?>

                                <!-- Step rail: only meaningful once JS is driving the steps. -->
                                <div x-ref="formTop" x-show="ready" style="display: none" class="scroll-mt-28">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-2.5">
                                            <span class="flex size-7 items-center justify-center rounded-full font-mono text-[12px] font-semibold transition-colors duration-300"
                                                :class="step === 1 ? 'bg-white text-[#121834]' : 'bg-indigo-400/20 text-indigo-200'">1</span>
                                            <span class="text-[13px] font-medium transition-colors duration-300" :class="step === 1 ? 'text-white' : 'text-slate-500'">Qualification</span>
                                        </div>
                                        <span class="h-px flex-1 bg-white/15" aria-hidden="true"></span>
                                        <div class="flex items-center gap-2.5">
                                            <span class="flex size-7 items-center justify-center rounded-full font-mono text-[12px] font-semibold transition-colors duration-300"
                                                :class="step === 2 ? 'bg-white text-[#121834]' : 'bg-white/10 text-slate-500'">2</span>
                                            <span class="text-[13px] font-medium transition-colors duration-300" :class="step === 2 ? 'text-white' : 'text-slate-500'">Contact info</span>
                                        </div>
                                    </div>
                                    <div class="sr-only" aria-live="polite" x-text="'Step ' + step + ' of 2'"></div>
                                </div>

                                <!-- ======== Step 1: qualification ======== -->
                                <div data-step-panel="1" x-show="step === 1" class="space-y-8">
                                <div>
                                    <label for="monthly_spend" class="<?php echo $labelDark; ?>">Monthly cloud spend</label>
                                    <div class="relative mt-2.5">
                                        <select id="monthly_spend" name="monthly_spend" required x-model="spend" x-ref="spend"
                                            :class="{ 'border-red-400!': stepErrors.monthly_spend }"
                                            class="<?php echo $fieldBase; ?> <?php echo isset($errors['monthly_spend']) ? $fieldError : $fieldIdle; ?> appearance-none pr-11">
                                            <option value="" <?php echo $values['monthly_spend'] === '' ? 'selected' : ''; ?>>Select a range</option>
<?php foreach ($options->spend as $spendKey => $spendLabel): ?>
                                            <option value="<?php echo $spendKey; ?>" <?php echo $values['monthly_spend'] === $spendKey ? 'selected' : ''; ?>><?php echo $spendLabel; ?></option>
<?php endforeach; ?>
                                        </select>
                                        <svg class="pointer-events-none absolute top-1/2 right-4 size-4 -translate-y-1/2 text-slate-400" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                            <path d="M6 8l4 4 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
<?php if (isset($errors['monthly_spend'])): ?>
                                    <div class="<?php echo $errorDark; ?>"><?php echo htmlspecialchars($errors['monthly_spend']); ?></div>
<?php endif; ?>
                                    <div x-show="stepErrors.monthly_spend" style="display: none" class="<?php echo $errorDark; ?>" x-text="stepErrors.monthly_spend"></div>
                                    <div x-show="below" style="display: none"
                                        class="mt-4 rounded-md border border-amber-300/25 bg-amber-300/10 px-5 py-4 text-[14px] leading-relaxed text-amber-200">
                                        Below <?php echo $minSpend; ?> the savings usually don't justify the work. Leave your email and we'll get in touch if that changes.
                                    </div>
                                </div>

                                <div x-show="!below" class="space-y-8">
                                    <div>
                                        <label for="provider" class="<?php echo $labelDark; ?>">Current provider</label>
                                        <div class="relative mt-2.5">
                                            <select id="provider" name="provider" :required="!below" x-model="provider"
                                                :class="{ 'border-red-400!': stepErrors.provider }"
                                                class="<?php echo $fieldBase; ?> <?php echo isset($errors['provider']) ? $fieldError : $fieldIdle; ?> appearance-none pr-11">
                                                <option value="" <?php echo $values['provider'] === '' ? 'selected' : ''; ?>>Select a provider</option>
<?php foreach ($options->provider as $providerKey => $providerLabel): ?>
                                                <option value="<?php echo $providerKey; ?>" <?php echo $values['provider'] === $providerKey ? 'selected' : ''; ?>><?php echo $providerLabel; ?></option>
<?php endforeach; ?>
                                            </select>
                                            <svg class="pointer-events-none absolute top-1/2 right-4 size-4 -translate-y-1/2 text-slate-400" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                                <path d="M6 8l4 4 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
<?php if (isset($errors['provider'])): ?>
                                        <div class="<?php echo $errorDark; ?>"><?php echo htmlspecialchars($errors['provider']); ?></div>
<?php endif; ?>
                                        <div x-show="stepErrors.provider" style="display: none" class="<?php echo $errorDark; ?>" x-text="stepErrors.provider"></div>
                                    </div>

                                    <fieldset>
                                        <legend class="<?php echo $labelDark; ?>">Are you a US company?</legend>
                                        <div class="<?php echo $segGroup; ?> <?php echo isset($errors['us_company']) ? $segError : $segIdle; ?>"
                                            :class="{ 'border-red-400!': stepErrors.us_company }">
<?php foreach ($options->usCompany as $usKey => $usLabel): ?>
                                            <label class="<?php echo $segLabel; ?>">
                                                <input type="radio" name="us_company" value="<?php echo $usKey; ?>" class="peer sr-only" x-model="usCompany"
                                                    <?php echo $values['us_company'] === $usKey ? 'checked' : ''; ?>>
                                                <span class="<?php echo $segItem; ?>"><?php echo $usLabel; ?></span>
                                            </label>
<?php endforeach; ?>
                                        </div>
                                        <div class="<?php echo $helpDark; ?>">US companies often qualify for large provider credits, which is why we ask.</div>
<?php if (isset($errors['us_company'])): ?>
                                        <div class="<?php echo $errorDark; ?>"><?php echo htmlspecialchars($errors['us_company']); ?></div>
<?php endif; ?>
                                        <div x-show="stepErrors.us_company" style="display: none" class="<?php echo $errorDark; ?>" x-text="stepErrors.us_company"></div>
                                    </fieldset>

                                    <fieldset>
                                        <legend class="<?php echo $labelDark; ?>">Open to changing provider?</legend>
                                        <div class="<?php echo $segGroup; ?> <?php echo isset($errors['open_to_migration']) ? $segError : $segIdle; ?>"
                                            :class="{ 'border-red-400!': stepErrors.open_to_migration }">
<?php foreach ($options->migration as $migrationKey => $migrationLabel): ?>
                                            <label class="<?php echo $segLabel; ?>">
                                                <input type="radio" name="open_to_migration" value="<?php echo $migrationKey; ?>" class="peer sr-only" x-model="migration"
                                                    <?php echo $values['open_to_migration'] === $migrationKey ? 'checked' : ''; ?>>
                                                <span class="<?php echo $segItem; ?>"><?php echo $migrationLabel; ?></span>
                                            </label>
<?php endforeach; ?>
                                        </div>
                                        <div class="<?php echo $helpDark; ?>">We handle the entire migration if it makes sense. "Not sure" is a fine answer.</div>
<?php if (isset($errors['open_to_migration'])): ?>
                                        <div class="<?php echo $errorDark; ?>"><?php echo htmlspecialchars($errors['open_to_migration']); ?></div>
<?php endif; ?>
                                        <div x-show="stepErrors.open_to_migration" style="display: none" class="<?php echo $errorDark; ?>" x-text="stepErrors.open_to_migration"></div>
                                    </fieldset>
                                </div>

                                    <div x-show="ready" style="display: none" class="border-t border-white/10 pt-8">
                                        <button type="button" x-on:click="next()" class="<?php echo $lightCTA; ?> w-full justify-center sm:w-auto">
                                            Continue
                                            <span aria-hidden="true" class="transition-transform duration-300 group-hover:translate-x-1">&rarr;</span>
                                        </button>
                                        <div class="mt-5 text-[13px] leading-relaxed text-slate-400">
                                            One more step &mdash; just where to send it. Nothing is shared until you say so.
                                        </div>
                                    </div>
                                </div>

                                <!-- ======== Step 2: contact info ======== -->
                                <div data-step-panel="2" x-ref="step2" x-show="step === 2" class="space-y-8">
                                    <div x-show="ready" style="display: none">
                                        <h3 class="text-xl font-semibold tracking-tight text-white">Where should we send it?</h3>
                                        <p class="mt-2 text-[15px] leading-relaxed text-slate-400">One reply from a person, with an NDA attached. No sequences, no newsletter.</p>
                                    </div>

                                    <div>
                                        <label for="full_name" class="<?php echo $labelDark; ?>">Full name</label>
                                        <input type="text" id="full_name" name="full_name" autocomplete="name" placeholder="Jane Doe" x-ref="fullName"
                                            :required="!below"
                                            value="<?php echo htmlspecialchars($values['full_name'], ENT_QUOTES); ?>"
                                            class="<?php echo $fieldBase; ?> <?php echo isset($errors['full_name']) ? $fieldError : $fieldIdle; ?> mt-2.5">
<?php if (isset($errors['full_name'])): ?>
                                        <div class="<?php echo $errorDark; ?>"><?php echo htmlspecialchars($errors['full_name']); ?></div>
<?php endif; ?>
                                    </div>

                                    <div>
                                        <label for="email" class="<?php echo $labelDark; ?>">Work email</label>
                                        <input type="email" id="email" name="email" required autocomplete="email" placeholder="you@company.com"
                                            value="<?php echo htmlspecialchars($values['email'], ENT_QUOTES); ?>"
                                            class="<?php echo $fieldBase; ?> <?php echo isset($errors['email']) ? $fieldError : $fieldIdle; ?> mt-2.5">
<?php if (isset($errors['email'])): ?>
                                        <div class="<?php echo $errorDark; ?>"><?php echo htmlspecialchars($errors['email']); ?></div>
<?php endif; ?>
                                    </div>

                                    <div>
                                        <label for="company" class="<?php echo $labelDark; ?>">Company or project</label>
                                        <input type="text" id="company" name="company" autocomplete="organization" placeholder="Acme Inc."
                                            :required="!below"
                                            value="<?php echo htmlspecialchars($values['company'], ENT_QUOTES); ?>"
                                            class="<?php echo $fieldBase; ?> <?php echo isset($errors['company']) ? $fieldError : $fieldIdle; ?> mt-2.5">
<?php if (isset($errors['company'])): ?>
                                        <div class="<?php echo $errorDark; ?>"><?php echo htmlspecialchars($errors['company']); ?></div>
<?php endif; ?>
                                    </div>

                                    <div class="border-t border-white/10 pt-8">
                                        <div class="flex flex-wrap items-center gap-x-6 gap-y-4">
                                            <button type="submit" class="<?php echo $lightCTA; ?> w-full justify-center sm:w-auto">
                                                Request the audit
                                                <span aria-hidden="true" class="transition-transform duration-300 group-hover:translate-x-1">&rarr;</span>
                                            </button>
                                            <button type="button" x-show="ready" style="display: none" x-on:click="back()"
                                                class="group inline-flex items-center gap-2 text-[14px] font-medium text-slate-400 transition-colors hover:text-white">
                                                <span aria-hidden="true" class="transition-transform duration-300 group-hover:-translate-x-1">&larr;</span>
                                                Back
                                            </button>
                                        </div>
                                        <div class="mt-5 text-[13px] leading-relaxed text-slate-400">
                                            NDA before anything is shared. Read-only access. No fee unless your bill goes down.
                                            Prefer email? <a href="mailto:hello@automaze.io?subject=Cloud%20cost%20audit" class="font-medium text-indigo-300 hover:border-b hover:border-indigo-300">hello@automaze.io</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
<?php endif; ?>
        </section>

        <!-- ============ FAQ ============ -->
        <section id="faq">
            <h3 class="home-grid-header">
                <span>08 / FAQ</span>
            </h3>
            <div>
                <div class="mx-auto max-w-2xl">
                    <h2 class="section-header text-balance md:text-center">Frequently asked questions</h2>
                    <p class="md:text-center">The things people ask before they hand over access.</p>

                    <div class="accordion mt-12" data-aos="reveal">
                        <details name="cloud-faq">
                            <summary>What if you don't find anything?</summary>
                            <div>
                                <p>Then we tell you, you keep the report, and you owe us nothing. It's happened, and we'd rather say it than pad an invoice.</p>
                            </div>
                        </details>

                        <details name="cloud-faq">
                            <summary>What if we want to stop partway through?</summary>
                            <div>
                                <p>The terms cover that before anyone signs. We're not interested in locking anyone into anything.</p>
                            </div>
                        </details>

                        <details name="cloud-faq">
                            <summary>Do you need write access to our accounts?</summary>
                            <div>
                                <p>No. Read-only for the audit. If you then want us to do the migration work, we agree that access separately and explicitly.</p>
                            </div>
                        </details>

                        <details name="cloud-faq">
                            <summary>What about the credits &mdash; are you just taking those?</summary>
                            <div>
                                <p>No. Our fee is based on the real reduction in what your infrastructure costs to run. Credits are separate, they're yours, and they reduce what you actually pay while our fee period runs.</p>
                            </div>
                        </details>

                        <details name="cloud-faq">
                            <summary>Who does the migration work?</summary>
                            <div>
                                <p>We do. That's included. You're not getting a PDF and a wish of good luck.</p>
                            </div>
                        </details>

                        <details name="cloud-faq">
                            <summary>Do you look at our code?</summary>
                            <div>
                                <p>With an NDA in place and read-only access, yes &mdash; that's where a lot of the savings are. If you'd rather we stayed on the infrastructure side only, say so and we'll scope it that way.</p>
                            </div>
                        </details>

                        <details name="cloud-faq">
                            <summary>Can you keep working with us after the audit?</summary>
                            <div>
                                <p>Some clients do. Automaze is an engineering firm, and cost work often surfaces architecture problems that are bigger than a cost project. That's a separate conversation, and only if you want it.</p>
                            </div>
                        </details>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ Closing CTA ============ -->
        <section class="relative overflow-hidden bg-[#0c1427]">
            <div class="relative z-10 !py-20 md:!py-24 border-b border-b-white/10">
                <div class="mx-auto max-w-2xl text-center">
                    <div class="<?php echo $eyebrowDark; ?>" data-aos="reveal">Ready when you are</div>
                    <h2 class="mt-5 text-4xl font-semibold tracking-tight text-balance text-white md:text-5xl" data-aos="reveal" data-aos-delay="100">Find out what you're overpaying</h2>
                    <div class="mt-5 text-lg leading-relaxed text-slate-400" data-aos="reveal" data-aos-delay="200">
                        Free audit, NDA first, read-only access, no fee unless your bill goes down.
                    </div>
                    <div class="mt-10 flex items-center justify-center" data-aos="reveal" data-aos-delay="300">
                        <a href="#qualify" class="<?php echo $lightCTA; ?>">
                            Start with a free audit
                            <span aria-hidden="true" class="transition-transform duration-300 group-hover:translate-x-1">&rarr;</span>
                        </a>
                    </div>
                    <div class="mt-5 text-[13px] text-slate-500" data-aos="reveal" data-aos-delay="300">
                        Free audit for companies spending <?php echo $minSpend; ?>+ per month on cloud.
                    </div>
                </div>
            </div>
            <div class="pointer-events-none !absolute inset-0 bg-[radial-gradient(rgba(129,140,248,0.13)_1px,transparent_1px)] bg-[size:22px_22px] [mask-image:radial-gradient(ellipse_at_center,black_25%,transparent_72%)]" aria-hidden="true"></div>
        </section>
    </main>
</div>

<style>
    body:before,
    body:after,
    #footer:before {
        display: none !important;
    }

    @media (max-width: 768px) {
        #footer-lead {
            display: none !important;
        }
    }
</style>
<?php tiny::layout()->default('/'); ?>
