<?php
require_once "db.php";
session_start();
require_once "sidebar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  href="index.php"> <title>CampusVoice: Complaint & Feedback Portal</title>

  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      overflow-x: hidden;
      background: url('download.jpeg') ;
      background-size: cover;
      
    }
    /* Sidebar styles */
    #sidebar {
      min-width: 200px;
      max-width: 200px;
      background: #2c3e50;
      color: #fff;
      min-height: 100vh;
      position: fixed;
    }
    #sidebar .nav-link {
      color: #fff;
    }
    #sidebar .nav-link:hover {
      background: #1abc9c;
      color: #fff;
    }
    /* Main content */
    #content {
      margin-left: 200px;
      padding: 20px;
    }
    @media (max-width: 768px) {
      #sidebar {
        position: relative;
        min-height: auto;
      }
      #content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div id="sidebar" class="d-flex flex-column p-3">
    <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <span class="fs-4 fw-bold">CampusVoice</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="#hero" class="nav-link text-white">Home</a>
      </li>
       <li>
        <a href="login.php" class="nav-link text-white">Login</a>
      </li> 
      <li>
        <a href="register.php" class="nav-link text-white">Register</a>
      </li>
      <li>
        <a href="complain.php" class="nav-link text-white">Submit Complaint</a>
      </li>
      <li>
        <a href="profile.php" class="nav-link text-white">Profile</a>
      </li>
    </ul>
  </div>

  <!-- Main Content -->
  <div id="content">

    <!-- Hero Section -->
    <section id="hero" class="bg-primary text-white text-center py-5 rounded">
      <div class="container">
        <h1 class="display-4 fw-bold">Your Voice Matters</h1>
        <p class="lead">Report problems, give feedback & help improve our campus. Transparent resolution, real tracking!</p>
        <a href="complaints.php" class="btn btn-light btn-lg mt-3">Start Now</a>
      </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
      <div class="container">
        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <div class="card h-100 text-center shadow-sm">
              <div class="card-body">
                <h5 class="card-title text-primary">Easy Submission</h5>
                <p class="card-text">Quickly log complaints on academics, hostel, or facilities.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card h-100 text-center shadow-sm">
              <div class="card-body">
                <h5 class="card-title text-primary">Status Tracking</h5>
                <p class="card-text">Stay updated on complaint status and admin responses.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card h-100 text-center shadow-sm">
              <div class="card-body">
                <h5 class="card-title text-primary">Secure & Private</h5>
                <p class="card-text">Your identity is protected. Submit complaints without fear.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card h-100 text-center shadow-sm">
              <div class="card-body">
                <h5 class="card-title text-primary">Feedback Driven</h5>
                <p class="card-text">Help improve the campus with suggestions and feedback.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5 rounded">
      <div class="container">
        &copy; 2025 CampusVoice. All Rights Reserved.
      </div>
    </footer>

  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
