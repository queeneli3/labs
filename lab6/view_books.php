<?php
session_start();
include 'db_config.php';
include 'auth_check.php';

// Fetch all books with XSS protection
try {
    $stmt = $pdo->query("SELECT * FROM Books ORDER BY title");
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $error = "Error fetching books: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books - Library System</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1000px; margin: 50px auto; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .nav { margin-bottom: 20px; }
        .nav a { margin-right: 15px;
            text-decoration: none; color: #007bff; }
        .error { color: red; margin-bottom: 15px; }
        .actions a { margin-right: 10px; color: #007bff; text-decoration: none; }
        .actions a.delete { color: #dc3545; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="home.php">Home</a>
        <a href="add_book.php">Add Book</a>
        <a href="logout.php">Logout</a>
    </div>
    
    <h2>Library Books</h2>
    
    <?php if (isset($error)): ?>
<div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if (empty($books)): ?>
        <p>No books found in the library.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Year</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
    <tr>
                        <td><?php echo htmlspecialchars($book['book_id'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($book['title'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($book['author'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($book['genre'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($book['year'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>$<?php echo htmlspecialchars(number_format($book['price'], 2), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td class="actions">
                            <a href="edit_book.php?id=<?php echo urlencode($book['book_id']); ?>">Edit</a>
                            <a href="delete_book.php?id=<?php echo urlencode($book['book_id']); ?>" 
                               class="delete" onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>

