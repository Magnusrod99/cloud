<?php
// Azure MySQL connection details
$host = "collegecomplaints-db.mysql.database.azure.com";  // Replace with your actual server name
$username = "admin@collegecomplaints-db";                 // Replace with your actual admin username
$password = "YourStrongPasswordHere";                     // Replace with your actual password
$database = "campusvoice";                                // Replace with your DB name

// Initialize connection with SSL (required by Azure MySQL)
$conn = mysqli_init();
mysqli_real_connect(
    $conn,
    $host,
    $username,
    $password,
    $database,
    3306,
    NULL,
    MYSQLI_CLIENT_SSL
);

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // echo "✅ Connected successfully to Azure MySQL!"; // Uncomment for debugging
}
?>
