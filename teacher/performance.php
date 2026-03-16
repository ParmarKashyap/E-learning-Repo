<?php
session_start();
require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/db.php");

checkRole('teacher');

$teacher_id = $_SESSION['user_id'];

/* ==============================
   TOTAL ASSIGNMENTS
============================== */
$stmt = $pdo->prepare("SELECT COUNT(*) FROM assignments WHERE teacher_id = :tid");
$stmt->execute([':tid'=>$teacher_id]);
$totalAssignments = $stmt->fetchColumn();

/* ==============================
   TOTAL SUBMISSIONS
============================== */
$stmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM submissions s
    JOIN assignments a ON s.assignment_id = a.id
    WHERE a.teacher_id = :tid
");
$stmt->execute([':tid'=>$teacher_id]);
$totalSubmissions = $stmt->fetchColumn();

/* ==============================
   AVERAGE MARKS
============================== */
$stmt = $pdo->prepare("
    SELECT AVG(s.marks)
    FROM submissions s
    JOIN assignments a ON s.assignment_id = a.id
    WHERE a.teacher_id = :tid AND s.marks IS NOT NULL
");
$stmt->execute([':tid'=>$teacher_id]);
$averageMarks = round($stmt->fetchColumn(),2);
?>

<!DOCTYPE html>
<html>
<head>
<title>Performance Analytics</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h2>📊 Performance Overview</h2>

<div class="row mt-4">

<div class="col-md-4">
<div class="card text-center p-4 shadow">
<h4>Total Assignments</h4>
<h2><?php echo $totalAssignments; ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card text-center p-4 shadow">
<h4>Total Submissions</h4>
<h2><?php echo $totalSubmissions; ?></h2>
</div>
</div>

<div class="col-md-4">
<div class="card text-center p-4 shadow">
<h4>Average Marks</h4>
<h2><?php echo $averageMarks ?: 0; ?></h2>
</div>
</div>

</div><br>

<a href="dashboard.php" class="btn btn-secondary">Back</a>

</body>
</html>