<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname = "gc";

// Establish the connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST["signup"]))
{
$name=$_POST['fullname'];
$user_type = $_POST['user_type'];
$email=$_POST['email'];
$password=$_POST['password'];
$password1=$_POST['confirm_password'];

$sql="INSERT INTO signup ($fullname,$seller,$email,$password,$confirm_password) VALUES ('$name','$user_type','$email','$password','$password1')";

if(mysqli_query($conn,$sql)){
echo "new record successfully";
}else{
echo "no record added";
}
mysqli_close($conn)
}
else
echo "not inserted";




