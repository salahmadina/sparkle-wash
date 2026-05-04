<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = 'Demo Customer';
}

$conn = mysqli_connect("localhost", "root", "", "sparklewash");
mysqli_set_charset($conn, "utf8mb4");

$places = [];
$result = mysqli_query($conn, "SELECT * FROM places ORDER BY id");
while ($row = mysqli_fetch_assoc($result)) {
    $places[] = $row;
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Car Wash Places</title>
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
            <p>Welcome, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Customer') ?></p>
            <h1>Available Car Wash Places</h1>
        </header>

        <section class="places-grid">
            <?php foreach ($places as $row): ?>
                <article class="place-card">
                    <img src="<?= htmlspecialchars($row['photo']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="place-photo">
                    <div class="place-card-body">
                        <h2><?= htmlspecialchars($row['name']) ?></h2>
                        <p><?= htmlspecialchars($row['description']) ?></p>
                        <div class="card-actions">
                            <a class="btn btn-book" href="booking.php?place_id=<?= urlencode($row['id']) ?>">Book</a>
                            <a class="btn btn-location" href="https://maps.google.com/?q=<?= urlencode($row['location']) ?>" target="_blank" rel="noopener noreferrer">Location</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
</body>
</html>
