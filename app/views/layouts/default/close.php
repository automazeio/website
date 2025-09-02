<?php
if (tiny::layout()->props('emptyLayout') === false) {
  tiny::components()->require('Footer');
  tiny::components()->Footer();
}
?>

<!-- content end -->
<?php /* if (isset(tiny::data()->CSRFError)): ?>
  <script>
    showToast([{
      level: 'error',
      title: 'Request check failed',
      message: 'Your request included an invalid or missing CSRF token. Please refresh the page and try again.',
      id: '<?php echo tiny::data()->CSRFError; ?>'
    }]);
  </script>
<?php endif; */ ?>

<?php
// $toast = tiny::flash('toast')->get();
// if ($toast) {
//   $toast['id'] = $toast['id'] ?? '';
//   $toast['message'] = addslashes($toast['message']);
//   echo <<<TOAST
//     <script>
//       showToast([{
//         "level": "{$toast['level']}",
//         "title": "{$toast['title']}",
//         "message": "{$toast['message']}",
//         "id": "{$toast['id']}"
//       }]);
//     </script>
//     TOAST;
// }
?>

<?php
// tiny::components()->require('Toast');
// tiny::components()->Toast();

// tiny::components()->require('TinyJS');
// tiny::components()->TinyJS();
?>

<link href="<?php tiny::staticURL('css/aos.css'); ?>" rel="stylesheet">
<script src="<?php tiny::staticURL('js/aos.js'); ?>" onload="AOS.init();"></script>

<script>
    // --------- tiny load bump ---------
  // Nudge page by 1px down+up on load (helps hide mobile address bar, etc.)
  window.addEventListener('load', () => {
    setTimeout(() => {
      window.scrollBy(0, 1);
      window.scrollBy(0, -1);
    }, 100);
  });

  window.mobileMenu = window.mobileMenu || {
    scrollPosition: 0,
    open: () => {
      mobileMenu.scrollPosition = window.scrollY;
      document.getElementById('footer').classList.add('min-h-screen');
      document.getElementById('footer').scrollIntoView({ behavior: "instant"});
      document.getElementById('mobile-menu-close').classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    },
    close: () => {
      window.scrollTo({ top: mobileMenu.scrollPosition, behavior: "instant"});
      document.getElementById('mobile-menu-close').classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
      document.getElementById('footer').classList.remove('min-h-screen');
    }
  }
</script>
</body>
</html>
