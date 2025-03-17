<?php
session_start();
include('../config/db.php');

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$query = "SELECT cart.id AS cart_id, products.name, products.description, products.price, products.image, cart.quantity
          FROM cart
          INNER JOIN products ON cart.product_id = products.id
          WHERE cart.student_id = $student_id";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Your Cart</h2>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <table border="1" cellpadding="10">
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php 
            $grand_total = 0;
            while ($row = mysqli_fetch_assoc($result)):
                $total = $row['price'] * $row['quantity'];
                $grand_total += $total;
            ?>
            <tr>
                <td><img src="../uploads/<?php echo $row['image']; ?>" width="50"></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>₹<?php echo $row['price']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td>₹<?php echo $total; ?></td>
                <td><a href="remove_from_cart.php?id=<?php echo $row['cart_id']; ?>">Remove</a></td>
            </tr>
            <?php endwhile; ?>
            <tr>
                <td colspan="5" align="right"><strong>Total:</strong></td>
                <td colspan="2"><strong>₹<?php echo $grand_total; ?></strong></td>
            </tr>
        </table>
        <br>
        <a href="../checkout.php"><button>Proceed to Checkout</button></a>
        <a href="home.php"><button>Continue Shopping</button></a>
    <?php else: ?>
        <p>Your cart is empty.</p>
        <a href="home.php"><button>Continue Shopping</button></a>
    <?php endif; ?>
</body>
</html>
