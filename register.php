<?php
session_start();
require_once "db.php"; // Include DB connection

require_once "sidebar.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = $conn->real_escape_string($_POST["name"]);
    $rollno     = $conn->real_escape_string($_POST["rollno"]);
    $class      = $conn->real_escape_string($_POST["class"]);
    $department = $conn->real_escape_string($_POST["department"]);
    $phone      = $conn->real_escape_string($_POST["phone"]);
    $email      = $conn->real_escape_string($_POST["email"]);
    $password   = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $conn->query("SELECT id FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $error = "This email is already registered!";
    } else {
        // Insert user into DB
        $sql = "INSERT INTO users (name, rollno, class, department, phone, email, password) 
                VALUES ('$name', '$rollno', '$class', '$department', '$phone', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registration successful! You can now login.'); window.location='login.php';</script>";
            exit;
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - CampusVoice</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .card {
      border-radius: 18px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      animation: fadeIn 0.6s ease-in-out;
    }
    .card-header {
      background: linear-gradient(135deg, #11998e, #38ef7d);
      color: white;
      border-top-left-radius: 18px;
      border-top-right-radius: 18px;
      text-align: center;
      padding: 22px;
    }
    .btn-custom {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      border: none;
      transition: 0.3s;
    }
    .btn-custom:hover {
      background: linear-gradient(135deg, #2575fc, #6a11cb);
      transform: scale(1.05);
    }
    label {
      font-weight: 500;
      color: #444;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="mb-0">🌟 Student Registration</h3>
            <p class="mb-0">Join CampusVoice and make your voice heard</p>
          </div>
          <div class="card-body p-4">
            
            <!-- Show Error -->
            <?php if(!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Full Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Roll Number</label>
                  <input type="text" class="form-control" name="rollno" placeholder="Roll number" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Class</label>
                  <select class="form-select" name="class" required>
                    <option value="">Select</option>
                    <option value="FY">First Year</option>
                    <option value="SY">Second Year</option>
                    <option value="TY">Third Year</option>
                    <option value="Final Year">Final Year</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Department</label>
                  <select class="form-select" name="department" required>
                    <option value="">Select Department</option>
                    <option value="BA">BA</option>
                    <option value="B.Com">B.Com</option>
                    <option value="BBA">BBA</option>
                    <option value="BCA">BCA</option>
                    <option value="B.Sc">B.Sc</option>
                    <option value="M.Com">M.Com</option>
                    <option value="MBA">MBA</option>
                    <option value="M.Sc">M.Sc</option>
                  </select>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phone" placeholder="Phone number" required>
              </div>
              <div class="mb-3">
                <label class="form-label">College Email Address</label>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
              <button type="submit" class="btn btn-custom w-100 text-white">Register</button>
            </form>
            <div class="text-center mt-3">
              <small>Already registered? <a href="login.php">Login here</a></small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
