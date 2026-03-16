<?php
session_start();
require_once("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_id = $_POST['id'];

    // Prevent deleting yourself
    if ($user_id == $_SESSION['user_id']) {
        header("Location: manage_users.php?error=selfdelete");
        exit();
    }

    // Check role of user
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id = :id");
    $stmt->execute([':id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['role'] != 'admin') {

        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute([':id' => $user_id]);

    }

}

header("Location: manage_users.php");
exit();