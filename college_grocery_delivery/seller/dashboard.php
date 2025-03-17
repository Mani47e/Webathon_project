<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['seller_id'])) {
    header("Location: login.php");
    exit();
}

$seller_id = $_SESSION['seller_id'];

$total_products = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM products WHERE seller_id = $seller_id"))['total'];

$total_orders = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(DISTINCT o.id) as total
    FROM orders o
    JOIN order_items oi ON o.id = oi.order_id
    JOIN products p ON oi.product_id = p.id
    WHERE p.seller_id = $seller_id
"))['total'];

$total_earnings = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT SUM(oi.total) as total
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE p.seller_id = $seller_id
"))['total'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Welcome, Seller!</h2>
    <div>
        <p><strong>Total Products:</strong> <?= $total_products ?></p>
        <p><strong>Total Orders Received:</strong> <?= $total_orders ?></p>
        <p><strong>Total Earnings:</strong> ₹<?= number_format($total_earnings, 2) ?></p>
    </div>

    <p><a href="manage_products.php">Manage Products</a> | <a href="manage_orders.php">View Orders</a></p>
</body>
</html>
