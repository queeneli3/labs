<?php
require_once 'Product.php';
require_once 'Book.php';

// Create a Product object
$product = new Product("Laptop", 1200.00);
$product->displayProduct();

echo "<hr>";

// Create a Book object
$book = new Book("Things Fall Apart", 15.99, "Chinua Achebe", 1958, "Fiction");
$book->displayProduct();
?>