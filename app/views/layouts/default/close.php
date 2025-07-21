    </div>
    <?php if (!tiny::layout()->props('emptyLayout')): ?>
    <footer class="p-8 pb-6 text-xs opacity-50 absolute bottom-0">
        &copy; <?php echo date('Y'); ?> Campaign Refinery
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
tiny::components()->AreYouSure();

tiny::components()->require('TinyJS');
tiny::components()->TinyJS();
?>

<?php if ($_SERVER['ENV'] === 'prod'): ?>
<script type="text/javascript">
// Helpscout Beacon
!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});

// Initialize Helpscout Beacon
window.Beacon('init', 'ffebffab-56ba-4f2b-b7b6-8ecb2a75ccdd');

// Identify the user
window.Beacon('identify', {
  crid: '<?php echo tiny::user()->account->hash; ?>',
  bcycle: '<?php echo tiny::user()->billing_account->billing_cycle; ?>',
  phone: '<?php echo tiny::user()->account->phone; ?>',
  name: '<?php echo ucwords(strtolower(trim(tiny::user()->account->first_name .' '. tiny::user()->account->last_name))); ?>',
  email: '<?php echo strtolower(trim(tiny::user()->email)); ?>',
  notes: 'Stripe customer Id:\n<?php echo tiny::user()->billing_account->stripe_customer_id; ?>\nSubscription:\n<?php echo tiny::user()->billing_account->subscription_name; ?>',
  avatar: 'https://unavatar.io/<?php echo strtolower(trim(tiny::user()->account->login_email)); ?>',
});
</script>
<?php endif; ?>

</body>
</html>
