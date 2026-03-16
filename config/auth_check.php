<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}
?>