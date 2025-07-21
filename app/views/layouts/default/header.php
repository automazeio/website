<div class="flex min-h-screen">
    <div class="fixed inset-0 z-10 bg-black/50 lg:hidden" x-show="sidebar" @click="sidebar = false"></div>
    <aside class="fixed left-0 z-20 lg:mr-0 h-screen w-[234px] border-r border-slate-200 bg-white transition-all duration-500 lg:min-w-[234px]" :class="{'left-0': sidebar, '-left-64 lg:!left-0': !sidebar}">

        <header class="mt-0.5 flex items-center justify-between p-6">
            <a href="<?php tiny::homeUrl('/'); ?>"><svg width="48" height="30" viewBox="0 0 48 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M24.0012 0C24.0012 0 35.0514 0 36.6799 0C38.3083 0 44.9245 2.03203 44.9245 9.41484C44.9245 16.7977 38.3083 18.6141 36.738 18.6141L48 30H37.5709L26.4043 18.75C26.4043 18.75 15.0446 18.75 14.3467 18.75C13.6488 18.75 11.2829 17.6227 11.2829 15.0398C11.2829 12.457 13.6488 11.25 14.3467 11.25C15.0446 11.25 35.3422 11.25 35.7493 11.25C36.1564 11.25 37.5337 10.8984 37.5337 9.41484C37.5337 7.93125 36.196 7.59844 35.7493 7.59844C35.3027 7.59844 15.0446 7.59844 14.3467 7.59844C13.6488 7.59844 7.5607 8.59453 7.5607 15.0398C7.5607 21.4852 13.6488 22.657 14.3467 22.657C15.0446 22.657 24.3897 22.657 24.3897 22.657L31.6386 29.9602C31.6386 29.9602 15.0446 29.9602 14.3467 29.9602C10.8339 29.9602 0 27.1102 0 15.0398C0 3.2625 10.8572 0 14.3467 0C16.0124 0 24.0012 0 24.0012 0Z" fill="#5667E7"/>
            </svg></a>
            <svg @click="sidebar = false" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-slot="icon" class="mt-0.5 -mr-1 size-6 cursor-pointer rounded-md transition-all duration-500 hover:bg-[#5667e7] hover:p-0.5 hover:text-white lg:hidden">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
            </svg>
        </header>

        <nav class="py-4 text-[15px] text-slate-500">
            <ul>
                <li class="py-px">
                    <a href="<?php tiny::homeUrl('/profile'); ?>" class="flex items-center space-x-3 px-5 py-2 font-medium transition-colors duration-500 hover:bg-neutral-100 <?php
                    if (tiny::router()->controller == 'profile') {
                        echo 'text-[#5667e7]';
                    } else {
                        echo 'hover:text-slate-800';
                    }
                    ?>">
                        <svg fill="none" stroke-width="1.75" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-slot="icon" class="size-6.5 text-slate-500/80">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                        </svg>
                        <span class="w-full">Profile</span>
                    </a>
                </li>
                <li class="py-px">
                    <a href="<?php tiny::homeUrl('/keys'); ?>" class="flex items-center space-x-3 px-5 py-2 font-medium transition-colors duration-500 hover:bg-neutral-100 <?php
                    if (tiny::router()->controller == 'keys') {
                        echo 'text-[#5667e7]';
                    } else {
                        echo 'hover:text-slate-800';
                    }
                    ?>">
                    <svg fill="none" stroke-width="1.75" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-slot="icon" class="size-6.5 text-slate-500/80">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z"></path>
                        </svg>
                        <span class="w-full">API Keys</span>
                    </a>
                </li>

                <?php if (tiny::user()->is_admin || tiny::user()->allow->create_sub_accounts || tiny::user()->allow->manage_accounts): ?>
                <li class="py-px">
                    <a href="<?php tiny::homeUrl('/accounts'); ?>" class="flex items-center space-x-3 px-5 py-2 font-medium transition-colors duration-500 hover:bg-neutral-100 <?php
                    if (tiny::router()->controller == 'accounts') {
                        echo 'text-[#5667e7]';
                    } else {
                        echo 'hover:text-slate-800';
                    }
                    ?>">
                        <svg fill="none" stroke-width="1.75" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-slot="icon" class="size-6.5 text-slate-500/80">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"></path>
                        </svg>
                        <span class="w-full">Accounts</span>
                    </a>
                </li>
                <?php endif; ?>
                <li class="py-px">
                    <a href="<?php tiny::homeUrl('/usage'); ?>" class="flex items-center space-x-3 px-5 py-2 font-medium transition-colors duration-500 hover:bg-neutral-100 <?php
                    if (tiny::router()->controller == 'usage') {
                        echo 'text-[#5667e7]';
                    } else {
                        echo 'hover:text-slate-800';
                    }
                    ?>">
                        <svg fill="none" stroke-width="1.75" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-slot="icon" class="size-6.5 text-slate-500/80">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z"></path>
                        </svg>
                        <span class="w-full">Usage log</span>
                    </a>
                </li>
                <?php if (tiny::user()->billing_account->is_owner || tiny::user()->is_admin): ?>
                <li class="py-px">
                    <div class="flex items-center space-x-3 px-5 py-2 font-medium transition-colors duration-500 hover:bg-neutral-100 <?php
                    if (tiny::router()->controller == 'billing') {
                        echo 'text-[#5667e7]';
                    } else {
                        echo 'hover:text-slate-800';
                    }
                    ?>">
                        <svg fill="none" stroke-width="1.75" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-slot="icon" class="size-6.5 text-slate-500/80">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3"></path>
                        </svg>
                        <div class="flex w-full items-center space-x-3">
                            <span class="w-full">Billing</span>
                            <svg class="size-4" fill="none" stroke-width="1.75" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"></path>
                            </svg>
                        </div>
                    </div>
                    <ul class="text-sm">
                        <?php if (tiny::user()->is_admin || !tiny::user()->billing_account->is_legacy): ?>
                        <li><a class="block py-2.5 pl-14 <?php
                            if (tiny::router()->controller == 'billing' && tiny::router()->section == 'credits') {
                                echo 'text-[#5667e7] bg-neutral-100/60';
                            } else {
                                echo 'hover:text-[#5667e7] hover:bg-neutral-100/60';
                            }
                        ?>" href="<?php tiny::homeUrl('/billing/credits'); ?>">Credits</a></li>
                        <?php endif; ?>
                        <?php if (tiny::user()->is_admin): ?>
                        <li><a class="block py-2.5 pl-14 <?php
                            if (tiny::router()->controller == 'billing' && tiny::router()->section == 'transactions') {
                                echo 'text-[#5667e7] bg-neutral-100/60';
                            } else {
                                echo 'hover:text-[#5667e7] hover:bg-neutral-100/60';
                            }
                        ?>" href="<?php tiny::homeUrl('/billing/transactions'); ?>">Transactions</a></li>
                        <?php endif; ?>
                        <li><a class="block py-2.5 pl-14 <?php
                            if (tiny::router()->controller == 'billing' && tiny::router()->section == 'subscription') {
                                echo 'text-[#5667e7] bg-neutral-100/60';
                            } else {
                                echo 'hover:text-[#5667e7] hover:bg-neutral-100/60';
                            }
                        ?>" href="<?php tiny::homeUrl('/billing/subscription'); ?>">Subscription</a></li>
                        <?php if (tiny::user()->is_admin): ?>
                        <li><a class="block py-2.5 pl-14 <?php
                            if (tiny::router()->controller == 'billing' && tiny::router()->section == 'settlements') {
                                echo 'text-[#5667e7] bg-neutral-100/60';
                            } else {
                                echo 'hover:text-[#5667e7] hover:bg-neutral-100/60';
                            }
                        ?>" href="<?php tiny::homeUrl('/billing/settlements'); ?>">Settlements</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <li>
                    <div class="m-6 h-px border-b border-slate-200"></div>
                </li>
                <li>
                    <a href="<?php tiny::homeUrl('/go/app'); ?>" class="m-5 group no-underline py-2 pl-2 pr-2.5 text-center block text-sm font-medium rounded-md transition-all duration-150 cursor-pointer border-b text-white hover:opacity-90 active:opacity-100 shadow-2xs focus:bg-neutral-50 border-indigo-700 bg-indigo-600">
                        ← Campaign Refinery
                    </a>
                </li>
                <?php /*
                <li>
                    <a href="<?php tiny::homeUrl('/go/toolbox'); ?>" class="m-5 group no-underline py-2 pl-2 pr-2.5 text-center block text-sm font-medium rounded-md transition-all duration-150 cursor-pointer border-b text-white hover:opacity-90 active:opacity-100 shadow-2xs focus:bg-neutral-50 border-indigo-700 bg-indigo-600">
                        ← Toolbox
                    </a>
                </li>
                */ ?>
                <?php if (tiny::user()->is_admin): ?>
                    <li>
                        <div class="m-6 h-px border-b border-slate-200"></div>
                    </li>
                    <li>
                        <a href="https://app.campaignrefinery.com/admincp/accounts" class="text-[#5667e7] flex items-center space-x-2 px-5 py-2.5 font-medium transition-colors duration-500 hover:text-[#5667e7] group">
                            <span>←</span>
                            <span class="border-b border-white group-hover:border-inherit">Admin panel</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <footer class="absolute inset-x-0 bottom-0 border-t border-slate-200 p-6 text-center text-sm">
            <?php if (tiny::user()->billing_account->is_owner): ?>
                <div class="font-semibold">Credits: <?php echo number_format(tiny::user()->billing_account->total_credits); ?></div>
                <?php if (tiny::user()->billing_account->prepaid_credits > 0): ?>
                    <div class="opacity-50">(<?php echo number_format(tiny::user()->billing_account->prepaid_credits); ?> prepaid)</div>
                <?php endif; ?>
                <div class="opacity-50">Cycle use: <?php echo number_format(tiny::user()->account->current_cycle_credit_usage); ?></div>
            <?php else: ?>
                <div class="font-semibold"><?php echo number_format(tiny::user()->account->current_cycle_credit_usage); ?></div>
                <div class="opacity-50">Credits used</div>
            <?php endif; ?>
            <a href="<?php tiny::homeUrl('/usage'); ?>" class="m-auto mt-4 block w-fit rounded border border-gray-200 px-4 py-2 text-xs font-medium text-slate-800 transition-colors duration-300 hover:border-[#5667e7] hover:text-[#5667e7] hover:shadow-xs">Credit Usage</a>
        </footer>
    </aside>

    <main class="w-full lg:w-[calc(100%_-_234px)] lg:ml-[234px]">
        <header class="min-h-18 lg:min-h-24 lg:border-b bg-white z-10 relative <?php
        if (tiny::router()->controller == 'accounts' && (tiny::user()->is_admin || tiny::user()->allow->create_sub_accounts || tiny::user()->allow->manage_accounts)) {
            echo 'border-white';
        } else {
            echo 'border-slate-200';
        }
        ?>">
            <div class="fixed inset-x-0 top-0 z-10 flex items-start justify-between border-b border-slate-200 bg-white px-8 pt-5 pb-3 lg:relative lg:border-0 lg:pb-1">
                <div class="flex items-center">
                    <svg @click="sidebar = true" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-slot="icon" class="-mt-1 mr-3 -ml-1 size-8 cursor-pointer rounded-md transition-all duration-500 hover:bg-[#5667e7] hover:p-0.5 hover:text-white lg:hidden">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                    </svg>
                    <div class="mt-1 mb-2.5 text-base text-slate-500">
                    <?php if (tiny::user()->is_admin): ?>
                        <a href="https://app.campaignrefinery.com/admincp/accounts/edit-account/id/<?php echo tiny::user()->account->id; ?>" target="_blank" class="rounded-sm bg-neutral-100 text-black transition-colors duration-300 hover:bg-[#5667e7] hover:text-white px-2.5 py-1">Admin view</a> &nbsp;
                        <span class="hidden md:inline"><?php echo tiny::user()->account->login_email; ?> / </span> <?php echo tiny::user()->account->hash; ?>
                    <?php else: ?>
                        <h1 class="-mb-px text-2xl font-bold text-black lg:hidden"><?php echo tiny::layout()->props('title', 'Account'); ?></h1>
                        <span class="hidden lg:flex items-center">
                        <?php if (tiny::user()->owner->id != tiny::user()->id): ?>
                            <a href="<?php tiny::homeUrl('/go/owner?redir=' . urlencode(tiny::router()->uri)); ?>"
                            tooltip="Back&nbsp;to&nbsp;manager&nbsp;view" tooltip-position="right"
                            class="flex items-center font-medium space-x-1 text-indigo-500 hover:underline"
                            ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                                <path fill-rule="evenodd" d="M1 2.75A.75.75 0 0 1 1.75 2h10.5a.75.75 0 0 1 0 1.5H12v13.75a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1-.75-.75v-2.5a.75.75 0 0 0-.75-.75h-2.5a.75.75 0 0 0-.75.75v2.5a.75.75 0 0 1-.75.75h-2.5a.75.75 0 0 1 0-1.5H2v-13h-.25A.75.75 0 0 1 1 2.75ZM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM4.5 9a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM8 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM8.5 9a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM14.25 6a.75.75 0 0 0-.75.75V17a1 1 0 0 0 1 1h3.75a.75.75 0 0 0 0-1.5H18v-9h.25a.75.75 0 0 0 0-1.5h-4Zm.5 3.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm.5 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z" clip-rule="evenodd" />
                            </svg>
                            <span>Account Manager</span></a>
                            &nbsp;/ <?php echo tiny::user()->account->login_email; ?>
                        <?php else: ?>
                            Account Portal
                        <?php endif; ?>
                        </span>
                    <?php endif; ?>

                    </div>
                </div>
                <div class="relative flex items-center" x-data="{ open: false }" @click.outside="open = false">
                    <?php if (tiny::user()->show_oto_offer): ?>
                        <a href="<?php tiny::homeUrl('/oto'); ?>"
                            class="flex items-center rounded-md px-2.5 mt-1.5 md:mt-0 py-1.5 text-xs font-medium text-green-700 transition-all duration-500 hover:animate-none  hover:bg-green-200 subpixel-antialiased relative">
                            <div class="animate-pulse bg-green-100 absolute inset-0 rounded-md"></div>
                            <span class="mt-px relative">🎁</span> <span class="relative mx-1 text-xs font-mono tracking-tight hidden md:inline">30% OFF offer
                                <span id="countdown-timer" data-target="<?php echo date('Y-m-d\TH:i:s\Z', strtotime(tiny::user()->billing_account->created_at . ' +1 day')); ?>" class="font-mono whitespace-nowrap"></span></span>
                            <script>
                                (function() {
                                    const countdownEl = document.getElementById('countdown-timer');
                                    const targetDate = new Date(countdownEl.dataset.target);

                                    function updateCountdown() {
                                        const now = new Date();
                                        const diff = targetDate - now;

                                        if (diff <= 0) {
                                            countdownEl.textContent = 'expired';
                                            return;
                                        }

                                        const hours = Math.floor(diff / (1000 * 60 * 60));
                                        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                                        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                                        const formattedHours = hours.toString().padStart(2, '0');
                                        const formattedMinutes = minutes.toString().padStart(2, '0');
                                        const formattedSeconds = seconds.toString().padStart(2, '0');

                                        countdownEl.textContent = `expires in ${formattedHours}h, ${formattedMinutes}m, ${formattedSeconds}s`;
                                    }
                                    updateCountdown();
                                    setInterval(updateCountdown, 1000);
                                })();
                            </script>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty(tiny::user()->account->agency_invite_uuid)): ?>
                        <a href="<?php tiny::homeUrl('/invite/agency/'. tiny::user()->account->agency_invite_uuid); ?>" class="flex animate-pulse items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-red-500 transition-all duration-500 hover:animate-none hover:bg-slate-100">
                        <svg fill="none" stroke-width="1.75" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-slot="icon" class="mr-1 size-4 -mt-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z"></path>
                        </svg>
                        <span class="text-xs">You have a pending invitation</span>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty(tiny::user()->account->pending_login_email) || !empty(tiny::user()->account->pending_billing_phone)): ?>
                        <a href="<?php tiny::homeUrl('/billing/update-billing-method'); ?>" class="flex animate-pulse items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-red-500 transition-all duration-500 hover:animate-none hover:bg-slate-100">
                            <svg fill="none" stroke-width="1.75" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-slot="icon" class="mr-1 size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
                            </svg>
                            <?php if (!empty(tiny::user()->account->pending_login_email) && !empty(tiny::user()->account->pending_billing_phone)): ?>
                                Verify your email and phone
                            <?php elseif (!empty(tiny::user()->account->pending_login_email)): ?>
                                Verify your email address
                            <?php elseif (!empty(tiny::user()->account->pending_billing_phone)): ?>
                                Verify your phone
                            <?php endif; ?>
                        </a>
                    <?php elseif (tiny::user()->billing_account->payment_method_type == 'card' && strtotime(tiny::user()->billing_account->payment_method_cc_exp) - time() < 30 * 24 * 60 * 60): ?>
                        <a href="<?php tiny::homeUrl('/billing/update-billing-method'); ?>" class="flex animate-pulse items-center rounded-md px-2.5 py-1.5 text-xs font-medium text-red-500 transition-all duration-500 hover:animate-none hover:bg-slate-100">
                            <svg fill="none" stroke-width="1.75" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-slot="icon" class="mr-1 size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path>
                            </svg>
                            Card Expiring end of month
                        </a>
                    <?php endif; ?>

                    <div class="flex items-end h-8 relative mt-1 md:-mt-1">
                        <?php if (tiny::user()->is_admin): ?>
                        <a href="https://dashboard.stripe.com/customers/<?php echo @tiny::user()->billing_account->stripe_customer_id; ?>" target="_blank"
                            class="group py-1.5 px-2.5 inline-flex items-center gap-x-1.5 text-xs font-medium rounded-md border border-neutral-200 bg-white text-neutral-800 hover:text-indigo-500 shadow-2xs hover:bg-neutral-50 focus:outline-hidden focus:bg-neutral-50"
                        ><svg class="shrink-0 size-4 -mr-1 text-neutral-500 group-hover:text-indigo-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M10.729 8.36c0-.771.63-1.068 1.675-1.068 1.112 0 2.442.251 3.666.712.567.214 1.222-.182 1.222-.789V4.588a.952.952 0 0 0-.636-.912C15.236 3.195 13.828 3 12.404 3 8.403 3 5.742 5.097 5.742 8.598c0 5.46 7.49 4.589 7.49 6.943 0 .91-.788 1.206-1.892 1.206-1.255 0-2.777-.396-4.165-.99-.56-.24-1.216.152-1.216.76v2.698c0 .4.236.763.61.904 1.632.615 3.263.881 4.77.881 4.1 0 6.919-2.037 6.919-5.578-.02-5.895-7.53-4.846-7.53-7.062Z"/>
                        </svg><span class="hidden md:block">View on Stripe ↗</span></a>
                        <?php endif; ?>
                        <img loading="lazy" src="https://unavatar.io/<?php echo strtolower(trim(tiny::user()->account->login_email)); ?>" class="cursor-pointer mt-0.5 lg:-mt-1.5 ml-6 inline size-8 rounded-full border border-slate-300" @click="open = !open" />
                    </div>
                    <div x-auto-animate.100ms>
                        <template x-if="open">
                            <ul class="absolute right-0 mt-5 w-fit min-w-48 overflow-clip rounded-md border border-slate-200 bg-white py-1.5 text-sm text-slate-600">
                                <li><a href="<?php tiny::homeUrl('/go/app'); ?>" class="flex items-center space-x-2 px-4 py-2 hover:bg-slate-50 hover:text-[#5667e7]">
                                    <svg width="48" height="30" viewBox="0 0 48 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="size-3.5">
                                        <path d="M24.0012 0C24.0012 0 35.0514 0 36.6799 0C38.3083 0 44.9245 2.03203 44.9245 9.41484C44.9245 16.7977 38.3083 18.6141 36.738 18.6141L48 30H37.5709L26.4043 18.75C26.4043 18.75 15.0446 18.75 14.3467 18.75C13.6488 18.75 11.2829 17.6227 11.2829 15.0398C11.2829 12.457 13.6488 11.25 14.3467 11.25C15.0446 11.25 35.3422 11.25 35.7493 11.25C36.1564 11.25 37.5337 10.8984 37.5337 9.41484C37.5337 7.93125 36.196 7.59844 35.7493 7.59844C35.3027 7.59844 15.0446 7.59844 14.3467 7.59844C13.6488 7.59844 7.5607 8.59453 7.5607 15.0398C7.5607 21.4852 13.6488 22.657 14.3467 22.657C15.0446 22.657 24.3897 22.657 24.3897 22.657L31.6386 29.9602C31.6386 29.9602 15.0446 29.9602 14.3467 29.9602C10.8339 29.9602 0 27.1102 0 15.0398C0 3.2625 10.8572 0 14.3467 0C16.0124 0 24.0012 0 24.0012 0Z" fill="currentColor"/>
                                    </svg>
                                    <span>Dashboard</span>
                                </a></li>
                                <?php /*
                                <li><a href="<?php tiny::homeUrl('/go/toolbox'); ?>" class="flex items-center space-x-2 px-4 py-2 hover:bg-slate-50 hover:text-[#5667e7]">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="size-3.5">
                                        <path fill-rule="evenodd" d="M14.5 10a4.5 4.5 0 0 0 4.284-5.882c-.105-.324-.51-.391-.752-.15L15.34 6.66a.454.454 0 0 1-.493.11 3.01 3.01 0 0 1-1.618-1.616.455.455 0 0 1 .11-.494l2.694-2.692c.24-.241.174-.647-.15-.752a4.5 4.5 0 0 0-5.873 4.575c.055.873-.128 1.808-.8 2.368l-7.23 6.024a2.724 2.724 0 1 0 3.837 3.837l6.024-7.23c.56-.672 1.495-.855 2.368-.8.096.007.193.01.291.01ZM5 16a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" clip-rule="evenodd" />
                                        <path d="M14.5 11.5c.173 0 .345-.007.514-.022l3.754 3.754a2.5 2.5 0 0 1-3.536 3.536l-4.41-4.41 2.172-2.607c.052-.063.147-.138.342-.196.202-.06.469-.087.777-.067.128.008.257.012.387.012ZM6 4.586l2.33 2.33a.452.452 0 0 1-.08.09L6.8 8.214 4.586 6H3.309a.5.5 0 0 1-.447-.276l-1.7-3.402a.5.5 0 0 1 .093-.577l.49-.49a.5.5 0 0 1 .577-.094l3.402 1.7A.5.5 0 0 1 6 3.31v1.277Z" />
                                    </svg>
                                    <span>Toolbox</span>
                                </a></li>
                                */ ?>
                                <li><a href="<?php tiny::homeUrl('/profile'); ?>" class="flex items-center space-x-2 px-4 py-2 hover:bg-slate-50 hover:text-[#5667e7]">
                                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="size-3.5">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                    </svg>
                                    <span>Account settings</span>
                                </a></li>
                                <hr class="border-t border-slate-200 my-1.5">
                                <li><a href="<?php tiny::homeUrl('/auth/logout'); ?>" class="flex items-center space-x-2 px-4 py-2 hover:bg-slate-50 hover:text-[#5667e7]">
                                    <svg fill="none" stroke-width="2.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-slot="icon" class="size-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9"></path>
                                    </svg>
                                    <span>Logout</span>
                                </a></li>
                            </ul>
                        </template>
                    </div>
                </div>
            </div>
            <nav class="mb-px flex items-center justify-between px-8 pb-4">
                <div>
                    <h1 class="text-3xl font-bold text-black"><?php echo tiny::layout()->props('title', 'Account'); ?></h1>
                </div>
                <?php if (tiny::user()->is_admin || (tiny::user()->billing_account->is_owner && !tiny::user()->billing_account->is_legacy)): ?>
                <a class="mt-0.5 hidden items-center rounded-md bg-[#2ac5c3] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-300 hover:bg-[#198b8a] lg:flex" href="<?php tiny::homeUrl('/billing/credits'); ?>">
                    <svg fill="none" stroke-width="2.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" data-slot="icon" class="mr-1 -ml-1 size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                    </svg>
                    <span>Buy Credits</span>
                </a>
                <?php else: ?>
                    <div class="h-10 mt-0.5"></div>
                <?php endif; ?>
            </nav>
        </header>

        <div class="p-8 mb-20">


