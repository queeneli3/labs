<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "EmployeeDB");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT emp_id, emp_name, emp_salary, dept_name, dept_location 
        FROM Employee 
        INNER JOIN Department ON Employee.emp_dept_id = Department.dept_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head><title>Employee List</title></head>
<body>
<h2>Employee Details</h2>

<?php
if ($result && $result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th><th>Name</th><th>Salary</th><th>Department</th><th>Location</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['emp_id']}</td>
                <td>{$row['emp_name']}</td>
                <td>{$row['emp_salary']}</td>
                <td>{$row['dept_name']}</td>
                <td>{$row['dept_location']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No employee data found.";
}
?>
</body>
</html>