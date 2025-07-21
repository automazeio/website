<?php
tiny::components()->register('EmptyStateNoData', function (...$props) {
    $props['title'] = $props['title'] ?? 'No data here yet';
    $props['description'] = $props['description'] ?? 'No data here yet. Come back later.';
    return <<<EOF
        <div class="mx-auto my-32 text-center">
        <svg class="w-48 mx-auto my-8" width="178" height="90" viewBox="0 0 178 90" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="27" y="50.5" width="124" height="39" rx="7.5" fill="currentColor" class="fill-white" />
            <rect x="27" y="50.5" width="124" height="39" rx="7.5" stroke="currentColor" class="stroke-gray-50" />
            <rect x="34.5" y="58" width="24" height="24" rx="4" fill="currentColor" class="fill-gray-50" />
            <rect x="66.5" y="61" width="60" height="6" rx="3" fill="currentColor" class="fill-gray-50" />
            <rect x="66.5" y="73" width="77" height="6" rx="3" fill="currentColor" class="fill-gray-50" />
            <rect x="19.5" y="28.5" width="139" height="39" rx="7.5" fill="currentColor" class="fill-white" />
            <rect x="19.5" y="28.5" width="139" height="39" rx="7.5" stroke="currentColor" class="stroke-gray-100" />
            <rect x="27" y="36" width="24" height="24" rx="4" fill="currentColor" class="fill-gray-100" />
            <rect x="59" y="39" width="60" height="6" rx="3" fill="currentColor" class="fill-gray-100" />
            <rect x="59" y="51" width="92" height="6" rx="3" fill="currentColor" class="fill-gray-100" />
            <g filter="url(#filter19)">
                <rect x="12" y="6" width="154" height="40" rx="8" fill="currentColor" class="fill-white" shape-rendering="crispEdges" />
                <rect x="12.5" y="6.5" width="153" height="39" rx="7.5" stroke="currentColor" class="stroke-gray-100" shape-rendering="crispEdges" />
                <rect x="20" y="14" width="24" height="24" rx="4" fill="currentColor" class="fill-gray-200 " />
                <rect x="52" y="17" width="60" height="6" rx="3" fill="currentColor" class="fill-gray-200" />
                <rect x="52" y="29" width="106" height="6" rx="3" fill="currentColor" class="fill-gray-200" />
            </g>
            <defs>
                <filter id="filter19" x="0" y="0" width="178" height="64" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                    <feOffset dy="6" />
                    <feGaussianBlur stdDeviation="6" />
                    <feComposite in2="hardAlpha" operator="out" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.03 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1187_14810" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1187_14810" result="shape" />
                </filter>
            </defs>
        </svg>
        <h2 class="font-semibold mb-2">
            {$props['title']}
        </h2>
        <div class="text-neutral-500 text-sm">
            {$props['description']}
        </div>
    </div>
    EOF;
});
