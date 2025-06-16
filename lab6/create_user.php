<?php
include 'db_config.php';

// Check if Users table exists, if not create it
try {
    $pdo->query("SELECT 1 FROM Users LIMIT 1");
} catch (PDOException $e) {
    // Table doesn't exist, create it
    $pdo->exec("CREATE TABLE Users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Users table created.<br>";
}

// Create a default admin user
$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO Users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);
    echo "Default user created successfully!<br>";
    echo "Username: admin<br>";
    echo "Password: admin123<br>";
    echo "<a href='login.php'>Go to login page</a>";
} catch (PDOException $e) {
    if ($e->getCode() == 23000) { // Duplicate entry
        echo "User 'admin' already exists.<br>";
        echo "<a href='login.php'>Go to login page</a>";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
?>