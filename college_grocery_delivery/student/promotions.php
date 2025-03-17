<?php
include '../config/db.php';

$query = "SELECT p.name, pr.title, pr.discount_percent, pr.start_date, pr.end_date
          FROM promotions pr
          JOIN sellers s ON pr.seller_id = s.id
          JOIN products p ON p.seller_id = s.id
          ORDER BY pr.start_date DESC";

$result = mysqli_query($conn, $query);
?>

<h2>Available Promotions</h2>
<table border="1">
    <tr>
        <th>Product</th>
        <th>Promotion</th>
        <th>Discount (%)</th>
        <th>Start Date</th>
        <th>End Date</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['title'] ?></td>
        <td><?= $row['discount_percent'] ?></td>
        <td><?= $row['start_date'] ?></td>
        <td><?= $row['end_date'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>
