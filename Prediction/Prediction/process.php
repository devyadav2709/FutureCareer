<?php
// Mock data for predictions (in a real scenario, this would come from a database or API)
$predictions = [
    'engineering' => [
        'Mechanical Engineering' => [
            'study' => 'B.Tech in Mechanical Engineering, M.Tech in Design or Manufacturing',
            'colleges' => ['IIT Delhi', 'IIT Bombay', 'NIT Trichy'],
            'placement_ratio' => '80-90%',
            'job_opportunities' => ['Automotive Industry', 'Aerospace', 'Manufacturing'],
            'future_scope' => 'High demand in automation, robotics, and renewable energy sectors.',
            'package' => 'INR 6-15 LPA'
        ],
        'Computer Science / IT' => [
            'study' => 'B.Tech in Computer Science, M.Tech in AI/ML or Data Science',
            'colleges' => ['IIT Kanpur', 'IIIT Hyderabad', 'BITS Pilani'],
            'placement_ratio' => '90-95%',
            'job_opportunities' => ['Software Development', 'AI/ML', 'Cybersecurity'],
            'future_scope' => 'Growing demand in AI, cloud computing, and software engineering.',
            'package' => 'INR 10-30 LPA'
        ],
        // Add more domains as needed
    ],
    'computer' => [
        'Software Development' => [
            'study' => 'B.Tech in Computer Science, Certifications in Full Stack Development',
            'colleges' => ['IIT Madras', 'IIT Kharagpur', 'VIT Vellore'],
            'placement_ratio' => '85-95%',
            'job_opportunities' => ['Software Engineer', 'DevOps', 'Backend Developer'],
            'future_scope' => 'High growth in tech startups, product-based companies, and remote work.',
            'package' => 'INR 8-25 LPA'
        ],
        'Data Science / Analytics' => [
            'study' => 'B.Tech in Data Science, M.Sc in Data Analytics',
            'colleges' => ['IIT Guwahati', 'ISI Kolkata', 'CMI Chennai'],
            'placement_ratio' => '80-90%',
            'job_opportunities' => ['Data Scientist', 'Data Analyst', 'ML Engineer'],
            'future_scope' => 'Increasing demand in AI, big data, and business intelligence.',
            'package' => 'INR 12-35 LPA'
        ],
        // Add more domains as needed
    ],
    // Add other main fields as needed
];

// Handle file upload
$resume = '';
if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $resume = $upload_dir . basename($_FILES['resume']['name']);
    move_uploaded_file($_FILES['resume']['tmp_name'], $resume);
}

// Retrieve form data
$mainField = $_POST['mainField'] ?? '';
$domain = $_POST['domain'] ?? '';
$technicalSkills = $_POST['technicalSkills'] ?? '';
$fullName = $_POST['fullName'] ?? '';
$email = $_POST['email'] ?? '';
$educationLevel = $_POST['educationLevel'] ?? '';
$fieldOfStudy = $_POST['fieldOfStudy'] ?? '';
$futureGoal = $_POST['futureGoal'] ?? '';

// Generate prediction
$prediction = [
    'study' => 'Not available',
    'colleges' => ['Not available'],
    'placement_ratio' => 'Not available',
    'job_opportunities' => ['Not available'],
    'future_scope' => 'Not available',
    'package' => 'Not available'
];

if (isset($predictions[$mainField][$domain])) {
    $prediction = $predictions[$mainField][$domain];
}

// Store data in session to pass to results page
session_start();
$_SESSION['prediction'] = $prediction;
$_SESSION['user_data'] = [
    'fullName' => $fullName,
    'email' => $email,
    'mainField' => $mainField,
    'domain' => $domain,
    'technicalSkills' => $technicalSkills,
    'educationLevel' => $educationLevel,
    'fieldOfStudy' => $fieldOfStudy,
    'futureGoal' => $futureGoal
];

header('Location: results.php');
exit;
?>
