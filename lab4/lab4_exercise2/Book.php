<?php
require_once 'Product.php';

class Book extends Product {
    public $author;
    public $publication_year;
    public $genre;

    public function __construct($name, $price, $author, $year, $genre) {
        parent::__construct($name, $price);
        $this->author = $author;
        $this->publication_year = $year;
        $this->genre = $genre;
    }

    public function displayProduct() {
        echo "<h3>Book Info</h3>";
        echo "Title: $this->product_name<br>";
        echo "Author: $this->author<br>";
        echo "Year: $this->publication_year<br>";
        echo "Genre: $this->genre<br>";
        echo "Price: $" . number_format($this->product_price, 2) . "<br>";
    }
}
?>