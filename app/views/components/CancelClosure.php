<?php
tiny::components()->register('CancelClosure', function (...$props) {
    $return = '';
    if (!empty(tiny::user()->deleted_at)) {
        switch (tiny::user()->workspace->plan->billing_cycle) {
            case 'yearly':
                $nextCycle = tzdate('d M, Y', strtotime('+1 year', strtotime(tiny::user()->workspace->plan->started_at)));
                break;
            case 'month':
                $nextCycle = tzdate('d M, Y', strtotime(tiny::user()->workspace->plan->cycle->ends));
                break;
        }

        $return .= '<div class="alert warning" id="account-restore" x-data="account_restore" x-cloak x-show="ready">';
        $return .= '<span class="emoji">⚠️</span> Your account is set to close at the end of the billing cycle on ' . $nextCycle . '. ';
        $return .= '<a href="#" class="!m-0 !px-0 !pb-0 text-primary-600" @click.prevent="unCloseAccount(\'' . $nextCycle . '\')">Don’t close my account ›</a>';
        $return .= '</div>';
    }

    return $return;
});
