<?php
// signup.php

// Database connection
$conn = new mysqli("localhost", "root", "", "career_prediction");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect POST data
$full_name = $_POST['full_name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($full_name && $email && $password) {

    // Check if email already exists
    $check = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<h3>Email already registered! <a href='login&signin.html'>Try again</a></h3>";
    } else {
        // Hash password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Insert into users table
        $stmt = $conn->prepare("INSERT INTO users (email, full_name, password_hash) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $full_name, $password_hash);

        if ($stmt->execute()) {
            echo "<h3>Sign-up successful! <a href='login&signin.html'>Login here</a></h3>";
        } else {
            echo "<h3>Error: " . $stmt->error . "</h3>";
        }
        $stmt->close();
    }

    $check->close();
} else {
    echo "<h3>Please fill in all fields. <a href='login&signin.html'>Back</a></h3>";
}

$conn->close();
?>