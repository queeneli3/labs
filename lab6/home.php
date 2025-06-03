<?php
session_start();
include 'auth_check.php';

// Display success/error messages
$message = '';
if (isset($_SESSION['success_message'])) {
    $message = '<div class="success">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
    unset($_SESSION['success_message']);
}
if (isset($_SESSION['error_message'])) {
    $message = '<div class="error">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
    unset($_SESSION['error_message']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System - Home</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .header { text-align: center; margin-bottom: 40px; }
        .nav-card { background-color: #f8f9fa; padding: 30px; border-radius: 10px; margin: 20px 0; text-align: center; }
        .nav-card h3 { color: #007bff; margin-bottom: 15px; }
        .nav-card a { display: inline-block; background-color: #007bff; color: white; padding: 12px 24px; 
                      text-decoration: none; border-radius: 5px; margin: 5px; }
        .nav-card a:hover { background-color: #0056b3; }
        .user-info { background-color: #e9ecef; padding: 15px; border-radius: 5px; margin-bottom: 30px; }
        .logout { float: right; background-color: #dc3545 !important; }
        .logout:hover { background-color: #c82333 !important; }
        .success { color: green; margin-bottom: 15px; padding: 10px; background-color: #d4edda; border-radius: 5px; }
        .error { color: #dc3545; margin-bottom: 15px; padding: 10px; background-color: #f8d7da; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>📚 Library Management System</h1>
        <?php echo $message; ?>
        <div class="user-info">
            Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>!
            <a href="logout.php" class="logout">Logout</a>
            <div style="clear: both;"></div>
        </div>
    </div>
    
    <div class="nav-card">
        <h3>📖 Book Management</h3>
        <p>Manage your library's book collection</p>
        <a href="view_books.php">View All Books</a>
        <a href="add_book.php">Add New Book</a>
    </div>
 <div class="nav-card">
        <h3>🔒 Security Features</h3>
        <p>Test and verify security implementations</p>
        <a href="test_security.php">Security Tests</a>
    </div>
</body>
</html>

