<?php
session_start();
require_once "db.php";
require_once "sidebar.php";

// Redirect if not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

// Fetch user details
$stmt = $conn->prepare("SELECT name, rollno, class, department, phone, email, created_at FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile - CampusVoice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f4f7fa;
    }
    .profile-card {
      margin-left: 220px;
      margin-top: 40px;
      max-width: 700px;
      border-radius: 15px;
      box-shadow: 0px 4px 20px rgba(0,0,0,0.1);
    }
    .profile-header {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: white;
      border-radius: 15px 15px 0 0;
      padding: 25px;
      text-align: center;
    }
    .profile-header h3 {
      margin: 0;
    }
    .profile-body {
      padding: 30px;
    }
    .profile-item {
      margin-bottom: 15px;
    }
    .label {
      font-weight: 600;
      color: #333;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="card profile-card">
    <div class="profile-header">
      <h3><?php echo htmlspecialchars($user['name']); ?></h3>
      <p><?php echo htmlspecialchars($user['email']); ?></p>
    </div>
    <div class="profile-body">
      <div class="profile-item"><span class="label">Roll No:</span> <?php echo htmlspecialchars($user['rollno']); ?></div>
      <div class="profile-item"><span class="label">Class:</span> <?php echo htmlspecialchars($user['class']); ?></div>
      <div class="profile-item"><span class="label">Department:</span> <?php echo htmlspecialchars($user['department']); ?></div>
      <div class="profile-item"><span class="label">Phone:</span> <?php echo htmlspecialchars($user['phone']); ?></div>
      <div class="profile-item"><span class="label">Member Since:</span> <?php echo date("F j, Y", strtotime($user['created_at'])); ?></div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
