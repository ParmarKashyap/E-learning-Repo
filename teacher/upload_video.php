<?php
session_start();

require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/db.php");

checkRole('teacher');

/* ===============================
   FETCH COURSES
=================================*/
$stmt = $pdo->prepare("
SELECT id,title FROM courses
WHERE teacher_id = :tid
");

$stmt->execute([
':tid' => $_SESSION['user_id']
]);

$courses = $stmt->fetchAll();               

/* ===============================
   HANDLE VIDEO UPLOAD
=================================*/
$msg="";

if(isset($_POST['upload'])){

$course_id = $_POST['course_id'];
$title = $_POST['title'];

$video = $_FILES['video']['name'];
$tmp = $_FILES['video']['tmp_name'];

$folder = "../uploads/videos/".$video;

move_uploaded_file($tmp,$folder);

$stmt = $pdo->prepare("
INSERT INTO course_videos
(course_id,title,video_file,uploaded_by)
VALUES (?,?,?,?)
");

$stmt->execute([
$course_id,
$title,
$video,
$_SESSION['user_id']
]);

$msg="Video Uploaded Successfully";
}

/* ===============================
   FETCH VIDEOS
=================================*/

$stmt = $pdo->prepare("
SELECT cv.*,c.title as course_title
FROM course_videos cv
JOIN courses c ON cv.course_id=c.id
WHERE uploaded_by=?
ORDER BY cv.id DESC
");

$stmt->execute([$_SESSION['user_id']]);

$videos = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>

<head>

<title>Upload Course Video</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="p-4">

<h3>Upload Course Video</h3>

<?php if($msg){ ?>
<div class="alert alert-success"><?= $msg ?></div>
<?php } ?>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>Course</label>

<select name="course_id" class="form-control" required>

<?php if(count($courses) > 0): ?>

<?php foreach($courses as $c){ ?>

<option value="<?= $c['id'] ?>">
<?= $c['title'] ?>
</option>

<?php } ?>

<?php else: ?>

<option>No courses found</option>

<?php endif; ?>

</select>

</div>

<div class="mb-3">
<label>Video Title</label>
<input type="text" name="title" class="form-control" required>
</div>

<div class="mb-3">
<label>Upload Video</label>
<input type="file" name="video" class="form-control" accept="video/*" required>
</div>

<button class="btn btn-primary" name="upload">
Upload Video
</button>

</form>

<hr>

<h4>Uploaded Videos</h4>

<table class="table">

<tr>
<th>Course</th>
<th>Title</th>
<th>Video</th>
</tr>

<?php foreach($videos as $v){ ?>

<tr>

<td><?= $v['course_title'] ?></td>

<td><?= $v['title'] ?></td>

<td>
<video width="220" controls>
<source src="../uploads/videos/<?= $v['video_file'] ?>">
</video>
</td>

</tr>

<?php } ?>

</table>

</body>
</html>