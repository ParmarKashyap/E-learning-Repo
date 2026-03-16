<?php
session_start();
require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/db.php");

checkRole('student');

$student_id = $_SESSION['user_id'];
$message = "";

/* ==========================
   FETCH ALL ASSIGNMENTS
========================== */
$stmt = $pdo->query("SELECT * FROM assignments ORDER BY id DESC");
$assignments = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ==========================
   SUBMIT ASSIGNMENT
========================== */
if(isset($_POST['submit_assignment'])){

    $assignment_id = $_POST['assignment_id'];

    $uploadDir = "../uploads/submissions/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $cleanName = preg_replace("/[^a-zA-Z0-9.]/", "_", $_FILES['file']['name']);
    $fileName = time() . "_" . $cleanName;

    move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $fileName);

    $sql = "INSERT INTO submissions (assignment_id, student_id, file_name)
            VALUES (:aid,:sid,:file)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':aid'=>$assignment_id,
        ':sid'=>$student_id,
        ':file'=>$fileName
    ]);

    $message = "Assignment Submitted Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Submit Assignment</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h3>Available Assignments</h3>

<?php if($message): ?>
<div class="alert alert-success"><?php echo $message; ?></div>
<?php endif; ?>

<table class="table table-bordered">
<tr>
<th>Title</th>
<th>Due Date</th>
<th>Submit</th>
</tr>

<?php foreach($assignments as $a): ?>
<tr>
<td><?php echo $a['title']; ?></td>
<td><?php echo $a['due_date']; ?></td>
<td>
<form method="POST" enctype="multipart/form-data">
<input type="hidden" name="assignment_id" value="<?php echo $a['id']; ?>">
<input type="file" name="file" required>
<button name="submit_assignment" class="btn btn-primary btn-sm">
Submit
</button>
</form>
</td>
</tr>
<?php endforeach; ?>

</table>

<a href="dashboard.php" class="btn btn-secondary" >Back</a>

</body>
</html>