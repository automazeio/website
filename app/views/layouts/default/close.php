    </div>
    <?php if (!tiny::layout()->props('emptyLayout')): ?>
    <footer class="p-8 pb-6 text-xs opacity-50 absolute bottom-0">
        &copy; <?php echo date('Y'); ?> Automaze, Ltd.
        ~ Time: <?php echo tiny::timer(true, false); ?> ~ App Version <?php echo $_SERVER['APP_VERSION']; ?>
        ~ Timezone: <?php echo tiny::user()->account->timezone; ?>
    </footer>
    <?php endif; ?>

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
tiny::components()->Toast();
// tiny::components()->AreYouSure();

// tiny::components()->require('TinyJS');
// tiny::components()->TinyJS();
?>
</body>
</html>
