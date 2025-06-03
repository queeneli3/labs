<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "EmployeeDB");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['emp_name']);
    $salary = trim($_POST['emp_salary']);
    $dept_id = trim($_POST['emp_dept_id']);

    if (empty($name) || empty($salary) || empty($dept_id)) {
        die("All fields are required.");
    }

    if (!is_numeric($salary)) {
        die("Salary must be a number.");
    }

    $stmt = $conn->prepare("INSERT INTO Employee (emp_name, emp_salary, emp_dept_id) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $name, $salary, $dept_id);

    if ($stmt->execute()) {
        echo "Employee added successfully!<br><a href='view_employee.php'>View Employees</a>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>