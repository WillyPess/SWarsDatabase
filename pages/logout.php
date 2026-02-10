<?php
session_start();

// Remove all session variables
session_unset();

// Destroy the session entirely
session_destroy();

// Redirect to homepage
header("Location: ../index.php");
exit;
?>
