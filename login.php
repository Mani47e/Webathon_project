<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "gc";

// Establish database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ------------------ SIGNUP PROCESS ------------------
if (isset($_POST["signup1"])) {
    $name = $_POST['fullname1'];
    $email = $_POST['email1'];
    $user_type = $_POST['user_type'];
    $password = $_POST['password1'];
    $confirm_password = $_POST['confirm_password1'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit();
    }

    // Check if email already exists
    $check_sql = "SELECT * FROM signup WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "Email already exists. Please try a different email.";
        exit();
    }

    $check_stmt->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $insert_sql = "INSERT INTO signup (fullname, email, user_type, password) VALUES (?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("ssss", $name, $email, $user_type, $hashed_password);

    if ($insert_stmt->execute()) {
        // Redirect based on user type
        if ($user_type === "buyer") {
            header("Location: buyerportal.html");
        } elseif ($user_type === "seller") {
            header("Location: sellerportal.html");
        } else {
            echo "Invalid user type.";
        }
        exit();
    } else {
        echo "Signup failed: " . $insert_stmt->error;
    }

    $insert_stmt->close();
}

// ------------------ LOGIN PROCESS ------------------
if (isset($_POST["login"])) {
    $email = $_POST['email'];
    $user_password = $_POST['password'];

    // Fetch user data
    $login_sql = "SELECT user_type, password FROM signup WHERE email = ?";
    $login_stmt = $conn->prepare($login_sql);
    $login_stmt->bind_param("s", $email);
    $login_stmt->execute();
    $login_stmt->store_result();

    if ($login_stmt->num_rows === 1) {
        $login_stmt->bind_result($user_type, $stored_password);
        $login_stmt->fetch();

        // Verify password
        if (password_verify($user_password, $stored_password)) {
            // Redirect based on user type
            if ($user_type === "buyer") {
                header("Location: buyerportal.html");
            } elseif ($user_type === "seller") {
                header("Location: sellerportal.html");
            } else {
                echo "Invalid user type.";
            }
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Email not found.";
    }

    $login_stmt->close();
}

// Close the database connection
mysqli_close($conn);
?>
