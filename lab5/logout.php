<?php
// Start session only if one is not already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destroy all session data
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>


