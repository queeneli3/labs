<?php
session_start();
include 'db_config.php';
include 'auth_check.php';
include 'csrf_token.php';

$csrf_token = generateCSRFToken();

// Get book ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: view_books.php");
    exit();
}

$book_id = intval($_GET['id']);

// Fetch book details
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

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CSRF Protection
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        die("CSRF token validation failed.");
    }
    
    // Input validation
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
 $price = floatval($_POST['price']);
    $genre = trim($_POST['genre']);
    $year = intval($_POST['year']);
    
    // Validate required fields
    if (empty($title) || empty($author) || empty($genre)) {
        $error = "All fields are required.";
    } elseif ($price <= 0) {
        $error = "Price must be greater than 0.";
    } elseif ($year < 1000 || $year > date('Y')) {
        $error = "Please enter a valid year.";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE Books SET title = ?, author = ?, price = ?, genre = ?, year = ? WHERE book_id = ?");
            $stmt->execute([$title, $author, $price, $genre, $year, $book_id]);
            
            $success = "Book updated successfully!";
            regenerateCSRFToken();
            
            // Refresh book data
            $book = ['title' => $title, 'author' => $author, 'price' => $price, 'genre' => $genre, 'year' => $year];
        } catch(PDOException $e) {
            $error = "Error updating book: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book - Library System</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; border: 1px solid #ddd;
            border-radius: 4px; }
        button { background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; margin-right: 10px; }
        button:hover { background-color: #0056b3; }
        .cancel { background-color: #6c757d; }
        .cancel:hover { background-color: #545b62; }
        .error { color: red; margin-bottom: 15px; }
        .success { color: green; margin-bottom: 15px; }
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
    
    <h2>Edit Book</h2>
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if (isset($success)): ?>
        <div class="success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    
    <form method="POST" action="">
        <!-- CSRF Token -->
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
  <div class="form-group">
            <label for="title">Book Title:</label>
            <input type="text" id="title" name="title" required maxlength="255" 
                   value="<?php echo htmlspecialchars($book['title']); ?>">
        </div>
        
        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required maxlength="255"
                   value="<?php echo htmlspecialchars($book['author']); ?>">
 </div>
        
        <div class="form-group">
            <label for="price">Price ($):</label>
            <input type="number" id="price" name="price" step="0.01" min="0.01" required
                   value="<?php echo htmlspecialchars($book['price']); ?>">
        </div>
        
        <div class="form-group">
            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" required maxlength="100"
                   value="<?php echo htmlspecialchars($book['genre']); ?>">
        </div>
        
        <div class="form-group">
            <label for="year">Publication Year:</label>
            <input type="number" id="year" name="year" min="1000" max="<?php echo date('Y'); ?>" required
                   value="<?php echo htmlspecialchars($book['year']); ?>">
        </div>
        
        <button type="submit">Update Book</button>
        <button type="button" class="cancel" onclick="window.location.href='view_books.php'">Cancel</button>
    </form>
</body>
</html>
