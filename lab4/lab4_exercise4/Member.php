<?php
class Member {
    public $name, $email, $membership_date;

    public function __construct($name, $email, $membership_date) {
        $this->name = $name;
        $this->email = $email;
        $this->membership_date = $membership_date;
    }

    public function viewBorrowedBooks() {
        echo "{$this->name} is viewing their borrowed books.";
    }
}
?>