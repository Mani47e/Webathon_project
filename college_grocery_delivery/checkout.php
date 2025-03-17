<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: student/login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$query = "SELECT cart.product_id, products.name, products.price, cart.quantity, (products.price * cart.quantity) AS total
          FROM cart
          JOIN products ON cart.product_id = products.id
          WHERE cart.student_id = $student_id";

$result = mysqli_query($conn, $query);
$total_amount = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Checkout</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <form action="process_order.php" method="POST">
            <table border="1">
                <tr>
                    <th>Product</th>
                    <th>Price (₹)</th>
                    <th>Quantity</th>
                    <th>Total (₹)</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['price'] ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td><?= $row['total'] ?></td>
                    </tr>
                    <?php $total_amount += $row['total']; ?>
                <?php endwhile; ?>
            </table>

            <h3>Total Payable Amount: ₹<?= $total_amount ?></h3>

            <label for="delivery_slot">Choose Delivery Slot:</label>
            <select name="delivery_slot" required>
                <option value="9AM - 11AM">9AM - 11AM</option>
                <option value="12PM - 2PM">12PM - 2PM</option>
                <option value="4PM - 6PM">4PM - 6PM</option>
            </select>

            <input type="hidden" name="total_amount" value="<?= $total_amount ?>">
            <br><br>
            <button type="submit">Place Order</button>
        </form>
    <?php else: ?>
        <p>Your cart is empty. <a href="student/home.php">Shop Now</a></p>
    <?php endif; ?>
</body>
</html>
