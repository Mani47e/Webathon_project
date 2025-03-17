<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}
include('../config/db.php');
$products = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Home</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<form action="add_to_cart.php" method="POST">
    <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
    <button type="submit">Add to Cart</button>
</form>

<div class="container">
    <h2>Welcome, <?php echo $_SESSION['student_name']; ?>!</h2>
    <h3>Available Products</h3>
    <div class="product-list">
        <?php while ($row = mysqli_fetch_assoc($products)) { ?>
            <div class="product-card">
                <img src="../uploads/<?php echo $row['image']; ?>" alt="Product">
                <h4><?php echo $row['name']; ?></h4>
                <p><?php echo $row['description']; ?></p>
                <p>Price: ₹<?php echo $row['price']; ?></p>
                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit" name="add_to_cart">Add to Cart</button>
                </form>
            </div>
        <?php } ?>
    </div>
    <p><a href="cart.php">Go to Cart</a> | <a href="order_history.php">Order History</a> | <a href="track_order.php">Track Order</a></p>
</div>
</body>
</html>
