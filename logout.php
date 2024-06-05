<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Set cache control headers to prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirect to index.html
header("Location: index.html");
exit(); // Ensure no further code is executed
?>
