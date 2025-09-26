<?php
session_start();

// Destroy all session variables
session_unset();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>
