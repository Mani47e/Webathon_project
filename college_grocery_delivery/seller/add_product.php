<?php
session_start();
if (!isset($_SESSION['seller_id'])) {
    header("Location: login.php");
    exit;
}
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name        = $_POST['name'];
    $description = $_POST['description'];
    $price       = $_POST['price'];
    $quantity    = $_POST['quantity'];
    $seller_id   = $_SESSION['seller_id'];

    $image = $_FILES['image']['name'];
    $tmp   = $_FILES['image']['tmp_name'];
    $uploadPath = "../uploads/" . basename($image);

    if (move_uploaded_file($tmp, $uploadPath)) {
        $sql = "INSERT INTO products (name, description, price, quantity, image, seller_id) 
                VALUES ('$name', '$description', '$price', '$quantity', '$image', '$seller_id')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Product added successfully');</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Failed to upload image');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Add New Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="name" required>

        <label>Description:</label>
        <textarea name="description" required></textarea>

        <label>Price (in ₹):</label>
        <input type="number" name="price" step="0.01" required>

        <label>Quantity:</label>
        <input type="number" name="quantity" required>

        <label>Product Image:</label>
        <input type="file" name="image" required>

        <button type="submit">Add Product</button>
    </form>
    <p><a href="dashboard.php">Back to Dashboard</a></p>
</div>
</body>
</html>
