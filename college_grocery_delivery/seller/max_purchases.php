<?php
include('../config/db.php');
session_start();

$seller_id = $_SESSION['seller_id'] ?? 0;

// SQL to get top students by total purchase amount for current seller
$sql = "SELECT s.name AS student_name, s.email, SUM(oi.total) AS total_purchase
        FROM order_items oi
        JOIN orders o ON oi.order_id = o.id
        JOIN students s ON o.student_id = s.id
        JOIN products p ON oi.product_id = p.id
        WHERE p.seller_id = $seller_id
        GROUP BY s.id
        ORDER BY total_purchase DESC";

// Execute the query
$result = mysqli_query($conn, $sql);

// Debugging line - tell us why it failed
if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<h2>Top Students by Purchase</h2>
<table border="1">
    <tr>
        <th>Student Name</th>
        <th>Email</th>
        <th>Total Purchase (₹)</th>
    </tr>

<?php
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['student_name']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['total_purchase']}</td>";
    echo "</tr>";
}
?>
</table>
