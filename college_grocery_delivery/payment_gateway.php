<?php
session_start();
if (!isset($_SESSION['checkout'])) {
    header("Location: index.php");
    exit;
}

$amount = $_SESSION['checkout']['amount'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Gateway</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Dummy Payment Gateway</h2>
    <p>Payable Amount: ₹<?= $amount ?></p>
    <form action="process_order.php" method="POST">
        <button type="submit">Simulate Payment</button>
    </form>
</div>
</body>
</html>
