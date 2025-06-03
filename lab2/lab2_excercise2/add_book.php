<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$conn = new mysqli("localhost", "root", "", "LibrarySystemDB");

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get authors from the Authors table
$authors = $conn->query("SELECT * FROM Authors");

// Check if authors query failed
if (!$authors) {
    die("Error fetching authors: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
</head>
<body>
    <h2>Add a New Book</h2>
    <form method="POST" action="process_book.php">
        Title: <input type="text" name="book_title" required><br><br>

        Author:
        <select name="author_id" required>
            <option value="">Select Author</option>
            <?php while($row = $authors->fetch_assoc()) {
                echo "<option value='{$row['author_id']}'>{$row['author_name']}</option>";
            } ?>
        </select><br><br>

        Genre: <input type="text" name="genre" required><br><br>
        Price: <input type="text" name="price" required><br><br>
        <input type="submit" value="Add Book">
    </form>
</body>
</html>