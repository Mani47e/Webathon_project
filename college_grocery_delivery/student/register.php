<?php
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $college_id = $_POST['college_id'];

    $check = mysqli_query($conn, "SELECT * FROM students WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already registered!');</script>";
    } else {
        $sql = "INSERT INTO students (name, email, password, college_id) 
                VALUES ('$name', '$email', '$password', '$college_id')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Registration successful!'); window.location='login.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Register</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Student Registration</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>College Email:</label>
        <input type="email" name="email" required>

        <label>College ID:</label>
        <input type="text" name="college_id" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Register</button>
        <p>Already registered? <a href="login.php">Login here</a></p>
    </form>
</div>
</body>
</html>
