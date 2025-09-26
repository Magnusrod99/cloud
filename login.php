


<?php
session_start();
require_once "db.php";
require_once "sidebar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Fetch user by email
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $hashedPassword);
        $stmt->fetch();
        if (password_verify($password, $hashedPassword)) {
            // Login successful
            $_SESSION["user_id"] = $id;
            $_SESSION["user_name"] = $name;
            header("Location: home.php"); // Redirect to home page
            exit;
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Email not registered!";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - CampusVoice</title>
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
.error {
    color: red;
    margin-bottom: 10px;
    text-align: center;
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
<div class="col-lg-5 col-md-7">
<div class="card">
<div class="card-header">
<h3>🔑 Student Login</h3>
<p>Access your CampusVoice account</p>
</div>
<div class="card-body p-4">
<?php if(isset($error)) { echo "<div class='error'>$error</div>"; } ?>
<form method="POST">
<div class="mb-3">
<label class="form-label">College Email Address</label>
<input type="email" class="form-control" name="email" placeholder="Email" required>
</div>
<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" class="form-control" name="password" placeholder="Password" required>
</div>
<button type="submit" class="btn btn-custom w-100 text-white">Login</button>
</form>
<div class="text-center mt-3">
<small>Don't have an account? <a href="register.php">Register here</a></small>
</div>
</div>
</div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
