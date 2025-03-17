<?php
session_start();
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM sellers WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $seller = mysqli_fetch_assoc($result);

    if ($seller && password_verify($password, $seller['password'])) {
        $_SESSION['seller_id'] = $seller['id'];
        $_SESSION['seller_name'] = $seller['name'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seller Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Seller Login</h2>
    <?php if (!empty($error)) echo "<div class='alert'>$error</div>"; ?>
    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>
</body>
</html>
