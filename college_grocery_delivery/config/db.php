<?php
$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "college_grocery_delivery";

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
