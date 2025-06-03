<?php
class Product {
    public $product_name;
    public $product_price;

    public function __construct($name, $price) {
        $this->product_name = $name;
        $this->product_price = $price;
    }

    public function displayProduct() {
        echo "Product: $this->product_name<br>";
        echo "Price: $this->product_price<br>";
    }
}
?>