<?php
session_start();
include 'db_config.php';
include 'auth_check.php';
include 'csrf_token.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: view_books.php");
    exit();
}

$book_id = intval($_GET['id']);

// If it's a POST request (form submission)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CSRF Protection
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        die("CSRF token validation failed.");
    }
    
    try {
        $stmt = $pdo->prepare("DELETE FROM Books WHERE book_id = ?");
        $stmt->execute([$book_id]);
        
        if ($stmt->rowCount() > 0) {
            $_SESSION['success_message'] = "Book deleted successfully!";
        } else {
            $_SESSION['error_message'] = "Book not found.";
        }
    } catch(PDOException $e) {
        $_SESSION['error_message'] = "Error deleting book: " . $e->getMessage();
}
    
    header("Location: view_books.php");
    exit();
}

// Fetch book details for confirmation
try {
    $stmt = $pdo->prepare("SELECT * FROM Books WHERE book_id = ?");
    $stmt->execute([$book_id]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$book) {
        header("Location: view_books.php");
        exit();
    }
} catch(PDOException $e) {
    die("Error fetching book: " . $e->getMessage());
}
$csrf_token = generateCSRFToken();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Book - Library System</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        .book-details { background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin: 20px 0; }
        .book-details h3 { margin-top: 0; color: #dc3545; }
        .book-info { margin: 10px 0; }
        button { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; margin-right: 10px; }
        .delete-btn { background-color: #dc3545; color: white; }
        .delete-btn:hover { background-color: #c82333; }
        .cancel-btn { background-color: #6c757d; color: white; }
        .cancel-btn:hover { background-color: #545b62; }
        .nav { margin-bottom: 20px; }
        .nav a { margin-right: 15px; text-decoration: none; color: #007bff; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="home.php">Home</a>
        <a href="view_books.php">View Books</a>
        <a href="logout.php">Logout</a>
    </div>
<h2>Delete Book</h2>
    
    <div class="book-details">
        <h3>⚠ Are you sure you want to delete this book?</h3>
        <div class="book-info"><strong>Title:</strong> <?php echo htmlspecialchars($book['title']); ?></div>
        <div class="book-info"><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></div>
        <div class="book-info"><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></div>
        <div class="book-info"><strong>Year:</strong> <?php echo htmlspecialchars($book['year']); ?></div>
        <div class="book-info"><strong>Price:</strong> $<?php echo htmlspecialchars(number_format($book['price'], 2)); ?></div>
    </div>
    
    <p><strong>Warning:</strong> This action cannot be undone!</p>
    
    <form method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
        <button type="submit" class="delete-btn">Yes, Delete Book</button>
        <button type="button" class="cancel-btn" onclick="window.location.href='view_books.php'">Cancel</button>
    </form>
</body>
</html>
