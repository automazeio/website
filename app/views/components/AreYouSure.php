<?php
tiny::components()->register('AreYouSure', function (...$props) {
    return <<<HTML
  <dialog id="rusure-dialog" x-data="rusureDialog" :open="show" data-origin="bottom">
    <article class="m-auto w-full max-w-md">
      <button role="figure" class="z-10 absolute right-3.5 top-4 opacity-40 hover:opacity-80 transition-opacity" aria-label="Close" @click="rusureCancel" data-target="rusure-dialog">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6" stroke="none">
          <path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm4.3 14.3c-.39.39-1.02.39-1.41 0L12 13.41 9.11 16.3c-.39.39-1.02.39-1.41 0-.39-.39-.39-1.02 0-1.41L10.59 12 7.7 9.11c-.39-.39-.39-1.02 0-1.41.39-.39 1.02-.39 1.41 0L12 10.59l2.89-2.89c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41L13.41 12l2.89 2.89c.38.38.38 1.02 0 1.41z"/>
        </svg>
      </button>
      <div class="max-h-[80dvh]">
        <h4 class="!-mt-1 text-2xl" x-html="title"></h4>
        <p class="mb-4 text-sm" x-html="msg" x-show="msg"></p>
        <p class="font-semibold text-sm" x-show="question" x-html="question"></p>
      </div>
      <footer class="sm:flex items-center">
        <button id="rusure-button" type="button" :role="warning?'danger':'primary'" class="!my-0 whitespace-nowrap !transition-all ease-in-out" @click.prevent="rusureConfirm" x-text="button"></button>
        <button type="button" role="button" class="!my-0 secondary !bg-[var(--secondary-hover)]" @click="rusureCancel" data-target="rusure-dialog">Cancel</button>
      </footer>
    </article>
  </dialog>

  HTML;
});
