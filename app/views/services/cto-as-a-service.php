<?php
tiny::layout()->default(
    title: 'Technical Co-Founder & CTO as a Service',
    pageTitle: 'Technical Co-Founder & CTO as a Service - Automaze',
    description: 'Architecture, technical direction, and a development pipeline that builds it. What a technical co-founder gives you, without the equity.',
    canonical: 'https://automaze.io/services/cto-as-a-service',
    emptyLayout: false,
    // Unlisted until the service's launch checklist is done - keep it out of
    // the index even though the route answers.
    robots: 'noindex, nofollow'
);

// Same visual language as /services/cloud-audit.
$card = 'relative rounded-lg border border-dashed border-indigo-100 bg-gradient-to-b from-white via-white to-[#fdfdff] shadow ring-4 ring-indigo-50/50 transition-all duration-500 hover:-translate-y-1 hover:shadow-xl hover:ring-indigo-50';
$eyebrow = 'font-mono text-[11px] font-medium tracking-[0.18em] uppercase text-slate-400';
$eyebrowDark = 'font-mono text-[11px] font-medium tracking-[0.18em] uppercase text-indigo-300/70';
$primaryCTA = 'group inline-flex items-center gap-2.5 rounded-md bg-[#121834] px-7 py-4 text-[15px] font-semibold text-white shadow-xs transition-all duration-300 hover:-mt-0.5 hover:mb-0.5 hover:bg-[#0d1326] hover:shadow-xl';
$lightCTA = 'group inline-flex items-center gap-2.5 rounded-md bg-white px-7 py-4 text-[15px] font-semibold text-[#121834] shadow-xs transition-all duration-300 hover:-mt-0.5 hover:mb-0.5 hover:bg-indigo-50 hover:shadow-xl';
?>

<div id="main-content" class="relative z-10 min-h-screen bg-gradient-to-b from-indigo-50/5 via-white to-white">
    <main class="relative">

        <!-- ============ Hero ============ -->
        <section class="overflow-hidden pt-16">
            <div class="!pb-14 md:!pb-20">
                <div class="mx-auto max-w-3xl text-center">
                    <div class="flex items-center justify-center gap-4" data-aos="reveal">
                        <span class="h-px w-10 bg-slate-300" aria-hidden="true"></span>
                        <p class="<?php echo $eyebrow; ?>">Technical co-founder &amp; CTO as a service</p>
                        <span class="h-px w-10 bg-slate-300" aria-hidden="true"></span>
                    </div>
                    <h1 class="mt-6 text-4xl font-bold tracking-tight text-balance text-slate-900 md:text-6xl md:leading-[1.05]" data-aos="reveal" data-aos-delay="100">
                        Human judgment, <span class="underline decoration-indigo-300 decoration-wavy underline-offset-8">machine execution</span>
                    </h1>
                    <div class="mx-auto mt-7 max-w-2xl text-lg leading-relaxed text-slate-600 md:text-xl" data-aos="reveal" data-aos-delay="200">
                        We give you what a technical co-founder gives you &mdash; architecture, technical direction, and someone accountable for what ships &mdash; without the equity and without hiring a development team. The code gets built by our factory, running in your environment, under a process we own.
                    </div>
                    <div class="mt-10" data-aos="reveal" data-aos-delay="300">
                        <a href="<?php tiny::homeURL('/discovery-call'); ?>" class="<?php echo $primaryCTA; ?>">
                            Book a call
                            <span aria-hidden="true" class="transition-transform duration-300 group-hover:translate-x-1">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Schematic review gate: what every pull request gets before it ships. -->
                <div class="relative mx-auto mt-16 max-w-xl md:mt-20" data-aos="reveal" data-aos-delay="400">
                    <div class="<?php echo $card; ?> p-7 font-mono text-[13px] leading-relaxed text-slate-600">
                        <div class="flex items-center justify-between border-b border-dashed border-indigo-100 pb-4">
                            <span class="font-semibold text-slate-900">staging review</span>
                            <span class="text-slate-400">PR #482</span>
                        </div>
                        <div class="mt-4 space-y-3">
                            <div class="flex items-center justify-between">
                                <span>build</span>
                                <span class="flex items-center gap-2 text-slate-500"><span class="size-1.5 rounded-full bg-emerald-400" aria-hidden="true"></span>passed</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>tests</span>
                                <span class="flex items-center gap-2 text-slate-500"><span class="size-1.5 rounded-full bg-emerald-400" aria-hidden="true"></span>passed</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span>staging</span>
                                <span class="flex items-center gap-2 text-slate-500"><span class="size-1.5 animate-pulse rounded-full bg-emerald-400" aria-hidden="true"></span>live</span>
                            </div>
                        </div>
                        <div class="mt-5 flex items-center justify-between rounded-md bg-emerald-50 px-4 py-3 ring-1 ring-emerald-100">
                            <span class="font-semibold text-emerald-900">verdict</span>
                            <span class="font-semibold text-emerald-700">approved to ship</span>
                        </div>
                        <div class="mt-4 text-center text-[11px] tracking-wide text-slate-400">reviewed by a person, within one business day</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ The problem ============ -->
        <section id="the-problem">
            <h3 class="home-grid-header">
                <span>01 / The problem</span>
            </h3>
            <div>
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="section-header text-balance">The problem this solves</h2>
                </div>
                <div class="mx-auto mt-12 max-w-2xl space-y-8 text-[17px] leading-[1.9] text-slate-600">
                    <p data-aos="reveal">
                        <strong class="font-semibold text-slate-900">A technical co-founder costs you a large share of your company, permanently,</strong> and you can't undo it if it goes wrong.
                    </p>
                    <p data-aos="reveal" data-aos-delay="100">
                        <strong class="font-semibold text-slate-900">A developer costs less, but a developer without architecture produces expensive mistakes.</strong> The code gets written. Whether it was the right code is a question nobody in the room can answer.
                    </p>
                    <p data-aos="reveal" data-aos-delay="200">
                        What most founders actually need is <strong class="font-semibold text-slate-900">the judgment, not the typing</strong>.
                    </p>
                </div>
            </div>
        </section>

        <!-- ============ What we do ============ -->
        <section id="what-we-do">
            <h3 class="home-grid-header">
                <span>02 / What we do</span>
            </h3>
            <div>
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="section-header text-balance">What we do</h2>
                    <p class="text-balance">Four things, and they all point the same way: nothing ships that we wouldn't sign.</p>
                </div>

                <div class="mt-16 grid grid-cols-1 gap-6 md:grid-cols-2 2xl:gap-8">
                    <div data-aos="reveal">
                        <div class="<?php echo $card; ?> h-full p-7 before:absolute before:top-0 before:left-7 before:h-0.5 before:w-10 before:rounded-full before:bg-indigo-300">
                            <div class="font-mono text-[13px] font-semibold text-indigo-400">01</div>
                            <h3 class="mt-5 text-xl font-bold text-slate-900">We do the thinking</h3>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                Architecture, technical direction, system design. You bring the ideas and the business requirements. We turn those into specifications that can actually be built.
                            </p>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                This is where the money is. Reviewing a plan costs a fraction of reviewing the implementation of a bad plan, and we review the plan before a line of code exists.
                            </p>
                        </div>
                    </div>

                    <div data-aos="reveal" data-aos-delay="100">
                        <div class="<?php echo $card; ?> h-full p-7 before:absolute before:top-0 before:left-7 before:h-0.5 before:w-10 before:rounded-full before:bg-indigo-300">
                            <div class="font-mono text-[13px] font-semibold text-indigo-400">02</div>
                            <h3 class="mt-5 text-xl font-bold text-slate-900">We run the factory</h3>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                We install a dedicated instance of our development pipeline in your environment. It follows a strict process on every ticket. Every pull request gets its own live staging environment. Build failures and escalations route to our team automatically, so you hear about problems from us rather than from production.
                            </p>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                You pay for the tokens it consumes. The factory itself is included.
                            </p>
                        </div>
                    </div>

                    <div data-aos="reveal" data-aos-delay="200">
                        <div class="<?php echo $card; ?> h-full p-7 before:absolute before:top-0 before:left-7 before:h-0.5 before:w-10 before:rounded-full before:bg-indigo-300">
                            <div class="font-mono text-[13px] font-semibold text-indigo-400">03</div>
                            <h3 class="mt-5 text-xl font-bold text-slate-900">We own the gate</h3>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                Every change lands on staging before it lands anywhere else. We review it and give you a straight verdict: approved, approved with changes, or not ready to ship.
                            </p>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                Guaranteed within one business day.
                            </p>
                        </div>
                    </div>

                    <div data-aos="reveal" data-aos-delay="300">
                        <div class="<?php echo $card; ?> h-full p-7 before:absolute before:top-0 before:left-7 before:h-0.5 before:w-10 before:rounded-full before:bg-indigo-300">
                            <div class="font-mono text-[13px] font-semibold text-indigo-400">04</div>
                            <h3 class="mt-5 text-xl font-bold text-slate-900">We own the pipeline</h3>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                Build, test, deploy, staging infrastructure. Set up at the start, maintained by us for as long as we work together.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ What you keep ============ -->
        <section id="what-you-keep">
            <h3 class="home-grid-header">
                <span>03 / What you keep</span>
            </h3>
            <div>
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="section-header text-balance">What you keep</h2>
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-3" data-aos="reveal">
                        <span class="rounded-full border border-dashed border-indigo-200 bg-white px-5 py-2.5 font-mono text-[13px] font-medium text-slate-700 shadow-xs">Your code</span>
                        <span class="rounded-full border border-dashed border-indigo-200 bg-white px-5 py-2.5 font-mono text-[13px] font-medium text-slate-700 shadow-xs">Your accounts</span>
                        <span class="rounded-full border border-dashed border-indigo-200 bg-white px-5 py-2.5 font-mono text-[13px] font-medium text-slate-700 shadow-xs">Your infrastructure</span>
                        <span class="rounded-full border border-dashed border-indigo-200 bg-white px-5 py-2.5 font-mono text-[13px] font-medium text-slate-700 shadow-xs">Your product decisions</span>
                    </div>
                    <div class="mx-auto mt-10 max-w-2xl space-y-6 text-[16px] leading-[1.9] text-slate-600 md:text-center">
                        <p data-aos="reveal">
                            The factory runs in your environment, not ours. There's no platform to be locked into and nothing to unpick if you stop working with us.
                        </p>
                        <p class="text-[17px] font-semibold text-slate-900" data-aos="reveal" data-aos-delay="100">
                            You decide what ships. We make sure what ships is worth shipping.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ How it works ============ -->
        <section id="how-it-works">
            <h3 class="home-grid-header">
                <span>04 / How it works</span>
            </h3>
            <div>
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="section-header text-balance">How it works</h2>
                    <p class="text-balance">One loop, from ticket to shipped, the same way every time.</p>
                </div>

                <ol class="relative mx-auto mt-16 max-w-2xl list-none space-y-5 p-0 before:absolute before:top-3 before:bottom-3 before:left-[19px] before:border-l before:border-dashed before:border-indigo-200" aria-label="From ticket to shipped">
                    <?php
                    $steps = [
                        'You raise a ticket describing what you want.',
                        'We review it and shape it into a proper specification.',
                        'The factory builds it.',
                        'Every pull request gets a live staging environment.',
                        'We review staging within one business day and give you a verdict.',
                        'Failures escalate to our team automatically.',
                        'You ship.',
                    ];
                    foreach ($steps as $stepIndex => $stepText):
                        $isGate = $stepIndex === 1; // the specification step is the differentiator
                    ?>
                    <li class="relative pl-14" data-aos="reveal" data-aos-delay="<?php echo $stepIndex * 60; ?>">
                        <span class="absolute top-1/2 left-0 flex size-10 -translate-y-1/2 items-center justify-center rounded-full font-mono text-[13px] font-semibold <?php echo $isGate ? 'bg-[#121834] text-white shadow-lg' : 'border border-dashed border-indigo-200 bg-white text-indigo-400'; ?>"><?php echo str_pad((string)($stepIndex + 1), 2, '0', STR_PAD_LEFT); ?></span>
                        <?php if ($isGate): ?>
                        <div class="<?php echo $card; ?> p-6 ring-indigo-100">
                            <div class="<?php echo $eyebrow; ?> !text-indigo-400">The differentiator</div>
                            <p class="mt-2 text-[16px] font-semibold leading-relaxed text-slate-900"><?php echo $stepText; ?></p>
                            <p class="mt-2 text-[14px] leading-relaxed text-slate-500">Review happens before a line of code exists &mdash; the cheapest place to catch a mistake.</p>
                        </div>
                        <?php else: ?>
                        <p class="py-2.5 text-[16px] leading-relaxed text-slate-700"><?php echo $stepText; ?></p>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </section>

        <!-- ============ How we work together ============ -->
        <section id="how-we-work-together">
            <h3 class="home-grid-header">
                <span>05 / How we work together</span>
            </h3>
            <div>
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="section-header text-balance">How we work together</h2>
                    <p class="text-balance">Everything is written down and nothing gets lost.</p>
                </div>

                <div class="mt-16 grid grid-cols-1 gap-6 md:grid-cols-3 2xl:gap-8">
                    <div data-aos="reveal">
                        <div class="<?php echo $card; ?> h-full p-7">
                            <h3 class="text-xl font-bold text-slate-900">One call a week</h3>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                That's the only scheduled meeting. The agenda comes from what's in the system.
                            </p>
                        </div>
                    </div>
                    <div data-aos="reveal" data-aos-delay="100">
                        <div class="<?php echo $card; ?> h-full p-7">
                            <h3 class="text-xl font-bold text-slate-900">Everything else in writing</h3>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                Architecture questions, specifications, reviews, escalations &mdash; all through the ticketing system built into your factory instance. Written answers, on a record, that you can go back to.
                            </p>
                        </div>
                    </div>
                    <div data-aos="reveal" data-aos-delay="200">
                        <div class="<?php echo $card; ?> h-full p-7">
                            <h3 class="text-xl font-bold text-slate-900">One business day</h3>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                That's the longest a staging review ever waits.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ Two ways to start ============ -->
        <section id="two-ways-to-start">
            <h3 class="home-grid-header">
                <span>06 / Two ways to start</span>
            </h3>
            <div>
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="section-header text-balance">Two ways to start</h2>
                </div>

                <div class="mx-auto mt-16 grid max-w-4xl grid-cols-1 gap-6 md:grid-cols-2 2xl:gap-8">
                    <div data-aos="reveal">
                        <div class="<?php echo $card; ?> h-full p-8">
                            <div class="<?php echo $eyebrow; ?>">Existing product</div>
                            <h3 class="mt-4 text-xl font-bold text-slate-900">You already have a product</h3>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                We make your codebase ready for this way of working &mdash; documentation the factory can use, test coverage that gives it feedback, CI, staging environments, and the factory itself installed and configured.
                            </p>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                That's a one-off setup engagement, quoted based on the state of your code. Then the monthly service starts.
                            </p>
                        </div>
                    </div>
                    <div data-aos="reveal" data-aos-delay="100">
                        <div class="<?php echo $card; ?> h-full p-8">
                            <div class="<?php echo $eyebrow; ?>">Starting from nothing</div>
                            <h3 class="mt-4 text-xl font-bold text-slate-900">You're starting from nothing</h3>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                We build the first version with you over two to three months. The factory, the pipeline, and the staging setup get built as part of that work.
                            </p>
                            <p class="mt-4 text-[15px] leading-relaxed text-slate-600">
                                Then you move onto the monthly service with no setup fee, because the setup is already done.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ Pricing ============ -->
        <section id="pricing">
            <h3 class="home-grid-header">
                <span>07 / Pricing</span>
            </h3>
            <div>
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="section-header text-balance">One number, monthly</h2>
                </div>

                <div class="mx-auto mt-14 max-w-2xl" data-aos="reveal">
                    <div class="relative overflow-hidden rounded-2xl bg-[#121834] px-6 py-10 shadow-2xl ring-1 ring-white/10 sm:px-10 md:p-14">
                        <div class="pointer-events-none absolute inset-x-0 top-0 h-64 bg-[radial-gradient(ellipse_60%_100%_at_50%_0%,rgba(99,102,241,0.16),transparent)]" aria-hidden="true"></div>

                        <div class="relative">
                            <div class="<?php echo $eyebrowDark; ?>">The service</div>
                            <div class="mt-5 flex items-baseline gap-3">
                                <span class="text-5xl font-bold tracking-tight text-white md:text-6xl">$5,000</span>
                                <span class="text-lg text-slate-400">per month</span>
                            </div>

                            <ul class="mt-10 list-none space-y-3.5 p-0">
                                <?php foreach ([
                                    'Architecture and technical direction',
                                    'Specification review, before code exists',
                                    'The factory, installed in your environment',
                                    'The review gate, with a verdict in one business day',
                                    'CI and pipeline ownership',
                                    'The weekly call',
                                ] as $included): ?>
                                <li class="relative pl-7 text-[15px] leading-relaxed text-slate-300">
                                    <span class="absolute top-[9px] left-0 size-1.5 rounded-full bg-emerald-400" aria-hidden="true"></span>
                                    <?php echo $included; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>

                            <div class="mt-10 space-y-4 border-t border-dashed border-white/10 pt-8 text-[15px] leading-relaxed text-slate-400">
                                <p>
                                    Token costs are yours and go directly to the provider. Setup or the MVP sprint is quoted separately.
                                </p>
                                <p class="text-slate-200">
                                    For comparison, a technical co-founder costs you a permanent share of the company. <strong class="font-semibold text-white">This is a monthly invoice you can stop.</strong>
                                </p>
                            </div>

                            <div class="mt-10">
                                <a href="<?php tiny::homeURL('/discovery-call'); ?>" class="<?php echo $lightCTA; ?>">
                                    Book a call
                                    <span aria-hidden="true" class="transition-transform duration-300 group-hover:translate-x-1">&rarr;</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ Who we are ============ -->
        <section id="who-we-are">
            <h3 class="home-grid-header">
                <span>08 / Who we are</span>
            </h3>
            <div>
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="section-header text-balance">Who we are</h2>
                </div>
                <div class="mx-auto mt-10 max-w-2xl space-y-6 text-[17px] leading-[1.9] text-slate-600 md:text-center">
                    <p data-aos="reveal">
                        Automaze is an engineering firm of around <strong class="font-semibold text-slate-900">twenty people</strong>, with <strong class="font-semibold text-slate-900">92% client retention</strong>. We build and run yfinance, which sees more than <strong class="font-semibold text-slate-900">30 million downloads a month</strong>, and we've been building software for <strong class="font-semibold text-slate-900">35 years</strong>.
                    </p>
                    <p data-aos="reveal" data-aos-delay="100">
                        The pipeline your code moves through is the same one we use on our own products.
                    </p>
                </div>
            </div>
        </section>

        <!-- ============ FAQ ============ -->
        <section id="faq">
            <h3 class="home-grid-header">
                <span>09 / FAQ</span>
            </h3>
            <div>
                <div class="mx-auto max-w-2xl">
                    <h2 class="section-header text-balance md:text-center">Frequently asked questions</h2>
                    <p class="md:text-center">The things founders ask before the first call.</p>

                    <div class="accordion mt-12" data-aos="reveal">
                        <details name="cto-faq">
                            <summary>Do we still need developers?</summary>
                            <div>
                                <p>No. That's the point. If you have developers, they work alongside the factory and we review their work the same way.</p>
                            </div>
                        </details>

                        <details name="cto-faq">
                            <summary>Who owns the code?</summary>
                            <div>
                                <p>You do, entirely. It's in your repositories, on your infrastructure, from the first commit.</p>
                            </div>
                        </details>

                        <details name="cto-faq">
                            <summary>What happens if we stop?</summary>
                            <div>
                                <p>You keep the code, the pipeline, and the staging setup. The factory instance and the service stop. Nothing needs unpicking.</p>
                            </div>
                        </details>

                        <details name="cto-faq">
                            <summary>What if we disagree with a review?</summary>
                            <div>
                                <p>Then we talk about it. The verdict is our professional opinion, recorded so you can see the reasoning. You decide what ships &mdash; it's your product.</p>
                            </div>
                        </details>

                        <details name="cto-faq">
                            <summary>How much of your time do we get?</summary>
                            <div>
                                <p>One scheduled call a week, plus async work through the ticketing system with a one business day turnaround on staging reviews. Larger pieces of work outside that get quoted separately.</p>
                            </div>
                        </details>

                        <details name="cto-faq">
                            <summary>Can you work with our existing team?</summary>
                            <div>
                                <p>Yes. The review gate and the specification process apply to whatever produces the code.</p>
                            </div>
                        </details>

                        <details name="cto-faq">
                            <summary>Is this an AI product?</summary>
                            <div>
                                <p>No. It's an engineering service. The factory is how we deliver, not what you're buying. What you're paying for is judgment about what to build and whether it's safe to ship.</p>
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
                    <h2 class="mt-5 text-4xl font-semibold tracking-tight text-balance text-white md:text-5xl" data-aos="reveal">We bring the judgment. The machine does the typing.</h2>
                    <div class="mt-5 text-lg leading-relaxed text-slate-400" data-aos="reveal" data-aos-delay="100">
                        One call to see whether this fits what you're building.
                    </div>
                    <div class="mt-10 flex items-center justify-center" data-aos="reveal" data-aos-delay="200">
                        <a href="<?php tiny::homeURL('/discovery-call'); ?>" class="<?php echo $lightCTA; ?>">
                            Book a call
                            <span aria-hidden="true" class="transition-transform duration-300 group-hover:translate-x-1">&rarr;</span>
                        </a>
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
