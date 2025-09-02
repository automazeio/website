<?php tiny::layout()->default(title: 'Technical Co-Founder &amp; CTO as a Service', emptyLayout: false, isHome: true); ?>

<?php tiny::render('home/hero'); ?>
<?php tiny::render('home/mike'); ?>

<!-- main -->
<div id="main-content" class="relative z-10 mt-[100dvh] bg-white">
  <main x-class="mx-8 relative">
    <?php tiny::render('home/about'); ?>
    <?php tiny::render('home/services'); ?>
    <?php tiny::render('home/case-studies'); ?>
    <?php tiny::render('home/process'); ?>
    <?php tiny::render('home/pricing'); ?>
    <?php tiny::render('home/faq'); ?>
    <?php tiny::render('home/cta'); ?>
    <?php tiny::render('home/floating-cta'); ?>
  </main>
</div>


<?php /*
<link href="https://automaze.io/assets/vidgreet.min.css?20250106230953" rel="stylesheet">
<script src="https://automaze.io/assets/vidgreet.min.js?20250106230953"></script>
<script>
  vidGreet.init('https://d1qje4hvv045h3.cloudfront.net/automaze-wave-621c258a-54cc-445e-98dc-15a2df89c704.mp4', {
    videoStart: 2.65,
    posterStart: 2,
    posterEnd: 10,
    // delay: 1000,
    location: 'left',
    aspectRatio: 'portrait',
    cta: {
      text: 'Book a call now →',
      link: 'javascript:openSlideOver(event);',
      start: 50,
      class: 'vidgreet-cta',
    }
  })
</script>
*/ ?>

<script>
  function scrollFromHero() {
    let offset = window.innerHeight + 160;
    window.innerWidth > 768 && (offset = window.innerHeight + 180);
    window.scrollBy(0, offset);
  }

  // --------- testimonial + hero ---------
  const metaThemeColor = document.querySelector("meta[name=theme-color]");
  const splashHero = document.querySelector('#hero-content');
  const mainContent = document.querySelector('#main-content');
  const testimonialHero = document.querySelector('#testimonial-hero');
  const cta = document.querySelector('#cta');
  const about = document.querySelector('#about');
  const hideCTAEle = document.querySelector('#pricing');

  // Cache DOM elements and create cloned content once
  const testimonialHeroContent = testimonialHero.querySelector('div');
  const clonedTestimonialContent = testimonialHeroContent.cloneNode(true);
  clonedTestimonialContent.classList.add('absolute');
  clonedTestimonialContent.id = 'testimonial-hero-mask';

  // Process h2 element - wrap words in spans
  const h2Element = testimonialHeroContent.querySelector('h2');
  if (h2Element) {
    const originalContent = h2Element.innerHTML;
    const newContent = originalContent.replace(/(<span[^>]*>.*?<\/span>)|(\S+)/g,
      (match, existingSpan, word) => existingSpan || `<span>${word}</span>`);

    h2Element.innerHTML = newContent;
    clonedTestimonialContent.querySelector('h2').innerHTML = newContent;
  }
  testimonialHero.appendChild(clonedTestimonialContent);

  // Cache additional elements for performance
  const clonedParagraph = clonedTestimonialContent.querySelector('p');
  const spans = clonedTestimonialContent.querySelectorAll('span');
  const totalSpans = spans.length;
  const body = document.body;

  const setTestimonialHeroPosition = () => {
    // Get measurements once per function call
    const mainBottomOffset = window.innerHeight - mainContent.getBoundingClientRect().top;
    const splashHeroRect = splashHero.getBoundingClientRect();
    const splashHeroTopOffset = splashHeroRect.top;
    const splashHeroBottomOffset = splashHeroRect.bottom;
    const splashHeroHeight = splashHeroRect.height;
    const quarterSplashHeroHeight = splashHeroHeight / 4;

    const hideCTAEleBottomOffset = window.innerHeight - hideCTAEle.getBoundingClientRect().bottom;
    if (hideCTAEleBottomOffset > 0) {
      cta.style.opacity = 0;
      // setTimeout(() => {
      //   cta.style.display = 'none';
      // }, 500);
    } else {
      cta.style.opacity = 1;
      // setTimeout(() => {
      //   cta.style.display = 'flex';
      // }, 500);
    }

    // Handle main content scrolling
    const threshold = 180;
    // console.log(mainBottomOffset);
    if (mainBottomOffset >= threshold) {
      testimonialHero.classList.add('scrolled');
      const heightSubtract = (mainBottomOffset - threshold) / 1;
      testimonialHero.style.setProperty('--height-subtract', `${heightSubtract}px`);
      clonedParagraph.style.color = 'black';
    } else {
      testimonialHero.style.setProperty('--height-subtract', '0px');
      testimonialHero.classList.remove('scrolled');
      clonedParagraph.style.color = '';
    }

    // Handle hero visibility classes
    if (splashHeroTopOffset < -quarterSplashHeroHeight) {
      body.classList.add('scrolled');
      if (splashHeroBottomOffset < quarterSplashHeroHeight * 2) {
        body.classList.add('full-light-hero');
      } else {
        if (splashHeroBottomOffset < quarterSplashHeroHeight) {
          body.classList.remove('full-light-hero');
          metaThemeColor.setAttribute('content', '#070914');
        } else {
          metaThemeColor.setAttribute('content', '#ffffff');
        }
      }
    } else {
      body.classList.remove('scrolled');
      body.classList.remove('full-light-hero');
      metaThemeColor.setAttribute('content', '#070914');
    }

    // Handle text reveal animation
    if (splashHeroBottomOffset < 0 && splashHeroBottomOffset > -splashHeroHeight) {
      const scrollRangeEnd = -quarterSplashHeroHeight * 2;
      const scrollRange = scrollRangeEnd;
      const stepSize = scrollRange / (totalSpans + 1);

      // Use requestAnimationFrame for smoother animations
      requestAnimationFrame(() => {
        for (let i = 0; i < totalSpans; i++) {
          const reversedIndex = totalSpans - i;
          const scrollThreshold = scrollRange - (reversedIndex * stepSize);
          const isVisible = splashHeroBottomOffset < scrollThreshold;
          spans[i].style.opacity = isVisible ? 1 : 0;
        }
      });
    }
  };

  setTestimonialHeroPosition();
  window.addEventListener('scroll', setTestimonialHeroPosition);


  // --------- services scroller ---------
  const scrollingElem = document.querySelector('#services-scroller');
  const snapTargets = Array.from(scrollingElem.querySelectorAll('.bleed-frame'));
  const maskElement = document.querySelector('.mask-scroll-snap');

  function updateVisibility() {
    // Get the horizontal boundaries of the mask element once
    const maskRect = maskElement.getBoundingClientRect();
    const maskLeft = maskRect.left;
    const maskRight = maskRect.right;

    // Use classList.toggle which is more efficient for this case
    snapTargets.forEach(target => {
      const targetRect = target.getBoundingClientRect();
      // Calculate the horizontal center of the target element
      const targetCenter = (targetRect.left + targetRect.right) / 2 + 2;

      // Use toggle with the second parameter to conditionally add/remove class
      target.classList.toggle('in-view', targetCenter >= maskLeft && targetCenter <= maskRight);
    });
  }

  // Listen to scroll events to detect changes
  scrollingElem.addEventListener('scroll', updateVisibility);

  // Initial check
  updateVisibility();

  // Prev/Next controls for services scroller
  const prevBtn = document.querySelector('#services-prev');
  const nextBtn = document.querySelector('#services-next');

  function getCurrentIndex() {
    const maskRect = maskElement.getBoundingClientRect();
    const maskCenter = (maskRect.left + maskRect.right) / 2;
    let bestIdx = 0;
    let bestDist = Infinity;
    for (let i = 0; i < snapTargets.length; i++) {
      const r = snapTargets[i].getBoundingClientRect();
      const center = (r.left + r.right) / 2;
      const d = Math.abs(center - maskCenter);
      if (d < bestDist) { bestDist = d; bestIdx = i; }
    }
    return bestIdx;
  }

  function scrollToIndex(idx) {
    const clamped = Math.max(0, Math.min(idx, snapTargets.length - 1));
    snapTargets[clamped].scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
  }

  function updateNavButtons() {
    if (!prevBtn && !nextBtn) return;
    const maxScrollLeft = Math.max(0, scrollingElem.scrollWidth - scrollingElem.clientWidth);
    const atStart = scrollingElem.scrollLeft <= 1; // allow tiny rounding
    const atEnd = scrollingElem.scrollLeft >= maxScrollLeft - 1;
    if (prevBtn) prevBtn.disabled = atStart || maxScrollLeft === 0;
    if (nextBtn) nextBtn.disabled = atEnd || maxScrollLeft === 0;
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      const idx = getCurrentIndex();
      scrollToIndex(idx - 1);
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      const idx = getCurrentIndex();
      scrollToIndex(idx + 1);
    });
  }

  // Keep buttons state in sync
  scrollingElem.addEventListener('scroll', () => requestAnimationFrame(updateNavButtons));
  window.addEventListener('resize', () => requestAnimationFrame(updateNavButtons));
  updateNavButtons();

  // --------- testimonials rotator ---------
  const testimonialRotator = document.querySelector('#testimonial-rotator');
  if (testimonialRotator) {
    const slides = Array.from(testimonialRotator.querySelectorAll('.testimonial-slide'));
    const dotsWrap = document.querySelector('#testimonial-dots');
    let current = 0;
    let timer = null;

    // create dots
    const dots = slides.map((_, i) => {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'cursor-pointer h-2.5 w-2.5 rounded-full bg-slate-300 aria-selected:bg-slate-800 aria-selected:w-6 transition-all';
      btn.setAttribute('role', 'tab');
      btn.setAttribute('aria-label', `Show testimonial ${i + 1}`);
      btn.addEventListener('click', () => {
        show(i);
        restart();
      });
      dotsWrap && dotsWrap.appendChild(btn);
      return btn;
    });

    function setHeight() {
      const active = slides[current];
      if (!active) return;
      // Use the slide's intrinsic content height; slides are absolutely positioned.
      const h = active.scrollHeight + 80;
      testimonialRotator.style.height = h + 'px';
    }

    function show(index) {
      current = (index + slides.length) % slides.length;
      slides.forEach((el, i) => el.classList.toggle('active', i === current));
      dots.forEach((d, i) => {
        const selected = i === current;
        d.setAttribute('aria-selected', selected ? 'true' : 'false');
        d.classList.toggle('bg-slate-800', selected);
        d.classList.toggle('bg-slate-300', !selected);
        d.classList.toggle('w-6', selected);
        d.classList.toggle('w-2.5', !selected);
      });
      setHeight();
    }

    function start() {
      if (timer) return;
      timer = setInterval(() => show(current + 1), 6000);
    }
    function stop() {
      if (!timer) return;
      clearInterval(timer); timer = null;
    }
    function restart() { stop(); start(); }

    testimonialRotator.addEventListener('mouseenter', stop);
    testimonialRotator.addEventListener('mouseleave', start);
    testimonialRotator.addEventListener('focusin', stop);
    testimonialRotator.addEventListener('focusout', start);
    window.addEventListener('resize', () => requestAnimationFrame(setHeight));

    // Keep height in sync when slide contents load (images)
    const imgs = testimonialRotator.querySelectorAll('img');
    imgs.forEach(img => {
      if (img.complete) return;
      img.addEventListener('load', () => requestAnimationFrame(setHeight), { once: true });
    });

    // init
    show(0);
    window.addEventListener('load', () => requestAnimationFrame(setHeight));
    start();
  }

</script>


<?php tiny::layout()->default('/'); ?>
