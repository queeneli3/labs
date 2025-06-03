<?php
// Step 1: Connect to the database
$conn = new mysqli("localhost", "root", "", "StudentDB");

// Step 2: Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 3: Get form data safely
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';

// Step 4: Validate inputs
if (empty($name) || empty($email) || empty($phone)) {
    die("All fields are required.");
}

// Step 5: Prepare and execute the insert statement
$sql = "INSERT INTO Students (name, email, phone_number) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $phone);

if ($stmt->execute()) {
    echo "Student added successfully!<br><a href='view_student.php'>View Students</a>";
} else {
    echo "Error: " . $stmt->error;
}

// Step 6: Close connection
$stmt->close();
$conn->close();
?>