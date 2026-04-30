<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "sparklewash");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $email = $_POST["email"];
    $message = $_POST["message"];

$query = "INSERT INTO messages (title, email, message) VALUES ('$title', '$email', '$message')";
mysqli_query($conn, $query);

echo "Thank you, $title! Your message has been received.";
}
exit();
?>