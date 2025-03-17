<?php
session_start();
include('../config/db.php');

$student_id = $_SESSION['student_id'];

$sql = "SELECT * FROM orders WHERE student_id='$student_id' ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<h2>Track Your Orders</h2>
<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Status</th>
        <th>Expected Slot</th>
        <th>Last Updated</th>
    </tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td><?php echo $row['delivery_slot']; ?></td>
        <td><?php echo isset($row['updated_at']) ? $row['updated_at'] : $row['created_at']; ?></td>
    </tr>
<?php } ?>
</table>
