<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$query = "SELECT * FROM orders WHERE student_id = $student_id ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Orders</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Your Order History</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table border="1">
            <tr>
                <th>Order ID</th>
                <th>Status</th>
                <th>Total</th>
                <th>Slot</th>
                <th>Placed On</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>₹<?= $row['total_amount'] ?></td>
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
