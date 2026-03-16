<?php
require_once("../config/db.php");

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM notices WHERE id = :id");
$stmt->execute([':id'=>$id]);

header("Location: manage_notices.php");
exit;
?>