<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$conn = new mysqli("localhost", "root", "", "LibrarySystemDB");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["book_title"]);
    $author_id = trim($_POST["author_id"]);
    $genre = trim($_POST["genre"]);
    $price = trim($_POST["price"]);

    // Validate inputs
    if (empty($title) || empty($author_id) || empty($genre) || empty($price)) {
        die("All fields are required.");
    }

    if (!is_numeric($price)) {
        die("Price must be a valid number.");
    }

    // Insert book into database
    $stmt = $conn->prepare("INSERT INTO Books (book_title, author_id, genre, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisd", $title, $author_id, $genre, $price);

    if ($stmt->execute()) {
        echo "Book added successfully!<br><a href='view_books.php'>View Books</a>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>