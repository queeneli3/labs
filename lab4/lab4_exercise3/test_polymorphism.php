<?php
require_once 'Book.php';
require_once 'Electronics.php';


$book = new Book("Animal Farm", 100.00, "George Orwell", 1945, "Fiction");
$electronic = new Electronics("Bluetooth Speaker", 300.00);


    $book->displayProduct();
    $electronic->displayProduct();
   
?>