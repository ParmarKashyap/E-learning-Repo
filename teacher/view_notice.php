<?php
session_start();
require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/db.php");

checkRole('teacher');

if(!isset($_GET['id'])){
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("
    SELECT * FROM notices 
    WHERE id = :id
    AND (target_role = 'teacher' OR target_role = 'both')
    AND is_active = 1
");
$stmt->execute(['id'=>$id]);
$notice = $stmt->fetch();

if(!$notice){
    echo "Notice not found.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title><?= htmlspecialchars($notice['title']); ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">

<div class="container bg-white p-4 rounded shadow">

    <?php if($notice['priority'] == 'important'): ?>
        <span class="badge bg-danger mb-2">IMPORTANT</span>
    <?php endif; ?>

    <h2><?= htmlspecialchars($notice['title']); ?></h2>
    <p class="text-muted">
        Posted on: <?= $notice['created_at']; ?>
    </p>
    <hr>

    <p><?= nl2br(htmlspecialchars($notice['message'])); ?></p>

    <?php if(!empty($notice['attachment'])): ?>
        <hr>
        <a href="../uploads/notices/<?= $notice['attachment']; ?>" 
           target="_blank" 
           class="btn btn-primary">
           View Attachment
        </a>
    <?php endif; ?>

    <br><br>
    <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>

</div>

</body>
</html>     