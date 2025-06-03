<?php
require_once 'Loanable.php';
require_once 'Discountable.php';
require_once 'Book.php';
require_once 'Ebook.php';
require_once 'Member.php';

echo "<h2>Library Test</h2>";

// Book test
$book = new Book("Rich Dad Poor Dad", "Robert Kiyosaki", 25.50, "Finance");
$book->borrowBook(1);
echo "<br>";
$book->returnBook(1);

// Ebook test
$ebook = new Ebook("Atomic Habits", "James Clear", 15.00, "Self-help");
echo "<br>";
$ebook->borrowBook(2);
echo "<br>Discounted Price: $" . $ebook->getDiscount();
echo "<br>";
$ebook->download();

// Member test
$member = new Member("Jane Doe", "jane@example.com", "2024-06-01");
echo "<br>";
$member->viewBorrowedBooks();
?>