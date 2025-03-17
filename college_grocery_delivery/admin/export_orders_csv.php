<?php
include '../config/db.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=orders_report.csv');

$output = fopen("php://output", "w");
fputcsv($output, ['Order ID', 'Student ID', 'Amount', 'Status', 'Slot', 'Created At']);

$rows = mysqli_query($conn, "SELECT * FROM orders");
while ($row = mysqli_fetch_assoc($rows)) {
    fputcsv($output, $row);
}

fclose($output);
exit;
