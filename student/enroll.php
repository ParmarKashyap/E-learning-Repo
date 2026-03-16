<?php
session_start();
require '../config/config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: /elearning/auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$course_id = $_POST['course_id'];

$sql = "INSERT INTO enrollments (user_id, course_id)
        VALUES (:user_id, :course_id)";

$stmt = $pdo->prepare($sql);

try{
    $stmt->execute([
        ':user_id' => $user_id,
        ':course_id' => $course_id
    ]);
    header("Location: my_courses.php");
    exit();
}
catch(PDOException $e){
    header("Location: my_courses.php");
    exit();
}