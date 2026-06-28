<?php
include 'db_connect.php';

// Search functionality
$search = isset($_POST['search']) ? trim($_POST['search']) : '';
$filter = '';
if (!empty($search)) {
   $search = $conn->real_escape_string($search);
   $filter = "WHERE field LIKE '%$search%' 
               OR domain LIKE '%$search%' 
               OR technical_skill LIKE '%$search%'
               OR best_colleges LIKE '%$search%'
               OR job_roles LIKE '%$search%'";
}

// Get all career recommendations
$sql = "SELECT * FROM career_recommendation $filter ORDER BY field, domain";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
   <title>Career Explorer | All Recommendations</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@300;400;500;600;700&display=swap"
      rel="stylesheet">
   <style>
      :root {
         --primary: #4361ee;
         --secondary: #3f37c9;
         --accent: #4895ef;
         --light: #f8f9fa;
         --dark: #0a0a2a;
         --success: #4cc9f0;
         --warning: #f8961e;
         --danger: #f72585;
      }

      body {
         font-family: 'Segoe UI', sans-serif;
         background: radial-gradient(ellipse at center, #0a0a2a 0%, #000010 100%);
         color: white;
      }

      .hero-section {
         background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
         color: white;
         padding: 80px 0;
         margin-bottom: 40px;
         border-radius: 0 0 20px 20px;
         box-shadow: 0 10px 30px rgba(67, 97, 238, 0.3);
         position: relative;
         overflow: hidden;
      }

      .hero-section::before {
         content: '';
         position: absolute;
         top: 0;
         left: 0;
         right: 0;
         bottom: 0;
         background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="rgba(255,255,255,0.05)" d="M0,0 L100,0 L100,100 L0,100 Z" /></svg>');
         background-size: cover;
         opacity: 0.2;
      }

      .search-card {
         background: rgba(30, 30, 60, 0.8);
         border-radius: 16px;
         box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
         padding: 30px;
         margin-top: -60px;
         margin-bottom: 40px;
         z-index: 10;
         position: relative;
         border: 1px solid rgba(255, 255, 255, 0.1);
         transition: all 0.3s ease;
      }

      .search-card:hover {
         box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
      }

      .career-card {
         background: rgba(30, 30, 60, 0.8);
         border-radius: 16px;
         box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
         margin-bottom: 30px;
         overflow: hidden;
         transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
         border: 1px solid rgba(255, 255, 255, 0.1);
         position: relative;
      }

      .career-card::before {
         content: '';
         position: absolute;
         top: 0;
         left: 0;
         width: 5px;
         height: 100%;
         background: linear-gradient(to bottom, var(--primary), var(--accent));
         transition: all 0.3s ease;
      }

      .career-card:hover {
         transform: translateY(-8px);
         box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
         background: rgba(40, 40, 80, 0.9);
      }

      .career-card:hover::before {
         width: 8px;
      }

      .card-header {
         background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
         color: white;
         padding: 25px;
         border-bottom: none;
         position: relative;
         overflow: hidden;
      }

      .card-header::after {
         content: '';
         position: absolute;
         top: -50%;
         right: -50%;
         width: 100%;
         height: 200%;
         background: rgba(255, 255, 255, 0.1);
         transform: rotate(30deg);
         transition: all 0.3s ease;
      }

      .career-card:hover .card-header::after {
         right: 100%;
      }

      .badge-field {
         background: rgba(108, 117, 125, 0.3);
         color: #adb5bd;
         font-weight: 500;
         padding: 6px 12px;
         border-radius: 8px;
      }

      .badge-domain {
         background: rgba(13, 202, 240, 0.3);
         color: #0dcaf0;
         font-weight: 500;
         padding: 6px 12px;
         border-radius: 8px;
      }

      .badge-skill {
         background: rgba(25, 135, 84, 0.3);
         color: #20c997;
         font-weight: 500;
         padding: 6px 12px;
         border-radius: 8px;
      }

      .section-title {
         font-weight: 600;
         color: var(--accent);
         margin-top: 20px;
         margin-bottom: 10px;
         display: flex;
         align-items: center;
         font-size: 1.1rem;
      }

      .section-title i {
         margin-right: 10px;
         font-size: 1.2rem;
      }

      .list-icon {
         color: var(--accent);
         margin-right: 10px;
         font-size: 0.9rem;
      }

      .result-count {
         background: var(--primary);
         color: white;
         padding: 8px 20px;
         border-radius: 30px;
         font-size: 15px;
         display: inline-block;
         margin-bottom: 25px;
         font-weight: 500;
         box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
      }

      .floating-btn {
         position: fixed;
         bottom: 30px;
         right: 30px;
         z-index: 100;
         box-shadow: 0 10px 25px rgba(67, 97, 238, 0.3);
         width: 70px;
         height: 70px;
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 28px;
         transition: all 0.3s ease;
         background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
         color: white;
         border: none;
      }

      .floating-btn:hover {
         transform: scale(1.1) rotate(10deg);
         box-shadow: 0 15px 30px rgba(67, 97, 238, 0.4);
      }

      .empty-state {
         text-align: center;
         padding: 80px 0;
         background: rgba(30, 30, 60, 0.8);
         border-radius: 16px;
         box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
         border: 1px solid rgba(255, 255, 255, 0.1);
      }

      .empty-state i {
         font-size: 80px;
         color: rgba(255, 255, 255, 0.1);
         margin-bottom: 25px;
         opacity: 0.7;
      }

      .empty-state h3 {
         font-weight: 600;
         color: white;
         margin-bottom: 15px;
      }

      .filter-card {
         background: rgba(30, 30, 60, 0.8);
         border-radius: 16px;
         box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
         margin-bottom: 30px;
         border: 1px solid rgba(255, 255, 255, 0.1);
      }

      .filter-card .card-header {
         border-radius: 16px 16px 0 0 !important;
      }

      .form-select,
      .form-control {
         border-radius: 10px !important;
         padding: 10px 15px;
         border: 1px solid rgba(255, 255, 255, 0.1);
         background-color: rgba(0, 0, 0, 0.3);
         color: white;
         transition: all 0.3s ease;
      }

      .form-select:focus,
      .form-control:focus {
         border-color: var(--accent);
         box-shadow: 0 0 0 0.25rem rgba(72, 149, 239, 0.25);
         background-color: rgba(0, 0, 0, 0.4);
         color: white;
      }

      .btn-primary {
         background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
         border: none;
         border-radius: 10px !important;
         padding: 10px 25px;
         font-weight: 500;
         transition: all 0.3s ease;
      }

      .btn-primary:hover {
         transform: translateY(-2px);
         box-shadow: 0 8px 20px rgba(72, 149, 239, 0.3);
      }

      .input-group-text {
         border-radius: 10px 0 0 10px !important;
         background: rgba(0, 0, 0, 0.3);
         border-right: none;
         color: white;
         border: 1px solid rgba(255, 255, 255, 0.1);
      }

      .search-input {
         border-left: none;
         border-radius: 0 10px 10px 0 !important;
         background-color: rgba(0, 0, 0, 0.3);
         color: white;
      }

      .search-input:focus {
         box-shadow: none;
      }

      @keyframes fadeIn {
         from {
            opacity: 0;
            transform: translateY(20px);
         }

         to {
            opacity: 1;
            transform: translateY(0);
         }
      }

      @keyframes float {
         0% {
            transform: translateY(0px);
         }

         50% {
            transform: translateY(-10px);
         }

         100% {
            transform: translateY(0px);
         }
      }

      .animate-card {
         animation: fadeIn 0.6s ease forwards;
         opacity: 0;
      }

      .floating-animation {
         animation: float 4s ease-in-out infinite;
      }

      .pulse-animation {
         animation: pulse 2s infinite;
      }

      @keyframes pulse {
         0% {
            box-shadow: 0 0 0 0 rgba(67, 97, 238, 0.4);
         }

         70% {
            box-shadow: 0 0 0 15px rgba(67, 97, 238, 0);
         }

         100% {
            box-shadow: 0 0 0 0 rgba(67, 97, 238, 0);
         }
      }

      .tag-cloud {
         display: flex;
         flex-wrap: wrap;
         gap: 8px;
         margin-top: 15px;
      }

      .tag {
         background: rgba(72, 149, 239, 0.2);
         color: var(--accent);
         padding: 5px 12px;
         border-radius: 20px;
         font-size: 0.85rem;
         transition: all 0.3s ease;
         cursor: pointer;
      }

      .tag:hover {
         background: var(--accent);
         color: white;
         transform: translateY(-2px);
      }

      .progress-container {
         width: 100%;
         height: 8px;
         background: rgba(255, 255, 255, 0.1);
         border-radius: 4px;
         margin-top: 15px;
         overflow: hidden;
      }

      .progress-bar {
         height: 100%;
         background: linear-gradient(90deg, var(--primary), var(--accent));
         border-radius: 4px;
         transition: width 0.6s ease;
      }

      .popular-label {
         position: absolute;
         top: 15px;
         right: 15px;
         background: var(--danger);
         color: white;
         padding: 3px 10px;
         border-radius: 20px;
         font-size: 0.75rem;
         font-weight: 600;
         z-index: 1;
      }

      .trending-label {
         position: absolute;
         top: 15px;
         right: 15px;
         background: var(--warning);
         color: white;
         padding: 3px 10px;
         border-radius: 20px;
         font-size: 0.75rem;
         font-weight: 600;
         z-index: 1;
      }

      .highlight {
         background-color: rgba(255, 242, 172, 0.3);
         background-image: linear-gradient(to right, rgba(255, 242, 172, 0.3) 0%, rgba(255, 242, 172, 0.3) 10%, rgba(254, 255, 222, 0.3) 50%, rgba(255, 242, 172, 0.3) 90%, rgba(255, 242, 172, 0.3) 100%);
         padding: 2px 4px;
         border-radius: 3px;
         color: white;
      }

      /* Dark theme adjustments */
      .card-body {
         color: rgba(255, 255, 255, 0.8);
      }

      .card-footer {
         background: rgba(30, 30, 60, 0.8) !important;
         color: rgba(255, 255, 255, 0.6);
      }

      .text-muted {
         color: rgba(255, 255, 255, 0.5) !important;
      }
   </style>
</head>

<body>
   <!-- Hero Section -->
   <div class="hero-section text-center animate__animated animate__fadeIn">
      <div class="container">
         <h1 class="display-4 fw-bold"><i class="fas fa-rocket me-3 floating-animation"></i> Career Explorer</h1>
         <p class="lead fs-4">Discover your perfect career path among our curated recommendations</p>
      </div>
   </div>

   <!-- Search Card -->
   <div class="container">
      <div class="search-card animate__animated animate__fadeInUp">
         <form method="POST">
            <div class="input-group">
               <span class="input-group-text"><i class="fas fa-search text-muted"></i></span>
               <input type="text" name="search" class="form-control search-input"
                  placeholder="Search by field, domain, skill, college or job role..."
                  value="<?= htmlspecialchars($search) ?>">
               <button type="submit" class="btn btn-primary px-4">
                  <i class="fas fa-search me-2"></i> Search
               </button>
            </div>
            <div class="tag-cloud mt-3">
               <span class="tag">Engineering</span>
               <span class="tag">Computer Science</span>
               <span class="tag">Medicine</span>
               <span class="tag">Design</span>
               <span class="tag">Business</span>
               <span class="tag">Data Science</span>
            </div>
         </form>
      </div>

      <!-- Results Section -->
      <div class="row">
         <div class="col-md-3">
            <div class="filter-card card mb-4">
               <div class="card-header">
                  <h5 class="mb-0"><i class="fas fa-sliders-h me-2"></i> Filters</h5>
               </div>
               <div class="card-body">
                  <div class="mb-3">
                     <label class="form-label fw-semibold">Field</label>
                     <select class="form-select" id="fieldFilter">
                        <option value="">All Fields</option>
                        <option value="engineering">Engineering</option>
                        <option value="science">Science</option>
                        <option value="commerce">Commerce</option>
                        <option value="medical">Medical</option>
                        <option value="design">Design</option>
                        <option value="education">Education</option>
                        <option value="law">Law</option>
                        <option value="agriculture">Agriculture</option>
                        <option value="hospitality">Hospitality</option>
                        <option value="vocational">Vocational</option>
                        <option value="computer">Computer</option>
                     </select>
                  </div>
                  <div class="mb-3">
                     <label class="form-label fw-semibold">Skill Level</label>
                     <select class="form-select" id="skillFilter">
                        <option value="">All Levels</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                     </select>
                  </div>
                  <div class="progress-container">
                     <div class="progress-bar" style="width: 75%"></div>
                  </div>
                  <small class="text-muted">75% match with your skills</small>
                  <button class="btn btn-primary w-100 mt-3" id="applyFilters">
                     <i class="fas fa-check-circle me-2"></i> Apply Filters
                  </button>
               </div>
            </div>

            <div class="result-count animate__animated animate__fadeIn pulse-animation">
               <i class="fas fa-bullseye me-2"></i> <?= $result->num_rows ?> careers found
            </div>
         </div>

         <div class="col-md-9">
            <?php if ($result->num_rows > 0): ?>
               <div class="row g-4" id="careerContainer">
                  <?php
                  $animationDelay = 0;
                  while ($row = $result->fetch_assoc()):
                     $animationDelay += 0.1;
                     $isPopular = rand(0, 1);
                     $isTrending = rand(0, 1);
                     ?>
                     <div class="col-lg-6 mb-4 animate-card" style="animation-delay: <?= $animationDelay ?>s">
                        <!-- Changed to col-lg-6 for 2 columns -->
                        <div class="career-card card h-100">
                           <?php if ($isPopular): ?>
                              <div class="popular-label">
                                 <i class="fas fa-fire me-1"></i> Popular
                              </div>
                           <?php elseif ($isTrending): ?>
                              <div class="trending-label">
                                 <i class="fas fa-chart-line me-1"></i> Trending
                              </div>
                           <?php endif; ?>
                           <div class="card-header d-flex justify-content-between align-items-center">
                              <div>
                                 <span class="badge badge-field me-2"><?= htmlspecialchars($row['field']) ?></span>
                                 <h5 class="mb-0"><?= htmlspecialchars($row['domain']) ?></h5>
                              </div>
                              <a href="career_display.php?field=<?= urlencode($row['field']) ?>&domain=<?= urlencode($row['domain']) ?>&technical_skill=<?= urlencode($row['technical_skill']) ?>"
                                 class="btn btn-sm btn-light rounded-pill px-3">
                                 Explore <i class="fas fa-arrow-right ms-1"></i>
                              </a>
                           </div>
                           <div class="card-body">
                              <div class="d-flex align-items-center mb-3">
                                 <span class="badge badge-skill me-2">
                                    <i class="fas fa-tools me-1"></i> <?= htmlspecialchars($row['technical_skill']) ?>
                                 </span>
                              </div>

                              <div class="section-title">
                                 <i class="fas fa-graduation-cap"></i> Top Colleges
                              </div>
                              <ul class="mb-3">
                                 <?php
                                 $colleges = explode(',', $row['best_colleges']);
                                 foreach (array_slice($colleges, 0, 3) as $college):
                                    if (!empty(trim($college))):
                                       ?>
                                       <li class="mb-2">
                                          <i class="fas fa-university list-icon"></i>
                                          <?= htmlspecialchars(trim($college)) ?>
                                       </li>
                                       <?php
                                    endif;
                                 endforeach;
                                 ?>
                                 <?php if (count($colleges) > 3): ?>
                                    <li class="text-muted">
                                       <i class="fas fa-plus-circle list-icon"></i>
                                       <?= count($colleges) - 3 ?> more colleges
                                    </li>
                                 <?php endif; ?>
                              </ul>

                              <div class="section-title">
                                 <i class="fas fa-briefcase"></i> Job Roles
                              </div>
                              <ul>
                                 <?php
                                 $jobs = explode(',', $row['job_roles']);
                                 foreach (array_slice($jobs, 0, 3) as $job):
                                    if (!empty(trim($job))):
                                       ?>
                                       <li class="mb-2">
                                          <i class="fas fa-user-tie list-icon"></i>
                                          <?= htmlspecialchars(trim($job)) ?>
                                       </li>
                                       <?php
                                    endif;
                                 endforeach;
                                 ?>
                                 <?php if (count($jobs) > 3): ?>
                                    <li class="text-muted">
                                       <i class="fas fa-plus-circle list-icon"></i>
                                       <?= count($jobs) - 3 ?> more roles
                                    </li>
                                 <?php endif; ?>
                              </ul>
                           </div>
                           <div class="card-footer bg-transparent border-top-0 text-end">
                              <small class="text-muted">
                                 <i class="fas fa-clock me-1"></i> Updated <?= rand(1, 30) ?> days ago
                              </small>
                           </div>
                        </div>
                     </div>
                  <?php endwhile; ?>
               </div>
            <?php else: ?>
               <div class="empty-state animate__animated animate__fadeIn">
                  <i class="fas fa-search fa-3x mb-4"></i>
                  <h3 class="fw-bold">No careers found</h3>
                  <p class="text-muted fs-5">Try adjusting your search or filters to find what you're looking for</p>
                  <a href="ViewAllRecommendations.php" class="btn btn-primary mt-3 px-4 py-2">
                     <i class="fas fa-sync-alt me-2"></i> Reset Search
                  </a>
               </div>
            <?php endif; ?>
         </div>
      </div>
   </div>

   <button class="floating-btn animate__animated animate__bounceIn" data-bs-toggle="tooltip" data-bs-placement="left"
      title="Get Personalized Recommendations">
      <i class="fas fa-magic"></i>
   </button>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script>
      // Apply animation to cards
      document.addEventListener('DOMContentLoaded', function () {
         const cards = document.querySelectorAll('.animate-card');
         cards.forEach((card, index) => {
            setTimeout(() => {
               card.style.opacity = '1';
            }, index * 100);
         });

         // Initialize tooltips
         const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
         tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
         });

         // Filter functionality
         document.getElementById('applyFilters').addEventListener('click', function () {
            const fieldFilter = document.getElementById('fieldFilter').value.toLowerCase();
            const skillFilter = document.getElementById('skillFilter').value.toLowerCase();
            const cards = document.querySelectorAll('.career-card');
            let visibleCount = 0;

            cards.forEach(card => {
               const field = card.querySelector('.badge-field').textContent.toLowerCase();
               const skill = card.querySelector('.badge-skill').textContent.toLowerCase();

               const fieldMatch = !fieldFilter || field.includes(fieldFilter);
               const skillMatch = !skillFilter || skill.includes(skillFilter);

               if (fieldMatch && skillMatch) {
                  card.closest('.col-lg-6').style.display = 'block';  // Changed to col-lg-6
                  visibleCount++;
               } else {
                  card.closest('.col-lg-6').style.display = 'none';   // Changed to col-lg-6
               }
            });

            // Update result count with animation
            const resultCount = document.querySelector('.result-count');
            resultCount.innerHTML = `<i class="fas fa-bullseye me-2"></i> ${visibleCount} careers found`;
            resultCount.classList.add('animate__animated', 'animate__pulse');
            setTimeout(() => {
               resultCount.classList.remove('animate__animated', 'animate__pulse');
            }, 1000);

            // Show empty state if no results
            if (visibleCount === 0) {
               document.getElementById('careerContainer').innerHTML = `
                  <div class="empty-state animate__animated animate__fadeIn">
                     <i class="fas fa-filter fa-3x mb-4"></i>
                     <h3 class="fw-bold">No matching careers</h3>
                     <p class="text-muted fs-5">Try adjusting your filters to find what you're looking for</p>
                     <button class="btn btn-outline-primary mt-3 px-4 py-2" onclick="resetFilters()">
                        <i class="fas fa-times me-2"></i> Clear Filters
                     </button>
                  </div>
               `;
            }
         });

         // Set filter from URL if present
         const urlParams = new URLSearchParams(window.location.search);
         if (urlParams.has('field')) {
            document.getElementById('fieldFilter').value = urlParams.get('field');
            document.getElementById('applyFilters').click();
         }

         // Tag click functionality
         document.querySelectorAll('.tag').forEach(tag => {
            tag.addEventListener('click', function () {
               const searchText = this.textContent;
               document.querySelector('input[name="search"]').value = searchText;
               document.querySelector('form').submit();
            });
         });
      });

      function resetFilters() {
         document.getElementById('fieldFilter').value = '';
         document.getElementById('skillFilter').value = '';
         document.getElementById('applyFilters').click();
      }

      // Highlight search terms in results
      function highlightSearchTerms() {
         const searchTerm = "<?= addslashes($search) ?>";
         if (searchTerm.trim() === '') return;

         const regex = new RegExp(searchTerm, 'gi');
         const elements = document.querySelectorAll('.career-card h5, .career-card li, .career-card .badge');

         elements.forEach(element => {
            const html = element.innerHTML;
            const highlighted = html.replace(regex, match => `<span class="highlight">${match}</span>`);
            element.innerHTML = highlighted;
         });
      }

      // Run highlight when page loads
      window.onload = highlightSearchTerms;
   </script>
</body>

</html>
<?php $conn->close(); ?>