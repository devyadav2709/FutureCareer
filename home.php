<?php include 'header.php'; ?>
<html>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Future Career Prediction</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="style.css" />

  <style>
    .hero {
      padding: 120px 30px 60px 30px;
      background: url('stars-background.png') repeat;
      background-size: cover;
      position: relative;
      min-height: auto !important;
      height: auto !important;
      overflow: hidden;
    }


    .rocket {
      width: 80px;
      animation: flyUp 1s ease-in-out infinite alternate;
      margin-bottom: 20px;
    }

    @keyframes flyUp {
      0% {
        transform: translateY(-10);
      }

      100% {
        transform: translateY(-20px);
      }
    }

    h1 {
      font-size: 48px;
      margin-bottom: 10px;
    }

    h2 {
      font-size: 24px;
      color: #a0c4ff;
      margin-bottom: 60px;
    }

    .buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    .btn {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid #ffffff22;
      color: white;
      padding: 15px 25px;
      border-radius: 12px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s, transform 0.3s;
    }

    .btn:hover {
      background: #3d5afe;
      transform: scale(1.1);
      box-shadow: 0 0 20px #3d5afeaa, 0 0 40px #3d5afe44;
      animation: pulse 1s infinite;
    }

    @keyframes pulse {
      0% {
        transform: scale(1.08);
      }

      50% {
        transform: scale(1.12);
      }

      100% {
        transform: scale(1.08);
      }
    }
  </style>
</head>

<body>
  <div class="hero font-weight-bolder">
    <img src="Images/rocket.png" alt="Rocket" class="rocket" style="height: 430px; width: 350px" />
    <h1><b>Future Career</b></h1>
    <h2 style="margin-top: 5px;"><b>Prediction</b></h2>
    <div class="buttons">
      <a href="#predictions" class="btn">Predicted Future Career</a>
      <a href="Forms/Form.php" class="btn">Career Form</a>
      <a href="Forms/ViewAllRecommendations.php" class="btn">View All Recommendations</a>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>

</html>