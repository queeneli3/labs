<?php
$conn = new mysqli("localhost", "root", "", "StudentDB");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM Students WHERE student_id = $id");
    $student = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("UPDATE Students SET name=?, email=?, phone_number=? WHERE student_id=?");
    $stmt->bind_param("sssi", $name, $email, $phone, $id);
    $stmt->execute();
    header("Location: view_students.php");
}
?>

<?php if (isset($student)): ?>
<form method="POST">
    <input type="hidden" name="id" value="<?= $student['student_id'] ?>">
    Name: <input type="text" name="name" value="<?= $student['name'] ?>" required><br><br>
    Email: <input type="email" name="email" value="<?= $student['email'] ?>" required><br><br>
    Phone: <input type="text" name="phone" value="<?= $student['phone_number'] ?>" required><br><br>
    <input type="submit" value="Update Student">
</form>
<?php else: ?>
<p>No student found.</p>
<?php endif; ?>