<?php
session_start();
require '../config/config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: /elearning/auth/login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$lesson_id = $_POST['lesson_id'];

$sql = "INSERT INTO progress (user_id, lesson_id)
        VALUES (:user_id, :lesson_id)";

$stmt = $pdo->prepare($sql);

try{
    $stmt->execute([
        ':user_id' => $user_id,
        ':lesson_id' => $lesson_id
    ]);
} catch(PDOException $e){
    // already completed
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();