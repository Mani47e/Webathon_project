<?php
session_start();
include('../config/db.php');
$_SESSION['student_id'] = $student['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['student_id'] = $row['id'];
        $_SESSION['student_name'] = $row['name'];
        header("Location: home.php");
        exit;
    } else {
        echo "<script>alert('Invalid credentials!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Student Login</h2>
    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
        <p>New user? <a href="register.php">Register here</a></p>
    </form>
</div>
</body>
</html>
