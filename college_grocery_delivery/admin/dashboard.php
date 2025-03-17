<?php
session_start();
include '../config/db.php';

// Optional: Check for admin session
// if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }

// Fetch dashboard stats
$total_students = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM students"))['total'];
$total_sellers  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM sellers"))['total'];
$total_orders   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM orders"))['total'];
$total_revenue  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_amount) as total FROM orders"))['total'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<a href="export_orders_csv.php">Export Orders as CSV</a>

    <h2>Admin Dashboard</h2>

    <div>
        <p><strong>Total Students:</strong> <?= $total_students ?></p>
        <p><strong>Total Sellers:</strong> <?= $total_sellers ?></p>
        <p><strong>Total Orders:</strong> <?= $total_orders ?></p>
        <p><strong>Total Revenue:</strong> ₹<?= number_format($total_revenue, 2) ?></p>
    </div>

    <p><a href="manage_students.php">Manage Students</a> | <a href="manage_sellers.php">Manage Sellers</a></p>
</body>
</html>
