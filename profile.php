<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit();
}

$user_id = (int) $_SESSION['user_id'];

$conn = mysqli_connect("localhost", "root", "", "sparklewash");
mysqli_set_charset($conn, "utf8mb4");

$result = mysqli_query($conn, "SELECT full_name, email, phone FROM users WHERE id = $user_id LIMIT 1");
$user   = $result ? mysqli_fetch_assoc($result) : [];

$count_result  = mysqli_query($conn, "SELECT COUNT(*) as total FROM bookings WHERE user_id = $user_id");
$booking_count = $count_result ? (int) mysqli_fetch_assoc($count_result)['total'] : 0;

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile — Sparkle Wash</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <a class="brand" href="places.php">Car Wash Booking</a>
        <div class="nav-links">
            <a href="places.php">Places</a>
            <a href="mybooking.php">My Bookings</a>
            <a href="about.html">About</a>
            <a href="contact.html">Contact</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php">Log out</a>
        </div>
    </nav>

    <main class="page-shell">
        <header class="page-header">
            <h1>My Profile</h1>
        </header>

        <div class="profile-card">
            <div class="profile-cover"></div>

            <div class="profile-avatar">👤</div>

            <div class="profile-info">
                <h2><?= htmlspecialchars($user['full_name'] ?? 'Your Name') ?></h2>
                <p><?= htmlspecialchars($user['email'] ?? '') ?></p>
            </div>

            <div class="profile-stats">
                <div class="profile-stat">
                    <strong><?= $booking_count ?></strong>
                    <span>Total Bookings</span>
                </div>
            </div>

            <div class="profile-fields">
                <div class="profile-row">
                    <span class="profile-label">Full Name</span>
                    <span class="profile-value"><?= htmlspecialchars($user['full_name'] ?? '—') ?></span>
                </div>
                <div class="profile-row">
                    <span class="profile-label">Email</span>
                    <span class="profile-value"><?= htmlspecialchars($user['email'] ?? '—') ?></span>
                </div>
                <div class="profile-row">
                    <span class="profile-label">Phone</span>
                    <span class="profile-value"><?= htmlspecialchars($user['phone'] ?: '—') ?></span>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
