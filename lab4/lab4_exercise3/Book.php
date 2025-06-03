<?php
require_once 'Product.php';
require_once 'Discountable.php';

class Book extends Product implements Discountable {
    public $author, $year, $genre;

    public function __construct($name, $price, $author, $year, $genre) {
        parent::__construct($name, $price);
        $this->author = $author;
        $this->year = $year;
        $this->genre = $genre;
    }

    public function getDiscount() {
        return $this->product_price * 0.1;
    }

    public function displayProduct() {
        echo "Title: $this->product_name<br>";
        echo "Author: $this->author<br>";
        echo "Year: $this->year<br>";
        echo "Genre: $this->genre<br>";
        echo "Price: $this->product_price<br>";
        echo "Discount: " . $this->getDiscount() . "<br><br>";
    }
}
?>