<?php
require_once 'auth_check.php';
checkAuth(); // This will redirect to login if not authenticated
require_once 'db_setup.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Library System</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1000px; margin: 20px auto; padding: 20px; }
        .header { background: #f8f9fa; padding: 20px; border-radius: 4px; margin-bottom: 20px; }
        .nav a { margin-right: 15px; padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; }
        .nav a:hover { background: #0056b3; }
        .actions { margin: 20px 0; }
        .actions a { margin-right: 10px; padding: 10px 15px; background: #28a745; color: white; text-decoration: none; border-radius: 4px; }
        .actions a:hover { background: #218838; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Library Management</h1>
        <div class="nav">
            <a href="home.php">Home</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    
    <div class="actions">
        <a href="add_book.php">Add New Book</a>
        <a href="view_books.php">View All Books</a>
    </div>
    
    <h2>Welcome to the Library</h2>
    <p>Here you can manage books, viewyour borrowing history, and more.</p>
</body>
</html>

