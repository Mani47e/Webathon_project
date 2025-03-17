<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$cart_id = $_GET['id'] ?? 0;

if ($cart_id > 0) {
    mysqli_query($conn, "DELETE FROM cart WHERE id = $cart_id");
}

header("Location: cart.php");
?>
