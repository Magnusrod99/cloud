<?php
$host = "collegecomplaints-db.mysql.database.azure.com"; // Azure server name
$username = "admin@collegecomplaints-db";               // admin username + @server-name
$password = "P#8vR9t!s2QwZ6xL";                         // the strong password you chose
$database = "campusvoice";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
