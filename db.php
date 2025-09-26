<?php
$conn = new mysqli("localhost", "root", "", "campusvoice");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
