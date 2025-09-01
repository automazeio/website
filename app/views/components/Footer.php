<?php
tiny::components()->register('Footer', function (...$props) {
    $props['year'] = $props['year'] ?? date('Y');
    $props['rootPath'] = tiny::getHomeURL('/');
    return <<<EOF

    <footer id="footer">
        <div class="mx-auto max-w-5xl xl:max-w-6xl 2xl:max-w-7xl text-slate-300/80 text-sm">

            <button onclick="mobileMenu.close()" id="mobile-menu-close" class="hidden absolute right-7 top-5 text-3xl">🆇</button>

            <div class="md:flex items-start justify-between px-9 pt-20 md:pt-30">
                <div class="max-w-sm leading-relaxed mb-12">
                    <p><a href="{$props['rootPath']}"><img loading="lazy" src="https://automaze.io/assets/automaze-min.png" alt="Automaze logo" class="size-12" /></a></p>
                    <p class="mt-4">At Automaze, we partner with founders to bring their vision to life, scale their business, and optimize for success.</p>
                    <div class="flex items-end space-x-4 mt-6">
                        <a href="http://x.com/intent/follow?screen_name=automazeio" target="_blank" class="text-slate-400 hover:text-slate-200 transition-all"><svg
                          viewBox="0 0 1200 1227" ill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="size-4 mb-0.5 " fill="currentColor">
                            <path d="M714.163 519.284L1160.89 0H1055.03L667.137 450.887L357.328 0H0L468.492 681.821L0 1226.37H105.866L515.491 750.218L842.672 1226.37H1200L714.137 519.284H714.163ZM569.165 687.828L521.697 619.934L144.011 79.6944H306.615L611.412 515.685L658.88 583.579L1055.08 1150.3H892.476L569.165 687.854V687.828Z" />
                        </svg></a>
                        <a href="https://www.linkedin.com/company/automazeio" target="_blank" class="text-slate-400 hover:text-slate-200 transition-all"><svg
                          xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="size-6" stroke="currentColor">
                            <path d="M6.5 9.5H2V22H6.5V9.5Z"></path>
                            <path d="M6.5 4.25C6.5 5.49264 5.49264 6.5 4.25 6.5C3.00736 6.5 2 5.49264 2 4.25C2 3.00736 3.00736 2 4.25 2C5.49264 2 6.5 3.00736 6.5 4.25Z"></path>
                            <path d="M14.0001 9.5H9.5V22H14.0001V15.7502C14.0001 14.7837 14.7835 14.0002 15.75 14.0002C16.7165 14.0002 17.5 14.7837 17.5 15.7502V22H21.9987L22.0001 14.0002C22.0001 11.515 19.6364 9.50024 17.2968 9.50024C15.9649 9.50024 14.7767 10.1531 14.0001 11.174V9.5Z"></path>
                        </svg></a>
                        <a href="https://github.com/automazeio" target="_blank" class="text-slate-400 hover:text-slate-200 transition-all"><svg
                          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="none" stroke-width="16" stroke="currentColor" class="size-5 -mb-px -ml-0.5">
                            <path d="M119.83,56A52,52,0,0,0,76,32a51.92,51.92,0,0,0-3.49,44.7A49.28,49.28,0,0,0,64,104v8a48,48,0,0,0,48,48h48a48,48,0,0,0,48-48v-8a49.28,49.28,0,0,0-8.51-27.3A51.92,51.92,0,0,0,196,32a52,52,0,0,0-43.83,24Z"></path>
                            <path d="M104,232V192a32,32,0,0,1,32-32h0a32,32,0,0,1,32,32v40"></path>
                            <path d="M104,208H72a32,32,0,0,1-32-32A32,32,0,0,0,8,144"></path>
                        </svg></a>
                    </div>
                    <div class="hidden md:block">
                        <p class="font-mono tracking-tighter mt-8 text-slate-500 text-[13px]">&copy; {$props['year']} Automaze, Ltd.</p>
                        <p class="font-mono tracking-tighter mt-4 text-[13px] text-slate-500">HQ: 71-75 Shelton Street, WC2H 9JQ, London, UK</p>
                        <p class="font-mono tracking-tighter text-[13px] text-slate-500">Made with ❤️ <a href="{$props['rootPath']}about" class="border-b border-dotted hover:text-slate-200 transition-all">around the world</a>.</p>
                    </div>
                </div>

                <nav class="grid grid-cols-2 md:flex items-start space-x-8 pt-8">
                    <ul class="w-30">
                        <li><h4>Company</h4></li>
                        <li><a href="{$props['rootPath']}about">About</a></li>
                        <li><a href="https://secret.automaze.io" target="_blank">Perks for Client</a></li>
                        <li><a href="{$props['rootPath']}pricing">Pricing</a></li>
                        <li><a href="{$props['rootPath']}podcast">Podcast</a></li>
                        <li><a href="{$props['rootPath']}contact">Contact</a></li>
                    </ul>
                    <ul class="w-40">
                        <li><h4>Services</h4></li>
                        <li><a href="{$props['rootPath']}services/cto-as-a-service">CTO as a Service</a></li>
                        <li><a href="{$props['rootPath']}services/mvp-launch">MVP Launch</a></li>
                        <li><a href="{$props['rootPath']}services/managed-developers">Managed Developers</a></li>
                        <li><a href="{$props['rootPath']}services/ai-agents">Custom AI Agents</a></li>
                        <li><a href="{$props['rootPath']}services/devops-optimization">DevOps &amp; Cloud</a></li>
                        <li><a href="{$props['rootPath']}services/design-subscription">UX/UI Design</a></li>
                    </ul>

                    <ul class="w-16 mr-2">
                        <li><h4>Legal</h4></li>
                        <li><a href="{$props['rootPath']}privacy">Privacy</a></li>
                        <li><a href="{$props['rootPath']}terms">Terms</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col-span-2 md:hidden p-9 pt-0 -mt-6 text-center">
                <p class="font-mono tracking-tighter mt-8 text-slate-500 text-[13px]">&copy; {$props['year']} Automaze, Ltd.</p>
                <p class="font-mono tracking-tighter text-[13px] text-slate-500">Made with ❤️ <a href="{$props['rootPath']}about" class="border-b border-dotted hover:text-slate-200 transition-all">around the world</a>.</p>
            </div>

            <div class="col-span-2 text-center leading-none relative -z-10 overflow-x-hidden no-scrollbar">
                <span class="stroked">automaze</span>
            </div>
        </div>
    </footer>
    EOF;
});

/*
                    <ul class="w-28 md:hidden">
                        <li><h4>Products</h4></li>
                        <li><a href="https://asynchq.com" target="_blank">AsyncHQ</a></li>
                        <li><a href="https://refund.now" target="_blank">Refund.now</a></li>
                        <li><a href="https://disputepal.co" target="_blank">DisputePal</a></li>
                        <li><a href="https://corpus.chat" target="_blank">Corpus.Chat</a></li>
                        <li><a href="https://premarketbell.com" target="_blank">Premarket Bell</a></li>
                        <li><a href="https://moderate.ai" target="_blank">Moderate.AI</a></li>
                    </ul>
*/
