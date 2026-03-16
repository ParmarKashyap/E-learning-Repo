<?php
session_start();
require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/config.php");

checkRole('admin');

/* =========================
   FETCH COUNTS
========================= */

$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalTeachers = $pdo->query("SELECT COUNT(*) FROM users WHERE role='teacher'")->fetchColumn();
$totalStudents = $pdo->query("SELECT COUNT(*) FROM users WHERE role='student'")->fetchColumn();
$totalAssignments = $pdo->query("SELECT COUNT(*) FROM assignments")->fetchColumn();
$totalSubmissions = $pdo->query("SELECT COUNT(*) FROM submissions")->fetchColumn();

$submissionRate = 0;
if($totalAssignments > 0 && $totalStudents > 0){
    $possible = $totalAssignments * $totalStudents;
    $submissionRate = ($totalSubmissions / $possible) * 100;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Analytics</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<h2 class="mb-4">System Analytics</h2>

<div class="row">

<div class="col-md-4 mb-4">
<div class="card p-3 shadow-sm">
<h5>Total Users</h5>
<h3><?php echo $totalUsers; ?></h3>
</div>
</div>

<div class="col-md-4 mb-4">
<div class="card p-3 shadow-sm">
<h5>Total Teachers</h5>
<h3><?php echo $totalTeachers; ?></h3>
</div>
</div>

<div class="col-md-4 mb-4">
<div class="card p-3 shadow-sm">
<h5>Total Students</h5>
<h3><?php echo $totalStudents; ?></h3>
</div>
</div>

<div class="col-md-4 mb-4">
<div class="card p-3 shadow-sm">
<h5>Total Assignments</h5>
<h3><?php echo $totalAssignments; ?></h3>
</div>
</div>

<div class="col-md-4 mb-4">
<div class="card p-3 shadow-sm">
<h5>Total Submissions</h5>
<h3><?php echo $totalSubmissions; ?></h3>
</div>
</div>

<div class="col-md-4 mb-4">
<div class="card p-3 shadow-sm">
<h5>Submission Rate</h5>
<h3><?php echo round($submissionRate,2); ?>%</h3>
</div>
</div>

</div>

<a href="dashboard.php" class="btn btn-secondary">Back</a>

</div>

</body>
</html>