<?php
/**
 * 404 Error Handler Controller
 *
 * This controller handles 404 (Not Found) errors by:
 * 1. Collecting information about the user and request
 * 2. Preparing data for logging (currently commented out)
 * 3. Rendering the 404 error page
 */

/**
 * Check if a logged-in user exists and collect their information
 *
 * This conditional block gathers user data for potential error tracking
 * and analytics purposes when a 404 error occurs.
 */
if (isset(tiny::user()->email)) {
    // Create payload with user information and requested URL
    // This data can be used for error tracking and analytics
    $payload = [
        'email' => tiny::user()->email,    // User's email address
        'user_id' => tiny::user()->id,     // User's unique identifier
        'url' => tiny::router()->permalink, // The URL that resulted in 404
    ];

    // Add referrer information if available
    // This helps track where users are coming from when they hit 404 pages
    if (isset($_SERVER['HTTP_REFERER'])) {
        $payload['referer'] = $_SERVER['HTTP_REFERER'];
    }

    // Note: The payload is prepared but not currently used
    // Future implementation could send this data to a logging service
    // or analytics platform to track and analyze 404 occurrences
}

/**
 * Render the 404 error page template
 *
 * This function displays the appropriate 404 error page to the user.
 * The template is defined elsewhere and this call renders it.
 */
tiny::render();
