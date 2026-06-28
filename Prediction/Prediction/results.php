<?php
session_start();
$prediction = $_SESSION['prediction'] ?? [];
$user_data = $_SESSION['user_data'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Prediction Results</title>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Career Prediction Results</h1>
        <div class="p-4 shadow rounded bg-white">
            <h3>Welcome, <?php echo htmlspecialchars($user_data['fullName'] ?? 'User'); ?>!</h3>
            <p>Based on your input, here is your career prediction:</p>
            <div class="card mb-3">
                <div class="card-header">Your Profile</div>
                <div class="card-body">
                    <p><strong>Field:</strong> <?php echo htmlspecialchars($user_data['mainField'] ?? 'N/A'); ?></p>
                    <p><strong>Domain:</strong> <?php echo htmlspecialchars($user_data['domain'] ?? 'N/A'); ?></p>
                    <p><strong>Technical Skill:</strong> <?php echo htmlspecialchars($user_data['technicalSkills'] ?? 'N/A'); ?></p>
                    <p><strong>Education Level:</strong> <?php echo htmlspecialchars($user_data['educationLevel'] ?? 'N/A'); ?></p>
                    <p><strong>Field of Study:</strong> <?php echo htmlspecialchars($user_data['fieldOfStudy'] ?? 'N/A'); ?></p>
                    <p><strong>Future Goal:</strong> <?php echo htmlspecialchars($user_data['futureGoal'] ?? 'N/A'); ?></p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">Recommended Study Path</div>
                <div class="card-body">
                    <p><?php echo htmlspecialchars($prediction['study']); ?></p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">Suggested Colleges</div>
                <div class="card-body">
                    <ul>
                        <?php foreach ($prediction['colleges'] as $college): ?>
                            <li><?php echo htmlspecialchars($college); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">Placement Ratio</div>
                <div class="card-body">
                    <p><?php echo htmlspecialchars($prediction['placement_ratio']); ?></p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">Job Opportunities</div>
                <div class="card-body">
                    <ul>
                        <?php foreach ($prediction['job_opportunities'] as $job): ?>
                            <li><?php echo htmlspecialchars($job); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">Future Scope</div>
                <div class="card-body">
                    <p><?php echo htmlspecialchars($prediction['future_scope']); ?></p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">Expected Salary Package</div>
                <div class="card-body">
                    <p><?php echo htmlspecialchars($prediction['package']); ?></p>
                </div>
            </div>
            <a href="index.html" class="btn btn-primary w-100">Back to Form</a>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>