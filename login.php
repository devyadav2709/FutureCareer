<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Validate inputs
    if (empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }
    
    // Get user from database
    $stmt = $conn->prepare("SELECT id, full_name, email, password_hash FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password.']);
        exit;
    }
    
    $user = $result->fetch_assoc();
    
    // Verify password
    if (password_verify($password, $user['password_hash'])) {
        // Update last login
        $update_stmt = $conn->prepare("UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = ?");
        $update_stmt->bind_param("i", $user['id']);
        $update_stmt->execute();
        $update_stmt->close();
        
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['full_name'];
        
        echo json_encode([
            'status' => 'success', 
            'message' => 'Login successful!',
            'redirect' => 'dashboard.php'
        ]);
    } else {
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password.']);
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: login.html");
    exit;
}
?>