<?php
include 'db_connect.php';

// Enable error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Check if required parameters are present
if (!isset($_GET['field']) || !isset($_GET['domain']) || !isset($_GET['technical_skill'])) {
   die("<h2>Error: Missing Parameters</h2>
        <p>Please make sure you've selected all required options.</p>
        <a href='Form.php'>Go Back to Form</a>");
}

// Get and sanitize input values
$field = $conn->real_escape_string($_GET['field']);
$domain = $conn->real_escape_string($_GET['domain']);
$technical_skill = $conn->real_escape_string($_GET['technical_skill']);

// Query the database
$sql = "SELECT * FROM career_recommendation 
        WHERE field = '$field' 
        AND domain = '$domain' 
        AND technical_skill = '$technical_skill'";
$result = $conn->query($sql);

if (!$result) {
   die("Query failed: " . $conn->error . "<br>SQL: " . $sql);
}
?>

<!DOCTYPE html>
<html>

<head>
   <title>Career Prediction Result</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <style>
      body {
         margin: 0;
         font-family: 'Segoe UI', sans-serif;
         background: radial-gradient(ellipse at center, #0a0a2a 0%, #000010 100%);
         color: white;
         min-height: 100vh;
         padding: 20px;
      }

      .result-card {
         background: rgba(30, 30, 60, 0.8);
         padding: 30px;
         border-radius: 10px;
         box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
         margin-bottom: 30px;
         border: 1px solid rgba(255, 255, 255, 0.1);
      }

      h2 {
         color: #4fc3f7;
         border-bottom: 2px solid #4fc3f7;
         padding-bottom: 10px;
         margin-bottom: 20px;
      }

      h4 {
         color: #4fc3f7;
         margin-top: 25px;
         margin-bottom: 15px;
         padding-bottom: 5px;
         border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }

      .info-item {
         margin-bottom: 20px;
      }

      .info-label {
         font-weight: bold;
         color: #4fc3f7;
         margin-bottom: 5px;
         display: block;
      }

      .nav-links {
         margin-top: 30px;
         position: relative;
         z-index: 10;
      }

      ul {
         margin-top: 5px;
         padding-left: 20px;
      }

      li {
         margin-bottom: 10px;
         color: #e0e0e0;
      }

      .college-name {
         font-weight: bold;
         display: block;
      }

      .college-location {
         display: block;
         margin-left: 20px;
         color: #aaa;
         font-style: italic;
      }

      .badge {
         font-size: 0.9em;
         padding: 5px 10px;
         margin-right: 5px;
         margin-bottom: 5px;
      }

      .bg-primary {
         background-color: #1976d2 !important;
      }

      .bg-info {
         background-color: #0288d1 !important;
      }

      .bg-success {
         background-color: #388e3c !important;
      }

      .section {
         background-color: rgba(20, 20, 50, 0.5);
         padding: 15px;
         border-radius: 5px;
         margin-bottom: 20px;
         border: 1px solid rgba(255, 255, 255, 0.05);
      }

      .subject-container {
         display: flex;
         flex-wrap: wrap;
         gap: 10px;
         margin-top: 8px;
      }

      .subject-item {
         background-color: rgba(79, 195, 247, 0.15);
         padding: 8px 15px;
         border-radius: 5px;
         border-left: 3px solid #4fc3f7;
         position: relative;
         transition: all 0.3s ease;
      }

      .subject-item:hover {
         background-color: rgba(79, 195, 247, 0.25);
         transform: translateY(-2px);
      }

      .subject-item::after {
         content: ",";
         position: absolute;
         right: -7px;
         color: #4fc3f7;
      }

      .subject-item:last-child::after {
         content: "";
      }

      .btn-primary {
         background-color: #1976d2;
         border-color: #1976d2;
      }

      .btn-secondary {
         background-color: #5c6bc0;
         border-color: #5c6bc0;
      }

      .btn:hover {
         opacity: 0.9;
      }

      p {
         color: #e0e0e0;
      }

      a {
         position: relative;
         z-index: 10;
         text-decoration: none;
      }

      /* Salary Table Styles */
      .salary-table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 15px;
         background-color: rgba(30, 30, 60, 0.5);
         border-radius: 8px;
         overflow: hidden;
      }

      .salary-table th {
         background-color: rgba(79, 195, 247, 0.3);
         color: #4fc3f7;
         padding: 12px 15px;
         text-align: left;
      }

      .salary-table td {
         padding: 10px 15px;
         border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      }

      .salary-table tr:last-child td {
         border-bottom: none;
      }

      .salary-table tr:hover {
         background-color: rgba(79, 195, 247, 0.1);
      }

      .salary-level {
         font-weight: bold;
         color: #4fc3f7;
      }

      .salary-amount {
         color: #a5d6a7;
      }

      .salary-currency {
         color: #ce93d8;
      }

      .salary-note {
         font-size: 0.9em;
         color: #aaa;
         margin-top: 5px;
         font-style: italic;
      }
   </style>
</head>

<body>
   <div class="container">
      <div class="result-card">
         <?php if ($result->num_rows > 0):
            $row = $result->fetch_assoc(); ?>
            <h2>Career Prediction Result</h2>

            <div class="section">
               <h4>Your Selections</h4>
               <div class="comma-list">
                  <span class="badge bg-primary">Field: <?= htmlspecialchars($row['field']) ?></span>
                  <span class="badge bg-info text-white">Domain: <?= htmlspecialchars($row['domain']) ?></span>
                  <span class="badge bg-success">Technical Skill: <?= htmlspecialchars($row['technical_skill']) ?></span>
               </div>
            </div>

            <div class="section">
               <h4>Education Information</h4>
               <div class="info-item">
                  <div class="info-label">Best Colleges:</div>
                  <ul>
                     <?php
                     $colleges = json_decode($row['best_colleges'], true) ?: explode(',', $row['best_colleges']);

                     foreach ($colleges as $college):
                        $college = trim($college);
                        if (!empty($college)):
                           // Check if college contains location pattern
                           if (preg_match('/(.+)\n\s*-\s*(.+)/', $college, $matches)): ?>
                              <li>
                                 <span class="college-name"><?= htmlspecialchars(trim($matches[1])) ?></span>
                                 <span class="college-location"><?= htmlspecialchars(trim($matches[2])) ?></span>
                              </li>
                           <?php elseif (preg_match('/(.+)\n\s*(.+)/', $college, $matches)): ?>
                              <li>
                                 <span class="college-name"><?= htmlspecialchars(trim($matches[1])) ?></span>
                                 <span class="college-location"><?= htmlspecialchars(trim($matches[2])) ?></span>
                              </li>
                           <?php else: ?>
                              <li><?= htmlspecialchars($college) ?></li>
                           <?php endif;
                        endif;
                     endforeach; ?>
                  </ul>
               </div>

               <div class="info-item">
                  <div class="info-label">Core Subjects:</div>
                  <div class="subject-container">
                     <?php
                     // Get the core subjects data
                     $coreSubjects = $row['core_subjects'];

                     $cleaned = preg_replace('/[\[\]\'"”“]/', '', $coreSubjects);

                     $subjects = preg_split('/\s*,\s*/', $cleaned);
                     foreach ($subjects as $subject):
                        $subject = trim($subject);
                        if (!empty($subject)):
                           ?>
                           <div class="subject-item">
                              <?= htmlspecialchars($subject) ?>
                           </div>
                        <?php endif;
                     endforeach;
                     ?>
                  </div>
               </div>
            </div>

            <div class="section">
               <h4>Learning Resources</h4>
               <div class="info-item">
                  <div class="info-label">Recommended Books:</div>
                  <ul>
                     <?php
                     $books = explode(',', $row['recommended_books']);
                     foreach ($books as $book):
                        if (!empty(trim($book))):
                           ?>
                           <li><?= htmlspecialchars(trim($book)) ?></li>
                        <?php endif;
                     endforeach; ?>
                  </ul>
               </div>

               <div class="info-item">
                  <div class="info-label">Online Courses:</div>
                  <ul>
                     <?php
                     $courses = explode(',', $row['online_courses']);
                     foreach ($courses as $course):
                        if (!empty(trim($course))):
                           ?>
                           <li><?= htmlspecialchars(trim($course)) ?></li>
                        <?php endif;
                     endforeach; ?>
                  </ul>
               </div>

               <div class="info-item">
                  <div class="info-label">YouTube Channels:</div>
                  <ul>
                     <?php
                     $channels = explode(',', $row['youtube_channels']);
                     foreach ($channels as $channel):
                        if (!empty(trim($channel))):
                           ?>
                           <li><?= htmlspecialchars(trim($channel)) ?></li>
                        <?php endif;
                     endforeach; ?>
                  </ul>
               </div>

               <div class="info-item">
                  <div class="info-label">Useful Websites:</div>
                  <ul>
                     <?php
                     $websites = explode(',', $row['websites']);
                     foreach ($websites as $website):
                        if (!empty(trim($website))):
                           ?>
                           <li><?= htmlspecialchars(trim($website)) ?></li>
                        <?php endif;
                     endforeach; ?>
                  </ul>
               </div>
            </div>

            <div class="section">
               <h4>Career Information</h4>
               <div class="info-item">
                  <div class="info-label">Job Roles:</div>
                  <ul>
                     <?php
                     $jobs = explode(',', $row['job_roles']);
                     foreach ($jobs as $job):
                        if (!empty(trim($job))):
                           ?>
                           <li><?= htmlspecialchars(trim($job)) ?></li>
                        <?php endif;
                     endforeach; ?>
                  </ul>
               </div>

               <div class="info-item">
                  <div class="info-label">Job Market Status:</div>
                  <p><?= htmlspecialchars($row['job_status']) ?></p>
               </div>

               <div class="info-item">
                  <div class="info-label">Salary Information:</div>
                  <?php
                  // Parse the salary information into a table
                  $salaryInfo = $row['salary_info'];

                  // Check if the salary info is in a format that can be split into levels
                  if (strpos($salaryInfo, 'Entry-level') !== false || strpos($salaryInfo, 'Mid-career') !== false) {
                     // Split the salary info into lines
                     $salaryLines = preg_split('/\r\n|\r|\n/', $salaryInfo);

                     // Initialize table rows
                     $tableRows = [];

                     foreach ($salaryLines as $line) {
                        $line = trim($line);
                        if (!empty($line)) {
                           // Split each line into level and amount
                           if (preg_match('/(.*?):\s*(.*)/', $line, $matches)) {
                              $level = trim($matches[1]);
                              $amount = trim($matches[2]);
                              $tableRows[] = ['level' => $level, 'amount' => $amount];
                           } else {
                              $tableRows[] = ['level' => '', 'amount' => $line];
                           }
                        }
                     }

                     if (!empty($tableRows)) {
                        echo '<table class="salary-table">';
                        echo '<thead><tr><th>Experience Level</th><th>Salary Range</th></tr></thead>';
                        echo '<tbody>';
                        foreach ($tableRows as $row) {
                           echo '<tr>';
                           echo '<td class="salary-level">' . htmlspecialchars($row['level']) . '</td>';
                           echo '<td class="salary-amount">' . htmlspecialchars($row['amount']) . '</td>';
                           echo '</tr>';
                        }
                        echo '</tbody></table>';
                     } else {
                        echo '<p>' . htmlspecialchars($salaryInfo) . '</p>';
                     }
                  } else {
                     // If not in a parsable format, just display as is
                     echo '<p>' . htmlspecialchars($salaryInfo) . '</p>';
                  }
                  ?>
               </div>

               <div class="info-item">
                  <div class="info-label">Placement Information:</div>
                  <p><?= htmlspecialchars($row['placement_info']) ?></p>
               </div>
            </div>

            <div class="section">
               <h4>Professional Development</h4>
               <div class="info-item">
                  <div class="info-label">Training/Internship Opportunities:</div>
                  <ul>
                     <?php
                     $internships = explode(',', $row['training_internship']);
                     foreach ($internships as $internship):
                        if (!empty(trim($internship))):
                           ?>
                           <li><?= htmlspecialchars(trim($internship)) ?></li>
                        <?php endif;
                     endforeach; ?>
                  </ul>
               </div>

               <div class="info-item">
                  <div class="info-label">Career Path:</div>
                  <p><?= htmlspecialchars($row['career_path']) ?></p>
               </div>

               <div class="info-item">
                  <div class="info-label">Certifications:</div>
                  <ul>
                     <?php
                     $certs = explode(',', $row['certifications']);
                     foreach ($certs as $cert):
                        if (!empty(trim($cert))):
                           ?>
                           <li><?= htmlspecialchars(trim($cert)) ?></li>
                        <?php endif;
                     endforeach; ?>
                  </ul>
               </div>
            </div>

            <div class="nav-links">
               <a href="Form.php" class="btn btn-primary">New Prediction</a>
               <a href="ViewAllRecommendations.php" class="btn btn-secondary">View All Recommendations</a>
            </div>
         <?php else: ?>
            <h2>No Results Found</h2>
            <p>No career recommendation found for:</p>
            <ul>
               <li><strong>Field:</strong> <?= htmlspecialchars($field) ?></li>
               <li><strong>Domain:</strong> <?= htmlspecialchars($domain) ?></li>
               <li><strong>Technical Skill:</strong> <?= htmlspecialchars($technical_skill) ?></li>
            </ul>
            <p>Debug Info: SQL Query: <?= htmlspecialchars($sql) ?></p>
            <div class="nav-links">
               <a href="Form.php" class="btn btn-primary">Try Again</a>
            </div>
         <?php endif; ?>
      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php $conn->close(); ?>