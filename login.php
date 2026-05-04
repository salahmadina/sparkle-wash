<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "sparklewash");

$email    = $_POST["email"];
$password = $_POST["password"];

$query  = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $_SESSION["email"] = $email;
    header("Location: contact.html");
    exit();
} else {
echo "<div style='background:#ffdddd; color:#a94442; padding:10px; border-radius:5px; margin-top:10px;'>
Invalid email or password (Back for login page again)
</div>";}
?>