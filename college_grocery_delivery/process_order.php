<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: student/login.php");
    exit();
}

$student_id = $_SESSION['student_id'];
$total_amount = $_POST['total_amount'];
$delivery_slot = $_POST['delivery_slot'];

if ($total_amount <= 0 || empty($delivery_slot)) {
    echo "Invalid order request.";
    exit();
}

// Insert order
mysqli_query($conn, "INSERT INTO orders (student_id, total_amount, delivery_slot, status) VALUES ($student_id, $total_amount, '$delivery_slot', 'Confirmed')");
$order_id = mysqli_insert_id($conn);

// Get cart items
$cart_items = mysqli_query($conn, "SELECT * FROM cart WHERE student_id = $student_id");

while ($item = mysqli_fetch_assoc($cart_items)) {
    $product_id = $item['product_id'];
    $quantity = $item['quantity'];

    // Get product price
    $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT price FROM products WHERE id = $product_id"));
    $price = $product['price'];
    $total = $price * $quantity;

    // Insert into order_items
    mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity, price, total) 
                         VALUES ($order_id, $product_id, $quantity, $price, $total)");

    // Decrease stock
    mysqli_query($conn, "UPDATE products SET stock = stock - $quantity WHERE id = $product_id");
}

// Clear cart
mysqli_query($conn, "DELETE FROM cart WHERE student_id = $student_id");

echo "<h3>Order Placed Successfully!</h3><a href='student/order_history.php'>View Order History</a>";
?>
