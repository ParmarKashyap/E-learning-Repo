<?php
// Include main database configuration
require_once("config.php");

// Create alias so old files using $conn will still work
$conn = $pdo;
?>

<?php

$host = "localhost";
$db   = "elearning";
$user = "root";
$pass = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}
?>