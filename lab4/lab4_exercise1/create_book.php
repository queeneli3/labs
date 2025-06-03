<?php
require_once 'Book.php';
?>

<h2>Add a Book</h2>
<form method="post" action="">
    Title: <input type="text" name="title" required><br><br>
    Author: <input type="text" name="author" required><br><br>
    Year: <input type="number" name="publication_year" required><br><br>
    Genre: <input type="text" name="genre" required><br><br>
    Price: <input type="number" step="0.01" name="price" required><br><br>
    <input type="submit" value="Create Book">
</form>

<?php
// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['publication_year'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];

    $book = new Book($title, $author, $year, $genre, $price);
    $book->displayBookInfo();
}
?>