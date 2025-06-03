<?php
require_once 'Loanable.php';

class Book implements Loanable {
    public $title, $author, $price, $genre;

    public function __construct($title, $author, $price, $genre) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
        $this->genre = $genre;
    }

    public function borrowBook($memberId) {
        echo "Borrowed '{$this->title}' by member ID: $memberId";
    }

    public function returnBook($memberId) {
        echo "Returned '{$this->title}' by member ID: $memberId";
    }
}
?>