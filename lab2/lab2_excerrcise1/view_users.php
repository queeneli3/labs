<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$conn = new mysqli("localhost", "root", "", "WebAppDB");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get all users
$sql = "SELECT * FROM Users";
$result = $conn->query($sql);

// Check if users exist
if ($result->num_rows > 0) {
    echo "<h2>User List</h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Age</th>
            </tr>";
    
    // Output data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['age']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No users found.</p>";
}
?>