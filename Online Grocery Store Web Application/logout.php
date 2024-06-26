<?php
// Start a session (if not started already)
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page (replace 'login.html' with the actual login page)
header("Location: index.html");
exit();
?>
