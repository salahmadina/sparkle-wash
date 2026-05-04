<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = 'Demo Customer';
}

$user_id  = (int) $_SESSION['user_id'];
$place_id = isset($_POST['place_id']) ? (int) $_POST['place_id'] : 0;
$service  = trim($_POST['service_type'] ?? '');
$slot     = trim($_POST['time_slot'] ?? '');
$date     = trim($_POST['booking_date'] ?? '');

$services = [
    'basic'   => ['Basic Wash',   50],
    'premium' => ['Premium Wash', 100],
    'full'    => ['Full Service', 150],
];

if ($place_id <= 0 || $slot === '' || $date === '' || !isset($services[$service])) {
    header('Location: booking.php?place_id=' . $place_id . '&error=1');
    exit();
}

[$service_name, $price] = $services[$service];
$booking_date = date('Y-m-d', strtotime($date));

$conn = mysqli_connect("localhost", "root", "", "sparklewash");
mysqli_set_charset($conn, "utf8mb4");

$result = mysqli_query($conn, "SELECT name, location FROM places WHERE id = $place_id LIMIT 1");
$place  = $result ? mysqli_fetch_assoc($result) : null;

if (!$place) {
    mysqli_close($conn);
    header('Location: places.php');
    exit();
}

$stmt = mysqli_prepare($conn,
    'INSERT INTO bookings (user_id, place_id, place_name, place_location, service_type, service_name, price, time_slot, booking_date, payment_method, payment_status, status)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
);

$payment_method = 'place';
$payment_status = 'pay at place';
$status         = 'confirmed';

mysqli_stmt_bind_param($stmt, 'iisssdsissss',
    $user_id, $place_id, $place['name'], $place['location'],
    $service, $service_name, $price, $slot, $booking_date,
    $payment_method, $payment_status, $status
);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);

header('Location: mybooking.php');
exit();
