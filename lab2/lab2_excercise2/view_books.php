<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to database
$conn = new mysqli("localhost", "root", "", "LibrarySystemDB");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all books with author name
$sql = "SELECT Books.book_id, book_title, genre, price, author_name 
        FROM Books 
        INNER JOIN Authors ON Books.author_id = Authors.author_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Books</title>
</head>
<body>
    <h2>Book List</h2>

    <?php
    if ($result && $result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th><th>Title</th><th>Author</th><th>Genre</th><th>Price</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['book_id']}</td>
                    <td>{$row['book_title']}</td>
                    <td>{$row['author_name']}</td>
                    <td>{$row['genre']}</td>
                    <td>{$row['price']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No books found.</p>";
    }
    ?>
</body>
</html>