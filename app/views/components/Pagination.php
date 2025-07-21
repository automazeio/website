<?php
tiny::components()->register('Pagination', function (...$props) {
    $props['curr_page'] = $props['curr_page'] ?? 0;
    $props['total_rows'] = $props['total_rows'] ?? 0;
    $props['total_pages'] = $props['total_pages'] ?? 0;
    $props['back_url'] = $props['back_url'] ?? '';
    $props['next_url'] = $props['next_url'] ?? '';
    $props['htmx'] = $props['htmx'] ?? '';

    $return = '
    <!-- Pagination -->
    <div class="mb-4 flex flex-wrap justify-between items-center gap-2 px-4 pt-4 border-t border-neutral-200">
      <p class="text-sm text-stone-800">
        <span class="font-medium">'. number_format($props['total_rows']) .'</span>
        <span class="text-stone-500">results</span>
      </p>

      <nav class="flex justify-end items-center gap-x-1" aria-label="Pagination">
        <a ';
        if ($props['curr_page'] < 2) {
          $return .= 'href="#" @click.prevent disabled style="pointer-events: none; opacity: 0.5;"';
        } else {
          $return .= 'href="' . $props['back_url'] . '"';
          if ($props['htmx']) {
            $return .= ' hx-boost hx-target="' . $props['htmx'] . '" hx-swap="outerHTML" ';
          }
        }
        $return .= '
          class="cursor-pointer min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg text-stone-800 hover:bg-stone-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-stone-100" aria-label="Previous">
          <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
          <span class="sr-only">Previous</span>
        </a>
        <div class="flex items-center gap-x-1">
          <span class="min-h-9.5 min-w-9.5 flex justify-center items-center bg-stone-100 text-stone-800 py-2 px-3 text-sm rounded-lg disabled:opacity-50 disabled:pointer-events-none" aria-current="page">'. number_format($props['curr_page']) .'</span>
          <span class="min-h-9.5 flex justify-center items-center text-stone-500 py-2 px-1.5 text-sm">of</span>
          <span class="min-h-9.5 flex justify-center items-center text-stone-500 py-2 px-1.5 text-sm">' . number_format($props['total_pages']) . '</span>
        </div>
        <a ';
        if ($props['curr_page'] >= $props['total_pages']) {
          $return .= 'href="#" @click.prevent disabled style="pointer-events: none; opacity: 0.5;"';
        } else {
          $return .= 'href="' . $props['next_url'] . '"';
          if ($props['htmx']) {
            $return .= ' hx-boost hx-target="' . $props['htmx'] . '" hx-swap="outerHTML" ';
          }
        }
        $return .= '
          class="cursor-pointer min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg text-stone-800 hover:bg-stone-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-stone-100" aria-label="Next">
          <span class="sr-only">Next</span>
          <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </a>
      </nav>
    </div>
    <!-- End Pagination -->
    ';
    return $return;
});
