<?php
tiny::components()->register('TransactionRow', function (...$props) {
    $html = '
    <tr class="hover:bg-slate-50 transition-all duration-150">
        <td class="whitespace-nowrap px-2 md:px-4 py-2">
            ' . date('M d', strtotime($props['created_at'])) . '
            <span class="hidden md:inline">, ' . date('Y', strtotime($props['created_at'])) . '</span>
        </td>
        <td class="whitespace-nowrap px-2 md:px-4 py-2">
    ';
    if ($props['transaction_type'] == 'credits_overage') {
        $html .= '
            <span class="py-1 ps-1.5 pe-3 inline-flex items-center gap-x-1.5 text-xs font-medium bg-slate-200/60 text-slate-700 rounded">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M2 19C2 19 3 19 4 21C4 21 7.17647 16 10 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10.5 21H16C18.8284 21 20.2426 21 21.1213 20.1213C22 19.2426 22 17.8284 22 15V13C22 10.1716 22 8.75736 21.1213 7.87868C20.2426 7 18.8284 7 16 7H10M2 15V11C2 7.22876 2 5.34315 3.17157 4.17157C4.34315 3 6.22876 3 10 3H14C14.93 3 15.395 3 15.7765 3.10222C16.8117 3.37962 17.6204 4.18827 17.8978 5.22354C18 5.60504 18 6.07003 18 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M16 13.5C16 14.3284 16.6716 15 17.5 15C18.3284 15 19 14.3284 19 13.5C19 12.6716 18.3284 12 17.5 12C16.6716 12 16 12.6716 16 13.5Z" stroke="currentColor" stroke-width="1.5"/>
            </svg>
            ';
    } elseif ($props['transaction_type'] == 'credits_purchase') {
        $html .= '
            <span class="py-1 ps-1.5 pe-3 inline-flex items-center gap-x-1.5 text-xs font-medium bg-amber-100/80 text-amber-600 rounded">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M2 19C2 19 3 19 4 21C4 21 7.17647 16 10 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10.5 21H16C18.8284 21 20.2426 21 21.1213 20.1213C22 19.2426 22 17.8284 22 15V13C22 10.1716 22 8.75736 21.1213 7.87868C20.2426 7 18.8284 7 16 7H10M2 15V11C2 7.22876 2 5.34315 3.17157 4.17157C4.34315 3 6.22876 3 10 3H14C14.93 3 15.395 3 15.7765 3.10222C16.8117 3.37962 17.6204 4.18827 17.8978 5.22354C18 5.60504 18 6.07003 18 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M16 13.5C16 14.3284 16.6716 15 17.5 15C18.3284 15 19 14.3284 19 13.5C19 12.6716 18.3284 12 17.5 12C16.6716 12 16 12.6716 16 13.5Z" stroke="currentColor" stroke-width="1.5"/>
            </svg>
            ';
    } elseif ($props['transaction_type'] == 'credits_topup') {
        $html .= '
            <span class="py-1 ps-1.5 pe-3 inline-flex items-center gap-x-1.5 text-xs font-medium bg-sky-200/60 text-sky-700 rounded">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M16.002 13.5C16.002 14.3284 16.6735 15 17.502 15C18.3304 15 19.002 14.3284 19.002 13.5C19.002 12.6716 18.3304 12 17.502 12C16.6735 12 16.002 12.6716 16.002 13.5Z" stroke="currentColor" stroke-width="1.5"/>
                <path d="M2.00195 11C2.00195 7.22876 2.00195 5.34315 3.17353 4.17157C4.3451 3 6.23072 3 10.002 3H14.002C14.9319 3 15.3969 3 15.7784 3.10222C16.8137 3.37962 17.6223 4.18827 17.8997 5.22354C18.002 5.60504 18.002 6.07003 18.002 7M10.002 7H16.002C18.8304 7 20.2446 7 21.1233 7.87868C22.002 8.75736 22.002 10.1716 22.002 13V15C22.002 17.8284 22.002 19.2426 21.1233 20.1213C20.2446 21 18.8304 21 16.002 21H12.5005" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M10 17H6M6 17H2M6 17V21M6 17L6 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            ';
    } elseif ($props['transaction_type'] == 'subscription') {
        $html .= '
            <span class="py-1 ps-1.5 pe-3 inline-flex items-center gap-x-1.5 text-xs font-medium bg-green-200/60 text-green-700 rounded">
            <svg  class="shrink-0 size-3.5 ml-0.5"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M15.1667 0.999756L15.7646 2.11753C16.1689 2.87322 16.371 3.25107 16.2374 3.41289C16.1037 3.57471 15.6635 3.44402 14.7831 3.18264C13.9029 2.92131 12.9684 2.78071 12 2.78071C6.75329 2.78071 2.5 6.90822 2.5 11.9998C2.5 13.6789 2.96262 15.2533 3.77093 16.6093M8.83333 22.9998L8.23536 21.882C7.83108 21.1263 7.62894 20.7484 7.7626 20.5866C7.89627 20.4248 8.33649 20.5555 9.21689 20.8169C10.0971 21.0782 11.0316 21.2188 12 21.2188C17.2467 21.2188 21.5 17.0913 21.5 11.9998C21.5 10.3206 21.0374 8.74623 20.2291 7.39023" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            ';
    } elseif ($props['transaction_type'] == 'adjustment') {
        $html .= '
            <span class="py-1 ps-1.5 pe-3 inline-flex items-center gap-x-1.5 text-xs font-medium bg-neutral-100 text-neutral-700 rounded">
            <svg  class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M7.91124 7.01226C6.96629 6.92804 5.92409 7.26822 4.7473 8.59162C4.38031 9.00434 3.74823 9.0414 3.33551 8.67441C2.92279 8.30742 2.88573 7.67534 3.25272 7.26262C4.7426 5.58713 6.36706 4.8667 8.08879 5.02015C9.72713 5.16618 11.2543 6.0915 12.6354 7.22793C13.9209 8.28572 15.0605 8.89635 16.0888 8.988C17.0337 9.07222 18.0759 8.73204 19.2527 7.40863C19.6197 6.99592 20.2518 6.95885 20.6645 7.32584C21.0772 7.69284 21.1143 8.32492 20.7473 8.73763C19.2574 10.4131 17.633 11.1336 15.9112 10.9801C14.2729 10.8341 12.7457 9.90875 11.3646 8.77232C10.0791 7.71453 8.93956 7.10391 7.91124 7.01226Z" fill="currentColor"/><path d="M7.91124 15.0123C6.96629 14.928 5.92409 15.2682 4.7473 16.5916C4.38031 17.0043 3.74823 17.0414 3.33551 16.6744C2.92279 16.3074 2.88573 15.6753 3.25272 15.2626C4.7426 13.5871 6.36706 12.8667 8.08879 13.0202C9.72713 13.1662 11.2543 14.0915 12.6354 15.2279C13.9209 16.2857 15.0605 16.8963 16.0888 16.988C17.0337 17.0722 18.0759 16.732 19.2527 15.4086C19.6197 14.9959 20.2518 14.9589 20.6645 15.3258C21.0772 15.6928 21.1143 16.3249 20.7473 16.7376C19.2574 18.4131 17.633 19.1336 15.9112 18.9801C14.2729 18.8341 12.7457 17.9088 11.3646 16.7723C10.0791 15.7145 8.93956 15.1039 7.91124 15.0123Z" fill="currentColor"/></svg>
            ';
    } elseif ($props['transaction_type'] == 'refund') {
        $html .= '
            <span class="py-1 ps-1.5 pe-3 inline-flex items-center gap-x-1.5 text-xs font-medium bg-slate-200 text-slate-700 rounded">
            <svg class="shrink-0 size-3 ml-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M2 6H15C18.866 6 22 9.13401 22 13V13C22 16.866 18.866 20 15 20H10M2 6L6 2M2 6L6 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            ';
    } elseif ($props['transaction_type'] == 'bonus') {
        $html .= '
            <span class="py-1 ps-1.5 pe-3 inline-flex items-center gap-x-1.5 text-xs font-medium bg-violet-200/60 text-violet-700 rounded">
            <svg class="shrink-0 size-3.5 ml-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M5 5H3C2.53501 5 2.30252 5 2.11177 5.05111C1.59413 5.18981 1.18981 5.59413 1.05111 6.11177C1 6.30252 1 6.53501 1 7V7C1 7.92997 1 8.39496 1.10222 8.77646C1.37962 9.81173 2.18827 10.6204 3.22354 10.8978C3.60504 11 4.07003 11 5 11V11M19 5H21C21.465 5 21.6975 5 21.8882 5.05111C22.4059 5.18981 22.8102 5.59413 22.9489 6.11177C23 6.30252 23 6.53501 23 7V7C23 7.92997 23 8.39496 22.8978 8.77646C22.6204 9.81173 21.8117 10.6204 20.7765 10.8978C20.395 11 19.93 11 19 11V11M12 14V18M9.09091 22H14.9091C15.5116 22 16 21.5116 16 20.9091V20.9091C16 19.3024 14.6976 18 13.0909 18H10.9091C9.30244 18 8 19.3024 8 20.9091V20.9091C8 21.5116 8.48842 22 9.09091 22ZM12 14V14C13.8613 14 14.7919 14 15.5451 13.7553C17.0673 13.2607 18.2607 12.0673 18.7553 10.5451C19 9.79192 19 8.86128 19 7V6.5C19 5.10218 19 4.40326 18.7716 3.85195C18.4672 3.11687 17.8831 2.53284 17.1481 2.22836C16.5967 2 15.8978 2 14.5 2H9.5C8.10218 2 7.40326 2 6.85195 2.22836C6.11687 2.53284 5.53284 3.11687 5.22836 3.85195C5 4.40326 5 5.10218 5 6.5V7C5 8.86128 5 9.79192 5.24472 10.5451C5.73931 12.0673 6.93273 13.2607 8.45492 13.7553C9.20808 14 10.1387 14 12 14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        ';
    } else {
        $html .= '
            <span class="py-1 ps-1.5 pe-3 inline-flex items-center gap-x-1.5 text-xs font-medium bg-neutral-200/60 text-neutral-700 rounded">
            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        ';
    }
    $html .= str_replace(' charge', '', $props['description']);
    $html .= '</span>
        </td>
        <td class="whitespace-nowrap px-2 md:px-4 py-2 hidden md:table-cell">
            <span class="flex items-center gap-x-1 text-sm text-neutral-600">
            <img class="shrink-0 size-7" src="' . tiny::getStaticURL('img/cards/' . strtolower(str_replace(' ', '-', $props['payment_method_cc_type'])) . '.svg') . '" alt="Payment method" />
        ';
    if ($props['payment_method_type'] == 'card') {
        $html .= '
            •••' . $props['payment_method_cc_last_4'];
        if (strtotime($props['payment_method_cc_exp']) - time() <= 30 * 24 * 60 * 60) {
            $html .= '
                <a href="' . tiny::homeUrl('/billing/update-billing-method/' . $props['stripe_customer_id']) . '" class="font-medium text-xs text-red-500">Expires end of month</a>
            ';
        }
    }
    $html .= '
            </span>
        </td>
        <td class="whitespace-nowrap px-2 md:px-4 py-2">
        ';
    if ($props['status'] == 'open') {
        $html .= '
            <span class="py-1 ps-1.5 pe-3 inline-flex items-center gap-x-1.5 text-xs font-medium bg-slate-200 text-slate-800 rounded">
            <svg class="shrink-0 size-3.5 ml-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        ';
    } elseif ($props['status'] == 'failed') {
        $html .= '
            <span class="py-1 ps-1.5 pe-3 inline-flex items-center gap-x-1.5 text-xs font-medium bg-red-200/70 text-red-800 rounded">
            <svg class="shrink-0 size-3.5 ml-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                <rect width="256" height="256" fill="none"></rect>
                <path d="M142.41,40.22l87.46,151.87C236,202.79,228.08,216,215.46,216H40.54C27.92,216,20,202.79,26.13,192.09L113.59,40.22C119.89,29.26,136.11,29.26,142.41,40.22Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="24"/>
                <line x1="128" y1="136" x2="128" y2="104" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="24"></line>
                <circle cx="128" cy="176" r="16"></circle>
            </svg>
        ';
    } elseif ($props['status'] == 'refunded') {
        $html .= '
            <span class="py-1 ps-1.5 pe-3 inline-flex items-center gap-x-1.5 text-xs font-medium bg-slate-200 text-neutral-800 rounded">
            <svg class="shrink-0 size-3.5 ml-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M2 6H15C18.866 6 22 9.13401 22 13V13C22 16.866 18.866 20 15 20H10M2 6L6 2M2 6L6 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        ';
    } else {
        $html .= '
            <span class="py-1 ps-1.5 pe-3 inline-flex items-center gap-x-1.5 text-xs font-medium bg-green-200/70 text-green-800 rounded">
            <svg class="shrink-0 size-3.5 ml-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M4 13L9 18L20 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        ';
    }
    $html .= ucwords($props['status']);
    $html .= '
            </span>
        </td>
        <td class="whitespace-nowrap px-2 md:px-4 py-2 text-right">
            <span class="text-sm text-neutral-600 text-right">
            ' . tiny::geos()->currencySymbol($props['currency']) . ' ' . number_format($props['amount'] / 100, 2) . '
            </span>
        </td>
        <td class="whitespace-nowrap px-2 md:px-4 py-0 text-right">
            <a target="_blank" href="' . tiny::getHomeUrl('/billing/invoice/' . $props['transaction_uuid']) . '"
                class="group py-1.5 px-2.5 inline-flex items-center gap-x-1.5 text-xs font-medium rounded-md border border-neutral-200 bg-white text-neutral-800 shadow-2xs hover:bg-neutral-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-neutral-50"
            ><svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path class="opacity-50 group-hover:text-red-400 group-hover:opacity-100" d="M7 18V15.5M7 15.5V14C7 13.5286 7 13.2929 7.15377 13.1464C7.30754 13 7.55503 13 8.05 13H8.75C9.47487 13 10.0625 13.5596 10.0625 14.25C10.0625 14.9404 9.47487 15.5 8.75 15.5H7ZM21 13H19.6875C18.8625 13 18.4501 13 18.1938 13.2441C17.9375 13.4882 17.9375 13.881 17.9375 14.6667V15.5M17.9375 18V15.5M17.9375 15.5H20.125M15.75 15.5C15.75 16.8807 14.5747 18 13.125 18C12.7979 18 12.6343 18 12.5125 17.933C12.2208 17.7726 12.25 17.448 12.25 17.1667V13.8333C12.25 13.552 12.2208 13.2274 12.5125 13.067C12.6343 13 12.7979 13 13.125 13C14.5747 13 15.75 14.1193 15.75 15.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M15 22H10.7273C7.46607 22 5.83546 22 4.70307 21.2022C4.37862 20.9736 4.09058 20.7025 3.8477 20.3971C3 19.3313 3 17.7966 3 14.7273V12.1818C3 9.21865 3 7.73706 3.46894 6.55375C4.22281 4.65142 5.81714 3.15088 7.83836 2.44135C9.09563 2 10.6698 2 13.8182 2C15.6173 2 16.5168 2 17.2352 2.2522C18.3902 2.65765 19.3012 3.5151 19.732 4.60214C20 5.27832 20 6.12494 20 7.81818V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M3 12C3 10.1591 4.49238 8.66667 6.33333 8.66667C6.99912 8.66667 7.78404 8.78333 8.43137 8.60988C9.00652 8.45576 9.45576 8.00652 9.60988 7.43136C9.78333 6.78404 9.66667 5.99912 9.66667 5.33333C9.66667 3.49238 11.1591 2 13 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg><span class="hidden md:block">Download Invoice</span></a>
        ';
    if (tiny::user()->is_admin) {
        $html .= '
            <a href="https://dashboard.stripe.com/search?query=' . $props['stripe_charge_id'] . '" target="_blank"
                class="ml-2 group py-1.5 px-2.5 inline-flex items-center gap-x-1.5 text-xs font-medium rounded-md border border-neutral-200 bg-white text-neutral-800 hover:text-indigo-500 shadow-2xs hover:bg-neutral-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-neutral-50"
            ><svg class="shrink-0 size-4 -mr-1 text-neutral-500 group-hover:text-indigo-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M10.729 8.36c0-.771.63-1.068 1.675-1.068 1.112 0 2.442.251 3.666.712.567.214 1.222-.182 1.222-.789V4.588a.952.952 0 0 0-.636-.912C15.236 3.195 13.828 3 12.404 3 8.403 3 5.742 5.097 5.742 8.598c0 5.46 7.49 4.589 7.49 6.943 0 .91-.788 1.206-1.892 1.206-1.255 0-2.777-.396-4.165-.99-.56-.24-1.216.152-1.216.76v2.698c0 .4.236.763.61.904 1.632.615 3.263.881 4.77.881 4.1 0 6.919-2.037 6.919-5.578-.02-5.895-7.53-4.846-7.53-7.062Z"/>
            </svg><span class="hidden md:block">View on Stripe ↗</span></a>
            ';
    }

    $html .= '
        </td>
    </tr>
    ';
    return $html;
});
