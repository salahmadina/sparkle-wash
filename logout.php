<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to profile page or home page
header('Location: profile.php?message=logged_out');
exit;
?>