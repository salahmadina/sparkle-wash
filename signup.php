<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "sparklewash");
mysqli_set_charset($conn, "utf8mb4");

$name     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$phone    = trim($_POST['phone'] ?? '');

$check = mysqli_query($conn, "SELECT id FROM users WHERE email = '" . mysqli_real_escape_string($conn, $email) . "'");
if (mysqli_num_rows($check) > 0) {
    echo "<div style='color:white;background:red;padding:10px;border-radius:5px;'>Email already registered. <a href='index.html' style='color:#fff;'>Go back</a></div>";
    exit();
}

$stmt = mysqli_prepare($conn, "INSERT INTO users (full_name, email, password, phone) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $password, $phone);
mysqli_stmt_execute($stmt);

$new_id = mysqli_insert_id($conn);
mysqli_stmt_close($stmt);
mysqli_close($conn);

$_SESSION['user_id']   = $new_id;
$_SESSION['user_name'] = $name;
$_SESSION['email']     = $email;

header("Location: places.php");
exit();
