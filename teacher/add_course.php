<?php
session_start();

require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/db.php");

checkRole('teacher');

$msg="";

if(isset($_POST['add'])){

$title = $_POST['title'];
$desc = $_POST['description'];

$stmt = $pdo->prepare("
INSERT INTO courses
(title,description,teacher_id,status)
VALUES (:title,:desc,:tid,'active')
");

$stmt->execute([
':title'=>$title,
':desc'=>$desc,
':tid'=>$_SESSION['user_id']
]);

$msg="Course Created Successfully";

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Add Course</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="p-4">

<h3>Create Course</h3>

<?php if($msg){ ?>
<div class="alert alert-success"><?= $msg ?></div>
<?php } ?>

<form method="POST">

<div class="mb-3">
<label>Course Title</label>
<input type="text" name="title" class="form-control" required>
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" class="form-control" required></textarea>
</div>

<button class="btn btn-primary" name="add">
Create Course
</button>

</form>

</body>
</html> 