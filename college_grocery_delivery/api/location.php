<?php
// Simulated response for auto location detection
header('Content-Type: application/json');
echo json_encode([
    'location' => 'College Hostel, Block A',
    'status' => 'success'
]);
?>
