<?php
class Product {
    public $product_name;
    public $product_price;

    public function __construct($name, $price) {
        $this->product_name = $name;
        $this->product_price = $price;
    }

    public function displayProduct() {
        echo "<h3>Product Info</h3>";
        echo "Name: $this->product_name<br>";
        echo "Price: $" . number_format($this->product_price, 2) . "<br>";
    }
}
?>