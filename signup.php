<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "sparklewash");
$name     = $_POST["name"];
$email    = $_POST["email"];
$password = $_POST["password"];
$query = "INSERT INTO users (full_name, email, password) VALUES ('$name', '$email', '$password')";
mysqli_query($conn, $query);
$_SESSION["email"] = $email;
header("Location: index.html");
exit();
?>