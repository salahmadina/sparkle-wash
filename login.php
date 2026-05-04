<?php
session_start();
require_once __DIR__ . '/db.php';
$conn = db_connect();

$email    = $_POST["email"];
$password = $_POST["password"];

$query  = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION["email"] = $email;
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["user_name"] = $user["full_name"];
    header("Location: places.php");
    exit();
} else {
    echo "<div style='background:#ffdddd; color:#a94442; padding:10px; border-radius:5px; margin-top:10px;'>
Invalid email or password (Back for login page again)
</div>";
}
?>