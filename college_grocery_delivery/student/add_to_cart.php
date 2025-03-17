<?php
session_start();
include('../config/db.php');

if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['student_id'])) {
        header("Location: login.php");
        exit();
    }

    $student_id = $_SESSION['student_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $check = mysqli_query($conn, "SELECT * FROM cart WHERE student_id='$student_id' AND product_id='$product_id'");
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "UPDATE cart SET quantity = quantity + $quantity WHERE student_id='$student_id' AND product_id='$product_id'");
    } else {
        mysqli_query($conn, "INSERT INTO cart (student_id, product_id, quantity) VALUES ('$student_id', '$product_id', '$quantity')");
    }

    header("Location: cart.php");
    exit();
}
