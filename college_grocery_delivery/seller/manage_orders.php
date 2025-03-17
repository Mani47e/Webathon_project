<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['seller_id'])) {
    header("Location: login.php");
    exit();
}

$seller_id = $_SESSION['seller_id'];

$query = "
SELECT o.id as order_id, s.name as student_name, o.status, o.delivery_slot, o.created_at
FROM orders o
JOIN order_items oi ON o.id = oi.order_id
JOIN products p ON oi.product_id = p.id
JOIN students s ON o.student_id = s.id
WHERE p.seller_id = $seller_id
GROUP BY o.id
ORDER BY o.created_at DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seller Orders</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Orders Received</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Student Name</th>
            <th>Status</th>
            <th>Delivery Slot</th>
            <th>Placed On</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['order_id'] ?></td>
            <td><?= $row['student_name'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['delivery_slot'] ?></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>
</body>
</html>
