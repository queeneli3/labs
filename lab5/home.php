<?php
require_once 'auth_check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Library System</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; padding: 20px; }
        .header { background: #f8f9fa; padding: 20px; border-radius: 4px; margin-bottom: 20px; }
        .nav { margin-bottom: 20px; }
        .nav a { margin-right: 15px; padding: 10px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; }
        .nav a:hover { background: #0056b3; }
        .logout { background: #dc3545; }
        .logout:hover { background: #c82333; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to Library System</h1>
        <?php if (isLoggedIn()): ?>
            <p>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
            <p>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        <?php endif; ?>
    </div>
    <div class="nav">
        <?php if (isLoggedIn()): ?>
            <a href="library.php">Library</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php" class="logout">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </div>
    
    <div class="content">
        <?php if (isLoggedIn()): ?>
            <h2>Library Management System</h2>
            <p>You are now logged in and can access all library features.
    
</p>
            <ul>
                <li><a href="library.php">Browse Books</a></li>
                <li><a href="add_book.php">Add New Book</a></li>
                <li><a href="view_books.php">View All Books</a></li>
            </ul>
        <?php else: ?>
            <h2>Please Login</h2>
            <p>You need to log in to access the library system.</p>
        <?php endif; ?>
    </div>
</body>
</html>

