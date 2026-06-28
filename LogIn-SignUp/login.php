<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "career_prediction");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($email && $password) {
    $sql = "SELECT full_name, password_hash FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($full_name, $password_hash);
        $stmt->fetch();

        if (password_verify($password, $password_hash)) {
            // Store session
            $_SESSION['user'] = $full_name;

            // Update last login
            $update = $conn->prepare("UPDATE users SET last_login = NOW() WHERE email = ?");
            $update->bind_param("s", $email);
            $update->execute();
            $update->close();

            echo "<h3>Welcome, $full_name! You are now logged in. <a href='logout.php'>Logout</a></h3>";
        } else {
            echo "<h3>Invalid password. <a href='login&signin.html'>Try again</a></h3>";
        }
    } else {
        echo "<h3>User not found. <a href='login&signin.html'>Sign Up</a></h3>";
    }
    $stmt->close();
} else {
    echo "⚠️ Please enter both email and password. <a href='login&signin.html'>Back</a>";
}

$conn->close();
?>