<?php
tiny::components()->require('Footer');
tiny::components()->Footer();
?>

<!-- content end -->
<?php if (isset(tiny::data()->CSRFError)): ?>
  <script>
    showToast([{
      level: 'error',
      title: 'Request check failed',
      message: 'Your request included an invalid or missing CSRF token. Please refresh the page and try again.',
      id: '<?php echo tiny::data()->CSRFError; ?>'
    }]);
  </script>
<?php endif; ?>

<?php
$toast = tiny::flash('toast')->get();
if ($toast) {
  $toast['id'] = $toast['id'] ?? '';
  $toast['message'] = addslashes($toast['message']);
  echo <<<TOAST
    <script>
      showToast([{
        "level": "{$toast['level']}",
        "title": "{$toast['title']}",
        "message": "{$toast['message']}",
        "id": "{$toast['id']}"
      }]);
    </script>
    TOAST;
} ?>

<?php if (!tiny::layout()->props('emptyLayout')): ?>
  </main>
  </div>
<?php endif; ?>

<?php
tiny::components()->require('Toast');
tiny::components()->Toast();

// tiny::components()->require('TinyJS');
// tiny::components()->TinyJS();
?>
</body>

</html>
