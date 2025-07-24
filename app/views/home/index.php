<?php tiny::layout()->default(title: 'Home', emptyLayout: false); ?>


<?php tiny::render('home/hero-v2'); ?>
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


<script>
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
      body.classList.add('light-hero');
      if (splashHeroBottomOffset < quarterSplashHeroHeight * 2) {
        body.classList.add('full-light-hero');
        metaThemeColor.setAttribute('content', '#ffffff');
      } else {
        if (splashHeroBottomOffset < quarterSplashHeroHeight) {
          body.classList.remove('full-light-hero');
          metaThemeColor.setAttribute('content', '#070914');
        }
      }
    } else {
      body.classList.remove('light-hero');
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
</script>


<?php tiny::layout()->default('/'); ?>
