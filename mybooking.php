<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = 'Demo Customer';
}

$user_id = (int) $_SESSION['user_id'];

$conn = mysqli_connect("localhost", "root", "", "sparklewash");
mysqli_set_charset($conn, "utf8mb4");

$bookings = [];
$result   = mysqli_query($conn, "SELECT * FROM bookings WHERE user_id = $user_id ORDER BY created_at DESC");
while ($row = mysqli_fetch_assoc($result)) {
    $bookings[] = $row;
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    
    <title>My Bookings</title>
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
        </div>
    </nav>

    <main class="page-shell">
        <header class="page-header">
            <h1>My Bookings</h1>
        </header>

        <?php if (empty($bookings)): ?>
            <section class="empty-state">
                <h2>No bookings yet</h2>
                <p>Choose a place, pick your service, date, and time, then confirm.</p>
                <a class="btn btn-book" href="places.php">Choose Place</a>
            </section>
        <?php else: ?>
            <?php foreach ($bookings as $b): ?>
                <section class="summary-box booking-result">
                    <dl>
                        <div><dt>Place</dt><dd><?= htmlspecialchars($b['place_name']) ?></dd></div>
                        <div><dt>Location</dt><dd><?= htmlspecialchars($b['place_location']) ?></dd></div>
                        <div><dt>Service</dt><dd><?= htmlspecialchars($b['service_name']) ?></dd></div>
                        <div><dt>Price</dt><dd><?= htmlspecialchars($b['price']) ?> EGP</dd></div>
                        <div><dt>Date</dt><dd><?= htmlspecialchars($b['booking_date']) ?></dd></div>
                        <div><dt>Time</dt><dd><?= htmlspecialchars($b['time_slot']) ?></dd></div>
                        <div><dt>Status</dt><dd><?= htmlspecialchars($b['status']) ?></dd></div>
                        <div><dt>Payment</dt><dd>Pay at the place</dd></div>
                    </dl>
                </section>
            <?php endforeach; ?>
            <a class="btn btn-book" href="places.php">Book Another</a>
        <?php endif; ?>
    </main>
</body>
</html>
