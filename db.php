<?php
function db_connect()
{
    $conn = mysqli_connect("localhost", "root", "", "sparklewash");
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($conn, "utf8mb4");
    return $conn;
}
