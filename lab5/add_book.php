<?php
session_start();
require_once 'auth_check.php';
checkAuth();
require_once 'db_setup.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $price = floatval($_POST['price']);
    $genre = trim($_POST['genre']);
    $year = intval($_POST['year']);
    
    if (empty($title) || empty($author)) {
        $error = "Title and author are required.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO Books (title, author, price, genre, year) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $author, $price, $genre, $year]);
            
            $message = "Book added successfully!";
            
            // Clear form data
            $title = $author = $genre = '';
            $price = $year = 0;
            
        } catch(PDOException $e) {
            $error = "Error adding book: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book - Library System</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"] { 
            width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; 
        }
button { background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #218838; }
        .message { color: green; margin-bottom: 15px; padding: 10px; background: #d4edda; border-radius: 4px; }
        .error { color: red; margin-bottom: 15px; padding: 10px; background: #f8d7da; border-radius: 4px; }
        .nav { margin-bottom: 20px; }
        .nav a { margin-right: 15px; padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
<div class="nav">
        <a href="home.php">Home</a>
        <a href="library.php">Library</a>
        <a href="view_books.php">View Books</a>
    </div>
    
    <h2>Add New Book</h2>
    
    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required value="<?php echo isset($author) ? htmlspecialchars($author) : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="price">Price:</label>
<input type="number" id="price" name="price" step="0.01" min="0" value="<?php echo isset($price) ? $price : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" value="<?php echo isset($genre) ? htmlspecialchars($genre) : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="year">Publication Year:</label>
            <input type="number" id="year" name="year" min="1000" max="2024" value="<?php echo isset($year) ? $year : ''; ?>">
        </div>
 <button type="submit">Add Book</button>
    </form>
</body>
</html>

