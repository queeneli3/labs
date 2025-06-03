<?php
require_once 'Product.php';
require_once 'Discountable.php';

class Electronics extends Product 
implements Discountable {
    public function getDiscount() {
        return $this->product_price * 0.20;
    }

    public function displayProduct() {
        echo "<h3>Electronics Info</h3>";
        echo "Name: $this->product_name<br>";
        echo "Price: $" . number_format($this->product_price, 2) . "<br>";
    }
}
?>