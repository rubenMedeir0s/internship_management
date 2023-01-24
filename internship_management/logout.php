<?php
// Start the session data
session_start();
// Destroy the session cookie
setcookie(session_name(), '', time() - 3600);

// Destroy the session data
session_destroy();
header("Location: index.php");
?>