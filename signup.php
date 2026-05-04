<?php
session_start();
require_once __DIR__ . '/db.php';
$conn = db_connect();

$name     = $_POST["name"];
$email    = $_POST["email"];
$password = $_POST["password"];

$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($check) > 0) {
    echo "<div style='color:white; background:red; padding:10px; border-radius:5px; width:fit-content;'>
Email already registered. (Back for signup again)
</div>";
    exit();
}

$query = "INSERT INTO users (full_name, email, password) VALUES ('$name', '$email', '$password')";
mysqli_query($conn, $query);

$_SESSION["email"] = $email;
$_SESSION["user_id"] = mysqli_insert_id($conn);
$_SESSION["user_name"] = $name;
header("Location: places.php");
exit();
?>