<?php
include("../config/auth_check.php");
include("../config/role_check.php");
checkRole('teacher');

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM materials WHERE id = :id AND teacher_id = :tid");
$stmt->execute([
    ':id'=>$id,
    ':tid'=>$_SESSION['user_id']
]);

header("Location: manage_materials.php");
exit();
?>