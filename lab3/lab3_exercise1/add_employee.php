<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "EmployeeDB");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$departments = $conn->query("SELECT * FROM Department");
?>

<!DOCTYPE html>
<html>
<head><title>Add Employee</title></head>
<body>
<h2>Add Employee</h2>
<form method="POST" action="process_employee.php">
    Name: <input type="text" name="emp_name" required><br><br>
    Salary: <input type="text" name="emp_salary" required><br><br>
    Department:
    <select name="emp_dept_id" required>
        <option value="">Select Department</option>
        <?php while($row = $departments->fetch_assoc()) {
            echo "<option value='{$row['dept_id']}'>{$row['dept_name']} - {$row['dept_location']}</option>";
        } ?>
    </select><br><br>
    <input type="submit" value="Add Employee">
</form>
</body>
</html>