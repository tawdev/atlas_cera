<?php
/**
 * Language switcher handler
 * Handles language change requests
 */

session_start();

// Get the requested language
$requestedLang = $_GET['lang'] ?? 'fr';

// Validate language (only 'ar' and 'fr' are allowed)
if (in_array($requestedLang, ['ar', 'fr'])) {
    $_SESSION['lang'] = $requestedLang;
}

// Get the referrer URL or default to index.php
$redirectUrl = $_SERVER['HTTP_REFERER'] ?? 'index.php';

// If no referrer or referrer is from different domain, use index.php
if (empty($redirectUrl) || !strpos($redirectUrl, $_SERVER['HTTP_HOST'])) {
    $redirectUrl = 'index.php';
}

// Remove any existing language parameter from URL
$redirectUrl = preg_replace('/[?&]lang=[^&]*/', '', $redirectUrl);

// Remove trailing ? or & if present
$redirectUrl = rtrim($redirectUrl, '?&');

// Redirect back to the referrer or index.php
header('Location: ' . $redirectUrl);
exit;

