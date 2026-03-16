<?php
session_start();

require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/db.php");

checkRole('teacher');

$tid = $_SESSION['user_id'];

/* ===============================
   TOTAL COURSES
=================================*/
$stmt = $pdo->prepare("
SELECT COUNT(*) FROM courses
WHERE teacher_id=?
");
$stmt->execute([$tid]);
$total_courses = $stmt->fetchColumn();

/* ===============================
   TOTAL MATERIALS
=================================*/
$stmt = $pdo->prepare("
SELECT COUNT(*) FROM study_materials
WHERE uploaded_by=?
");
$stmt->execute([$tid]);
$total_materials = $stmt->fetchColumn();

/* ===============================
   TOTAL ASSIGNMENTS
=================================*/
$stmt = $pdo->prepare("
SELECT COUNT(*) FROM assignments
WHERE teacher_id=?
");
$stmt->execute([$tid]);
$total_assignments = $stmt->fetchColumn();

/* ===============================
   TOTAL STUDENT SUBMISSIONS
=================================*/
$stmt = $pdo->prepare("
SELECT COUNT(*) 
FROM submissions s
JOIN assignments a ON s.assignment_id=a.id
WHERE a.teacher_id=?
");
$stmt->execute([$tid]);
$total_submissions = $stmt->fetchColumn();

?>

<!DOCTYPE html>
<html>

<head>

<title>Teacher Analytics</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

.card{
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

</style>

</head>

<body class="p-4">

<h2>Teacher Analytics Dashboard</h2>

<div class="row mt-4">

<div class="col-md-3">
<div class="card p-3 text-center">
<h3><?= $total_courses ?></h3>
<p>Total Courses</p>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 text-center">
<h3><?= $total_materials ?></h3>
<p>Study Materials</p>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 text-center">
<h3><?= $total_assignments ?></h3>
<p>Assignments</p>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 text-center">
<h3><?= $total_submissions ?></h3>
<p>Student Submissions</p>
</div>
</div>

</div>

</body>
</html>