<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Validate inputs
    if (empty($name) || empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid email format.']);
        exit;
    }
    
    if (strlen($password) < 8) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Password must be at least 8 characters.']);
        exit;
    }
    
    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        http_response_code(409);
        echo json_encode(['status' => 'error', 'message' => 'Email already registered.']);
        exit;
    }
    $stmt->close();
    
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);
    
    if ($stmt->execute()) {
        // Set session variables
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        
        echo json_encode([
            'status' => 'success', 
            'message' => 'Registration successful!',
            'redirect' => 'dashboard.php'
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Registration failed. Please try again.']);
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: signup.html");
    exit;
}
?>