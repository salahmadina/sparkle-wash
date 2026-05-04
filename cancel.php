<?php
session_start();

if (isset($_GET['id']) && isset($_SESSION['bookings'])) {
    $id = (int) $_GET['id'];
    if (isset($_SESSION['bookings'][$id])) {
        // Remove the booking
        unset($_SESSION['bookings'][$id]);
        // Reindex the array
        $_SESSION['bookings'] = array_values($_SESSION['bookings']);
    }
}

// Redirect back to mybooking.php
header('Location: mybooking.php');
exit;
?>