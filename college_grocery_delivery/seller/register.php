<?php
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $address  = $_POST['address'];
    $contact  = $_POST['contact'];
    $hours    = $_POST['hours'];

    $sql = "INSERT INTO sellers (name, email, password, address, contact, operating_hours) 
            VALUES ('$name', '$email', '$password', '$address', '$contact', '$hours')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registration successful'); window.location.href='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seller Registration</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Seller Registration</h2>
    <form method="POST">
        <label>Store Name:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Store Address:</label>
        <input type="text" name="address" required>

        <label>Contact Number:</label>
        <input type="text" name="contact" required>

        <label>Operating Hours:</label>
        <input type="text" name="hours" placeholder="e.g., 9AM - 9PM" required>

        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>
</body>
</html>
