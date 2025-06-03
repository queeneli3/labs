<?php
$conn = new mysqli("localhost", "root", "", "StudentDB");

// Check if 'id' is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize ID to avoid SQL injection

    $sql = "DELETE FROM Students WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Student deleted successfully.<br><a href='view_students.php'>Back to List</a>";
    } else {
        echo "Error deleting student: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No student ID specified.";
}

$conn->close();
?>