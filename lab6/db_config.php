<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LibraryDB2";

try {
    // Using PDO for better security
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Also create mysqli connection for compatibility
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
} catch(PDOException $e) {
die("Connection failed: " . $e->getMessage());
}
?>
