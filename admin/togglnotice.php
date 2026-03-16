<?php
require_once("../config/db.php");

$id = $_GET['id'];

$stmt = $pdo->prepare("
UPDATE notices 
SET is_active = NOT is_active 
WHERE id = :id
");

$stmt->execute([':id'=>$id]);

header("Location: manage_notices.php");
exit;
?>