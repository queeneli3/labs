<?php
// Start session only if one is not already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'vendor/autoload.php';
require_once 'db_setup.php'; // Make sure db_setup.php (or your config file) loads the .env

// Google OAuth configuration from environment variables
$client_id = $_ENV['GOOGLE_CLIENT_ID'];
$client_secret = $_ENV['GOOGLE_CLIENT_SECRET'];
$redirect_uri = $_ENV['GOOGLE_REDIRECT_URI'];

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope('email');
$client->addScope('profile');

$auth_url = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Login</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 100px auto; text-align: center; }
        .google-btn { 
            background: #db4437; color: white; padding: 15px 30px; 
            text-decoration: none; border-radius: 4px; display: inline-block; 
        }
        .google-btn:hover { background: #c23321; }
    </style>
</head>
<body>
    <h2>Login with Google</h2>
<a href="<?php echo $auth_url; ?>" class="google-btn">
        Sign in with Google
    </a>
    <br><br>
    <a href="login.php">Back to regular login</a>
</body>
</html>
