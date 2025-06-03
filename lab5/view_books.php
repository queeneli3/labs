<?php
if (session_status() == PHP_SESSION_NONE){
session_start();
}
require_once 'auth_check.php';
checkAuth();
require_once 'db_setup.php';

try {
    $stmt = $pdo->prepare("
        SELECT b.*, u.username as added_by 
        FROM Books b 
        JOIN users u ON b.created_by = u.id 
        ORDER BY b.created_at DESC
    ");
    $stmt->execute();
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
        body { font-family: Arial, sans-serif; max-width: 1200px; margin: 20px auto; padding: 20px; }
        .nav { margin-bottom: 20px; }
        .nav a { margin-right: 15px; padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
 th { background-color: #f8f9fa; font-weight: bold; }
        tr:hover { background-color: #f5f5f5; }
        .actions a { margin-right: 10px; padding: 5px 10px; border-radius: 3px; text-decoration: none; }
        .edit { background: #ffc107; color: black; }
        .delete { background: #dc3545; color: white; }
        .error { color: red; padding: 10px; background: #f8d7da; border-radius: 4px; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="nav">
        <a href="home.php">Home</a>
        <a href="library.php">Library</a>
        <a href="add_book.php">Add Book</a>
    </div>
    
    <h2>All Books</h2>
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if (empty($books)): ?>
        <p>No books found. <a href="add_book.php">Add the first book!</a></p>
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
                    <th>Added By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                <tr>
                    <td><?php echo htmlspecialchars($book['book_id']); ?></td>
                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                    <td><?php echo htmlspecialchars($book['author']); ?></td>
    <td><?php echo htmlspecialchars($book['genre']); ?></td>
                    <td><?php echo htmlspecialchars($book['year']); ?></td>
                    <td>$<?php echo number_format($book['price'], 2); ?></td>
                    <td><?php echo htmlspecialchars($book['added_by']); ?></td>
                    <td class="actions">
                        <a href="edit_book.php?id=<?php echo $book['book_id']; ?>" class="edit">Edit</a>
                        <a href="delete_book.php?id=<?php echo $book['book_id']; ?>" class="delete" 
                           onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>



