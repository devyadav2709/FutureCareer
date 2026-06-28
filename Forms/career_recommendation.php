<?php
include 'db_connect.php';

// Enable error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$filter = $search ? "WHERE domain LIKE '%$search%' OR technical_skill LIKE '%$search%'" : "";

$sql = "SELECT * FROM career_recommendation $filter";
$result = $conn->query($sql);

if (!$result) {
   die("Query failed: " . $conn->error . "<br>SQL: " . $sql);
}
?>
<!DOCTYPE html>
<html>

<head>
   <title>Career Recommendations</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <style>
      body {
         background: #f8f9fa;
         padding: 20px;
      }

      .card {
         margin-bottom: 20px;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .card-header {
         background: #3498db;
         color: white;
      }

      .search-box {
         margin-bottom: 20px;
      }
   </style>
</head>

<body>
   <div class="container">
      <h1 class="mb-4">Career Recommendations</h1>
      <div class="search-box card">
         <div class="card-body">
            <form method="GET" class="row g-3">
               <div class="col-md-8">
                  <input type="text" name="search" class="form-control" placeholder="Search by domain or skill"
                     value="<?= htmlspecialchars($search) ?>">
               </div>
               <div class="col-md-4">
                  <button type="submit" class="btn btn-primary me-2">Search</button>
                  <a href="career_recommendation.php" class="btn btn-secondary">Reset</a>
               </div>
            </form>
         </div>
      </div>
      <?php if ($result->num_rows > 0): ?>
         <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
               <div class="card-header">
                  <h5><?= htmlspecialchars($row['domain']) ?></h5>
               </div>
               <div class="card-body">
                  <p><strong>Field:</strong> <?= htmlspecialchars($row['field']) ?></p>
                  <p><strong>Technical Skill:</strong> <?= htmlspecialchars($row['technical_skill']) ?></p>
                  <div class="accordion" id="accordion<?= $row['id'] ?>">
                     <div class="accordion-item">
                        <h2 class="accordion-header">
                           <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapse<?= $row['id'] ?>">
                              View Details
                           </button>
                        </h2>
                        <div id="collapse<?= $row['id'] ?>" class="accordion-collapse collapse"
                           data-bs-parent="#accordion<?= $row['id'] ?>">
                           <div class="accordion-body">
                              <p><strong>Best Colleges:</strong><br><?= nl2br(htmlspecialchars($row['best_colleges'])) ?></p>
                              <p><strong>Job Roles:</strong><br><?= nl2br(htmlspecialchars($row['job_roles'])) ?></p>
                              <a href="career_display.php?field=<?= urlencode($row['field']) ?>&domain=<?= urlencode($row['domain']) ?>&technical_skill=<?= urlencode($row['technical_skill']) ?>"
                                 class="btn btn-sm btn-primary">
                                 View Full Prediction
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php endwhile; ?>
      <?php else: ?>
         <div class="alert alert-warning">No results found.</div>
         <p>Debug Info: SQL Query: <?= htmlspecialchars($sql) ?></p>
      <?php endif; ?>
      <div class="mt-4">
         <a href="Form.php" class="btn btn-success">Back to Prediction Form</a>
      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php $conn->close(); ?>