<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = 'Demo Customer';
}

$place_id = isset($_GET['place_id']) ? (int) $_GET['place_id'] : 0;
if ($place_id <= 0) {
    header('Location: places.php');
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "sparklewash");
mysqli_set_charset($conn, "utf8mb4");

$result = mysqli_query($conn, "SELECT * FROM places WHERE id = $place_id LIMIT 1");
$place  = $result ? mysqli_fetch_assoc($result) : null;
mysqli_close($conn);

if (!$place) {
    header('Location: places.php');
    exit();
}

$timeSlots = [
    '10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM',  '2:00 PM',  '3:00 PM',
    '4:00 PM',  '5:00 PM',  '6:00 PM',  '7:00 PM',  '8:00 PM',  '9:00 PM',
    '10:00 PM', '11:00 PM'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    
    <title>Book <?= htmlspecialchars($place['name']) ?></title>
    <link rel="stylesheet" href="style.css">
    <script src="main.js" defer></script>
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

    <main class="booking-layout">
        <section class="booking-panel">
            <h1>Choose Your Service</h1>
            <form action="book.php" method="POST" class="booking-form">
                <input type="hidden" name="place_id" value="<?= $place['id'] ?>">

                <fieldset class="service-options">
                    <legend>Service type</legend>
                    <label><input type="radio" name="service_type" value="basic" checked><span>Basic – 50 EGP</span></label>
                    <label><input type="radio" name="service_type" value="premium"><span>Premium – 100 EGP</span></label>
                    <label><input type="radio" name="service_type" value="full"><span>Full Service – 150 EGP</span></label>
                </fieldset>

                <label class="field-label" for="booking_date">Booking date</label>
                <input type="date" id="booking_date" name="booking_date" required>

                <label class="field-label" for="time_slot">Time slot</label>
                <select id="time_slot" name="time_slot" required>
                    <?php foreach ($timeSlots as $slot): ?>
                        <option value="<?= htmlspecialchars($slot) ?>"><?= htmlspecialchars($slot) ?></option>
                    <?php endforeach; ?>
                </select>

                <button class="confirm-button" type="submit">Confirm Booking</button>
            </form>
        </section>

        <aside class="summary-box">
            <img src="<?= htmlspecialchars($place['photo']) ?>" alt="<?= htmlspecialchars($place['name']) ?>" class="summary-photo">
            <h2>Booking Summary</h2>
            <dl>
                <div><dt>Place</dt><dd><?= htmlspecialchars($place['name']) ?></dd></div>
                <div><dt>Location</dt><dd><?= htmlspecialchars($place['location']) ?></dd></div>
                <div><dt>Service</dt><dd><span id="summary-service">Basic Wash</span></dd></div>
                <div><dt>Price</dt><dd><span id="summary-price">50 EGP</span></dd></div>
                <div><dt>Details</dt><dd><span id="summary-details">Exterior wash, windows cleaned, tires rinsed, and full drying.</span></dd></div>
                <div><dt>Date</dt><dd><span id="summary-date"><?= date('Y-m-d') ?></span></dd></div>
                <div><dt>Time</dt><dd><span id="summary-time">10:00 AM</span></dd></div>
                <div><dt>Payment</dt><dd>Pay at the place</dd></div>
            </dl>
        </aside>
    </main>
</body>
</html>
