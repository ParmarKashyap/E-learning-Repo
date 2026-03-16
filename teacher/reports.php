<?php
session_start();
require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/db.php");

checkRole('teacher');

$teacher_id = $_SESSION['user_id'];
$filterAssignment = $_GET['assignment'] ?? '';

/* ==============================
   GET ASSIGNMENTS FOR FILTER
============================== */
$stmt = $pdo->prepare("SELECT id,title FROM assignments WHERE teacher_id = :tid");
$stmt->execute([':tid'=>$teacher_id]);
$assignments = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ==============================
   REPORT QUERY
============================== */
$sql = "
SELECT s.*, a.title, u.name AS student_name
FROM submissions s
JOIN assignments a ON s.assignment_id = a.id
JOIN users u ON s.student_id = u.id
WHERE a.teacher_id = :tid
";

$params = [':tid'=>$teacher_id];

if($filterAssignment){
    $sql .= " AND a.id = :aid";
    $params[':aid'] = $filterAssignment;
}

$sql .= " ORDER BY s.submitted_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Reports</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h2>📈 Reports</h2>

<form method="GET" class="mb-3">
<select name="assignment" class="form-select w-25 d-inline">
<option value="">All Assignments</option>
<?php foreach($assignments as $a): ?>
<option value="<?php echo $a['id']; ?>" 
<?php if($filterAssignment==$a['id']) echo "selected"; ?>>
<?php echo $a['title']; ?>
</option>
<?php endforeach; ?>
</select>

<button class="btn btn-primary">Filter</button>
</form>

<table class="table table-bordered">
<tr>
<th>Assignment</th>
<th>Student</th>
<th>Marks</th>
<th>Submitted At</th>
</tr>

<?php foreach($reports as $row): ?>
<tr>
<td><?php echo $row['title']; ?></td>
<td><?php echo $row['student_name']; ?></td>
<td><?php echo $row['marks'] ?? 'Not Graded'; ?></td>
<td><?php echo $row['submitted_at']; ?></td>
</tr>
<?php endforeach; ?>

</table><br>

<a href="dashboard.php" class="btn btn-secondary" >Back</a>

</body>
</html>