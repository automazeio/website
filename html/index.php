<?php
/* -------------------------------------- */
// add code to run before the controller
if (file_exists('../.version')) {
    $_SERVER['APP_VERSION'] = trim(file_get_contents('../.version').'') ?? 'latest';
}

/* ----------------------------------- */
// Check if tiny framework exists
if (!file_exists('../tiny/tiny.php')) {
    echo "Error: Framework not found";
    error_log("Critical error: tiny framework not found at ../tiny/tiny.php");
    die();
}

/* -------------------------------------- */
// include tiny
try {
    require_once '../tiny/tiny.php';
} catch (Exception $e) {
    error_log("Error loading tiny: " . $e->getMessage());
    echo "Internal server error";
    die();
}

/* -------------------------------------- */
// Sentry stuff
if (@$_SERVER['ENV'] != 'local' && isset($_SERVER['SENTRY_DSN'])) {
    \Sentry\init(['dsn' => $_SERVER['SENTRY_DSN']]);
    \Sentry\captureLastError();
}

/* ----------------------------------- */
// Run the controller
try {
    tiny::controller();
} catch (Exception $e) {
    error_log("Controller error: " . $e->getMessage());
    echo "Application error";
}
/* ----------------------------------- */
