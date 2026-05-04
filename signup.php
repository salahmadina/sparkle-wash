<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "sparklewash");

$name     = $_POST["name"];
$email    = $_POST["email"];
$password = $_POST["password"];

$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($check) > 0) {
echo "<div style='color:white; background:red; padding:10px; border-radius:5px; width:fit-content;'>
Email already registered. (Back for signup again)
</div>"; exit();
}

$query = "INSERT INTO users (full_name, email, password) VALUES ('$name', '$email', '$password')";
mysqli_query($conn, $query);

$_SESSION["email"] = $email;
header("Location: index.html");
exit();
?>