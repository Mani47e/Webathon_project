<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "gc";

// Establish the connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the signup form is submitted


if (isset($_POST["signup1"])) {
    $name = $_POST['fullname1'];
    $user_type = $_POST['user_type'];
    $email = $_POST['email1'];
    $password = $_POST['password1'];
    $password1 = $_POST['confirm_password1'];
  
        // Prepare the SQL query
        $sql = "INSERT INTO signup (fullname,seller, email, password,confirm_password) VALUES ('$name','$user_type', '$email', '$password', '$password1')";

        if (mysqli_query($conn, $sql)) {
            header("Location: buyyerportal.html");
                 exit();

        }     }
 if(isset($_POST["login"])) {
    $email = $_POST['email'];
    $user_password = $_POST['password'];

    // SQL query to fetch user data based on the email
    $sql = "SELECT email, password FROM signup WHERE email = ?";
    
    // Prepare and bind statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email); // "s" for string parameter (email)
        $stmt->execute();
        $stmt->store_result();

        // Check if the email exists
        if ($stmt->num_rows == 1) {
            // Bind result variables
            $stmt->bind_result($id, $stored_password);
            $stmt->fetch();

            
            // Verify the password
            if ($user_password===$stored_password) {
                // Password is correct, login success
                 header("Location: buyyerportal.html");
                 exit();
                // Redirect to a secured page or dashboard
                // header("Location: dashboard.php");
            }        } 
        $stmt->close();
    }}


// Close the connection
mysqli_close($conn);



?>
