<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard - Future AI Career Prediction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: radial-gradient(ellipse at center, #0a0a2a 0%, #000010 100%);
            color: white;
            min-height: 100vh;
            padding: 20px;
        }

        .dashboard-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            max-width: 800px;
            margin: 50px auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="dashboard-container">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
            <p class="lead">Future AI Career Prediction Dashboard</p>

            <div class="mt-4">
                <h3>Your Career Insights</h3>
                <p>AI-powered career predictions will appear here.</p>
            </div>

            <a href="logout.php" class="btn btn-danger mt-4">Logout</a>
        </div>
    </div>
</body>

</html>