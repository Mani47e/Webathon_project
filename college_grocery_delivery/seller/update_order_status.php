<?php
include '../config/db.php';

if (isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $query = "UPDATE orders SET status='$status' WHERE id=$order_id";
    if (mysqli_query($conn, $query)) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status.";
    }
}
?>
