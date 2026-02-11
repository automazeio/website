        <div class="bleed-frame" :class=" expandedService == 'cto' ? 'bleed-frame-expanded' : 'bleed-frame-closed'" id="services-cto"
            @click="expandedService == 'cto' ? expandedService = null : (expandedService = 'cto', $nextTick(() => $el.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' })))">
            <div class="bleed-top"></div>
            <div class="bleed-content group">
                <div>
                    <div class="service-image">
                        <img alt="Automaze CTO as a Service" src="<?php tiny::staticURL('img/service-cto.svg'); ?>" class="size-26" />
                    </div>
                    <h3 class="mt-6 font-bold" :class="expandedService == 'cto' ? 'text-2xl' : 'text-xl'">CTO as a Service</h3>
                    <template x-if="expandedService != 'cto'">
                        <div>
                            <p class="mt-4 text-[15px] leading-relaxed">
                                <strong>Strategic tech leadership</strong> without a full-time hire. Get expert technical planning and product architecture that turn your vision into a clear, buildable roadmap.
                            </p>
                            <div x-show="expandedService != 'cto'" class="w-fit text-[14px] mt-6 rounded-md group-hover:shadow-xs border border-transparent group-hover:pl-4 group-hover:pr-3 py-3 leading-none font-medium text-slate-600 group-hover:!border-indigo-100 group-hover:!bg-indigo-50/25 transition-all duration-400">Learn more →</div>
                        </div>
                    </template>
                    <template x-if="expandedService == 'cto'">
                        <section>
                            <p class="mt-2 mb-4 text-xl text-slate-600 leading-relaxed">
                                Senior technical leadership without the full-time commitment.
                            </p>
                            <p class="leading-relaxed mb-4">
                                We step in as your CTO, owning technical direction, product architecture, and execution standards from day one. From early product decisions to scaling challenges, we make sure what you build is sound, scalable, and aligned with your business goals.
                            </p>
                            <p class="leading-relaxed mb-6">
                                You stay focused on the business. We own the tech.
                            </p>
                            <p>
                                <a href="/discovery-call" class="text-[14px] font-medium text-sky-500 hover:font-bold hover:border-b hover:border-slate-200 pb-0.5 transition-all" data-discovery-location="link Book a call in services cto">Book a call →</a>
                            </p>
                        </section>
                    </template>
                </div>
            </div>
            <div class="bleed-bottom"></div>
        </div>

        <div class="bleed-frame" :class="expandedService == 'mvp' ? 'bleed-frame-expanded' : 'bleed-frame-closed'" id="services-mvp"
            @click="expandedService == 'mvp' ? expandedService = null : (expandedService = 'mvp', $nextTick(() => $el.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' })))">
            <div class="bleed-top"></div>
            <div class="bleed-content group">
                <div>
                    <div class="service-image">
                        <img alt="Build your MVP" src="<?php tiny::staticURL('img/service-pm.svg'); ?>" class="size-28" />
                    </div>
                    <h3 class="mt-6 font-bold" :class="expandedService == 'mvp' ? 'text-2xl' : 'text-xl'">MVP Launch</h3>
                    <template x-if="expandedService != 'mvp'">
                        <div>
                            <p class="mt-4 text-[15px] leading-relaxed">
                                <strong>A focused sprint</strong> to turn your idea into a working product. We set tight scope, move fast, and launch what truly matters in record time. No fluff, just results.
                            </p>
                            <div class="w-fit text-[14px] mt-6 rounded-md group-hover:shadow-xs border border-transparent group-hover:pl-4 group-hover:pr-3 py-3 leading-none font-medium text-slate-600 group-hover:!border-indigo-100 group-hover:!bg-indigo-50/25 transition-all duration-400">Learn more →</div>
                        </div>
                    </template>
                    <template x-if="expandedService == 'mvp'">
                        <section>
                            <p class="mt-2 mb-4 text-xl text-slate-600 leading-relaxed">
                                From idea to live product, fast.
                            </p>
                            <p class="leading-relaxed mb-4">
                                We help you define the smallest product that actually proves something, then build and launch it quickly. No over-engineering, no endless planning cycles. Just a clear scope, fast execution, and a live product in users' hands.
                            </p>
                            <p class="leading-relaxed mb-6">
                                Launch fast. Learn faster.
                            </p>
                            <p>
                                <a href="/discovery-call" class="text-[14px] font-medium text-sky-500 hover:font-bold hover:border-b hover:border-slate-200 pb-0.5 transition-all" data-discovery-location="link Book a call in services mvp">Book a call →</a>
                            </p>
                        </section>
                    </template>
                </div>
            </div>
            <div class="bleed-bottom"></div>
        </div>

        <div class="bleed-frame" :class="expandedService == 'ai' ? 'bleed-frame-expanded' : 'bleed-frame-closed'" id="services-ai"
            @click="expandedService == 'ai' ? expandedService = null : (expandedService = 'ai', $nextTick(() => $el.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' })))">
            <div class="bleed-top"></div>
            <div class="bleed-content group">
                <div>
                    <div class="service-image">
                        <img alt="Automaze AI Agents" src="<?php tiny::staticURL('img/service-ai.svg'); ?>" class="size-48 !-mt-1 !-mb-5.5" />
                    </div>
                    <h3 class="mt-6 font-bold" :class="expandedService == 'ai' ? 'text-2xl' : 'text-xl'">AI Agents &amp; Automations</h3>
                    <template x-if="expandedService != 'ai'">
                        <div>
                            <p class="mt-4 text-[15px] leading-relaxed">
                                <strong>Run like a one-person company.</strong> We build AI agents that automate your daily tasks so you can scale operations without growing your headcount.
                            </p>
                            <div class="w-fit text-[14px] mt-6 rounded-md group-hover:shadow-xs border border-transparent group-hover:pl-4 group-hover:pr-3 py-3 leading-none font-medium text-slate-600 group-hover:!border-indigo-100 group-hover:!bg-indigo-50/25 transition-all duration-400">Learn more →</div>
                        </div>
                    </template>
                    <template x-if="expandedService == 'ai'">
                        <section>
                            <p class="mt-2 mb-4 text-xl text-slate-600 leading-relaxed">
                                Custom AI that runs parts of your business for you.
                            </p>
                            <p class="leading-relaxed mb-4">
                                We design and build AI agents tailored to your workflows, handling research, operations, support, data processing, and internal tasks so you can scale output without scaling headcount.
                            </p>
                            <p class="leading-relaxed mb-6">
                                Think leverage, not automation theatre.
                            </p>
                            <p>
                                <a href="/discovery-call" class="text-[14px] font-medium text-sky-500 hover:font-bold hover:border-b hover:border-slate-200 pb-0.5 transition-all" data-discovery-location="link Book a call in services ai">Book a call →</a>
                            </p>
                        </section>
                    </template>
                </div>
            </div>
            <div class="bleed-bottom"></div>
        </div>

        <div class="bleed-frame" :class="expandedService == 'dev' ? 'bleed-frame-expanded' : 'bleed-frame-closed'" id="services-dev"
            @click="expandedService == 'dev' ? expandedService = null : (expandedService = 'dev', $nextTick(() => $el.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' })))">
            <div class="bleed-top"></div>
            <div class="bleed-content group">
                <div>
                    <div class="service-image">
                        <img alt="Automaze Software Development" src="<?php tiny::staticURL('img/service-dev.svg'); ?>" class="size-27" />
                    </div>
                    <h3 class="mt-6 font-bold" :class="expandedService == 'dev' ? 'text-2xl' : 'text-xl'">Managed Developers</h3>
                    <template x-if="expandedService != 'dev'">
                        <div>
                            <p class="mt-4 text-[15px] leading-relaxed">
                                Web, mobile, internal tools - get a team of developers, with <strong>every skill you need</strong> under one roof. No silos, no handoffs. Just startup speed and enterprise quality.
                            </p>
                            <div class="w-fit text-[14px] mt-6 rounded-md group-hover:shadow-xs border border-transparent group-hover:pl-4 group-hover:pr-3 py-3 leading-none font-medium text-slate-600 group-hover:!border-indigo-100 group-hover:!bg-indigo-50/25 transition-all duration-400">Learn more →</div>
                        </div>
                    </template>
                    <template x-if="expandedService == 'dev'">
                        <section>
                            <p class="mt-2 mb-4 text-xl text-slate-600 leading-relaxed">
                                Senior oversight for teams that already have developers.
                            </p>
                            <p class="leading-relaxed mb-4">
                                We provide strong technical leadership to keep your team shipping the right things, the right way. From architecture decisions to code quality and delivery flow, we help you avoid costly mistakes and maintain momentum.
                            </p>
                            <p class="leading-relaxed mb-6">
                                Your developers build. We make sure it all makes sense.
                            </p>
                            <p>
                                <a href="/discovery-call" class="text-[14px] font-medium text-sky-500 hover:font-bold hover:border-b hover:border-slate-200 pb-0.5 transition-all" data-discovery-location="link Book a call in services managed developers">Book a call →</a>
                            </p>
                        </section>
                    </template>
                </div>
            </div>
            <div class="bleed-bottom"></div>
        </div>

        <?php /*
        <div class="bleed-frame" :class="expandedService == 'consulting' ? 'bleed-frame-expanded' : 'bleed-frame-closed'" id="services-consulting"
            @click="expandedService == 'consulting' ? expandedService = null : (expandedService = 'consulting', $nextTick(() => $el.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' })))">
            <div class="bleed-top"></div>
            <div class="bleed-content group">
                <div>
                    <div class="service-image pt-1">
                        <img alt="Automaze Consulting" src="<?php tiny::staticURL('img/service-ux.svg'); ?>" class="size-27" />
                    </div>
                    <h3 class="mt-6 font-bold" :class="expandedService == 'consulting' ? 'text-2xl' : 'text-xl'">Tech Leadership &amp; Consulting</h3>
                    <template x-if="expandedService != 'consulting'">
                        <div>
                            <p class="mt-4 text-[15px] leading-relaxed">
                                Senior technical leadership to help founders make confident architecture, hiring, and delivery decisions, keeping teams focused and products moving forward.
                            </p>
                            <div class="w-fit text-[14px] mt-6 rounded-md group-hover:shadow-xs border border-transparent group-hover:pl-4 group-hover:pr-3 py-3 leading-none font-medium text-slate-600 group-hover:!border-indigo-100 group-hover:!bg-indigo-50/25 transition-all duration-400">Learn more →</div>
                        </div>
                    </template>
                    <template x-if="expandedService == 'consulting'">
                        <section>
                            <p class="mt-2 mb-4 text-xl text-slate-600 leading-relaxed">
                                Hands-on guidance from someone who's built it before.
                            </p>
                            <p class="leading-relaxed mb-4">
                                We provide hands-on technical leadership for founders and teams who need clarity, momentum, and senior decision-making without hiring a full-time CTO. From architecture and stack decisions to delivery processes and hiring strategy, we step in where experience matters most.
                            </p>
                            <p class="leading-relaxed mb-6">
                                No slides. No theory. Just practical leadership and clear decisions.
                            </p>
                            <p>
                                <a href="/discovery-call" class="text-[14px] font-medium text-sky-500 hover:font-bold hover:border-b hover:border-slate-200 pb-0.5 transition-all" data-discovery-location="link Book a call in services consulting">Book a call →</a>
                            </p>
                        </section>
                    </template>
                </div>
            </div>
            <div class="bleed-bottom"></div>
        </div>
        */ ?>

        <div class="bleed-frame" :class="expandedService == 'devops' ? 'bleed-frame-expanded' : 'bleed-frame-closed'" id="services-devops"
            @click="expandedService == 'devops' ? expandedService = null : (expandedService = 'devops', $nextTick(() => $el.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' })))">
            <div class="bleed-top"></div>
            <div class="bleed-content group">
                <div>
                    <div class="service-image">
                        <img alt="Automaze DevOps & Cloud" src="<?php tiny::staticURL('img/service-devops.svg'); ?>" class="size-27" />
                    </div>
                    <h3 class="mt-6 font-bold" :class="expandedService == 'devops' ? 'text-2xl' : 'text-xl'">DevOps &amp; Cloud</h3>
                    <template x-if="expandedService != 'devops'">
                        <div>
                            <p class="mt-4 text-[15px] leading-relaxed">
                                We streamline infrastructure to <strong>reduce cloud costs</strong>, speed up deploys, and take the financial and mental loads out of scaling and ongoing operations.
                            </p>
                            <div class="w-fit text-[14px] mt-6 rounded-md group-hover:shadow-xs border border-transparent group-hover:pl-4 group-hover:pr-3 py-3 leading-none font-medium text-slate-600 group-hover:!border-indigo-100 group-hover:!bg-indigo-50/25 transition-all duration-400">Learn more →</div>
                        </div>
                    </template>
                    <template x-if="expandedService == 'devops'">
                        <section>
                            <p class="mt-2 mb-4 text-xl text-slate-600 leading-relaxed">
                                Cut infrastructure costs without breaking production.
                            </p>
                            <p class="leading-relaxed mb-4">
                                We audit your existing infrastructure to identify real, meaningful savings. If we find them, we handle the migration and optimisation. Our model is simple: we get paid from a share of the savings over six months.
                            </p>
                            <p class="leading-relaxed mb-6 font-semibold">
                                If we don't save you money, you don't pay.
                            </p>
                            <p>
                                <a href="/discovery-call" class="text-[14px] font-medium text-sky-500 hover:font-bold hover:border-b hover:border-slate-200 pb-0.5 transition-all" data-discovery-location="link Book a call in services devops">Book a call →</a>
                            </p>
                        </section>
                    </template>
                </div>
            </div>
            <div class="bleed-bottom"></div>
        </div>
