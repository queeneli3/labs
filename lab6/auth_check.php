<?php
// Skip authentication check - allow all users to access the site
// Comment out or remove the login check below if you want to disable authentication

/*
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Optional: Check session timeout (30 minutes)
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset();
    session_destroy();
    header("Location: login.php?message=Session expired");
    exit();
}
*/

// Keep track of activity time if user is logged in
if (isset($_SESSION['user_id'])) {
    $_SESSION['last_activity'] = time();
}
?>

