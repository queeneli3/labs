<?php
require_once 'auth_check.php';
checkAuth();
require_once 'db_setup.php';

$book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$message = '';
$error = '';

if ($book_id == 0) {
    header("Location: view_books.php");
    exit();
}

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
    $error = "Error fetching book: " . $e->getMessage();
}

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
            $stmt = $pdo->prepare("UPDATE Books SET title = ?, author = ?, price = ?, genre = ?, year = ? WHERE book_id = ?");
            $stmt->execute([$title, $author, $price, $genre, $year, $book_id]);

            $message = "Book updated successfully!";

            // Refresh book data
            $book = ['title' => $title, 'author' => $author, 'price' => $price, 'genre' => $genre, 'year' => $year, 'book_id' => $book_id];
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
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; margin-right: 10px; }
        button:hover { background-color: #0056b3; }
        .cancel { background-color: #6c757d; }
        .cancel:hover { background-color: #545b62; }
        .error { color: red; margin-bottom: 15px; padding: 10px; background: #f8d7da; border-radius: 4px; }
        .message { color: green; margin-bottom: 15px; padding: 10px; background: #d4edda; border-radius: 4px; }
        .nav { margin-bottom: 20px; }
        .nav a { margin-right: 15px; padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="home.php">Home</a>
        <a href="view_books.php">View Books</a>
        <a href="add_book.php">Add Book</a>
    </div>

    <h2>Edit Book</h2>

    <?php if ($error): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
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