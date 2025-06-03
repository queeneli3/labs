<?php
require_once 'Book.php';
require_once 'Discountable.php';

class Ebook extends Book implements Discountable {
    public function download() {
        echo "Downloading eBook: {$this->title}";
    }

    public function getDiscount() {
        return $this->price * 0.9; // 10% discount
    }
}
?>