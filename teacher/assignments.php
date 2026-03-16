<?php
session_start();
require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/db.php");

checkRole('teacher');

$message = "";

/* =========================
   ADD ASSIGNMENT
========================= */
if(isset($_POST['add_assignment'])){

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $due_date = $_POST['due_date'];
    $fileName = null;

    if(!empty($_FILES['file']['name'])){
        $fileName = time() . "_" . $_FILES['file']['name'];
        move_uploaded_file(
            $_FILES['file']['tmp_name'],
            "../uploads/assignments/" . $fileName
        );
    }

    $sql = "INSERT INTO assignments 
            (teacher_id,title,description,due_date,file_name)
            VALUES (:tid,:title,:desc,:due,:file)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':tid' => $_SESSION['user_id'],
        ':title' => $title,
        ':desc' => $description,
        ':due' => $due_date,
        ':file' => $fileName
    ]);

    $message = "Assignment Created Successfully!";
}

/* =========================
   DELETE ASSIGNMENT
========================= */
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $stmt = $pdo->prepare("DELETE FROM assignments WHERE id = :id AND teacher_id = :tid");
    $stmt->execute([
        ':id'=>$id,
        ':tid'=>$_SESSION['user_id']
    ]);

    header("Location: assignments.php");
    exit();
}

/* =========================
   FETCH ASSIGNMENTS
========================= */
$stmt = $pdo->prepare("SELECT * FROM assignments WHERE teacher_id = :tid ORDER BY id DESC");
$stmt->execute([':tid'=>$_SESSION['user_id']]);
$assignments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html>
<head>
<title>Assignments</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h3>Create Assignment</h3>

<?php if($message): ?>
<div class="alert alert-success"><?php echo $message; ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="mb-4">

<div class="mb-3">
<label>Title</label>
<input type="text" name="title" class="form-control" required>
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" class="form-control" required></textarea>
</div>

<div class="mb-3">
<label>Due Date</label>
<input type="date" name="due_date" class="form-control" required>
</div>

<div class="mb-3">
<label>Upload File (Optional)</label>
<input type="file" name="file" class="form-control">
</div>

<button type="submit" name="add_assignment" class="btn btn-primary">
Create Assignment
</button>
</form>

<hr>

<h3>Your Assignments</h3>

<table class="table table-bordered">
<tr>
<th>Title</th>
<th>Due Date</th>
<th>File</th>
<th>Action</th>
</tr>

<?php foreach($assignments as $row): ?>
<tr>
<td><?php echo $row['title']; ?></td>
<td><?php echo $row['due_date']; ?></td>
<td>
<?php if($row['file_name']): ?>
<a href="../uploads/assignments/<?php echo $row['file_name']; ?>" target="_blank">
Download
</a>
<?php else: ?>
No File
<?php endif; ?>
</td>
<td>
<a href="assignments.php?delete=<?php echo $row['id']; ?>" 
   class="btn btn-danger btn-sm"
   onclick="return confirm('Delete this assignment?')">
Delete
</a>
</td>
</tr>
<?php endforeach; ?>

</table>

<a href="dashboard.php" class="btn btn-secondary">Back</a>

</body>
</html>












