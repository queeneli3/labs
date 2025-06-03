<?php
session_start();
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