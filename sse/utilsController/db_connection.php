<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "main_parking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
    "<a href='install.php'>If first time running click here to install database</a>";
}
?>