<?php
include('../config/db.php');

$search = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';

$results = mysqli_query($conn, "SELECT * FROM products WHERE name LIKE '%$search%' OR description LIKE '%$search%'");

$data = [];
while ($row = mysqli_fetch_assoc($results)) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>
