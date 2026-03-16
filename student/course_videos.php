<?php
session_start();

require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/db.php");

checkRole('student');

$stmt = $pdo->prepare("
SELECT cv.*,c.title as course_title
FROM course_videos cv
JOIN courses c ON cv.course_id = c.id
ORDER BY cv.created_at DESC
");

$stmt->execute();
$videos = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>

<head>

<title>Course Videos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

.card video{
height:150px;
object-fit:cover;
}

</style>

</head>

<body class="p-4">

<h3>🎥 Course Video Lessons</h3>

<div class="row mt-4">

<?php if(count($videos)>0): ?>

<?php foreach($videos as $video): ?>

<div class="col-md-4 mb-4">

<div class="card p-2">

<h6><?= $video['course_title']; ?></h6>

<p><?= $video['title']; ?></p>

<video controls width="100%">
<source src="../uploads/videos/<?= $video['video_file']; ?>">
</video>

</div>

</div>

<?php endforeach; ?>

<?php else: ?>

<p>No videos available.</p>

<?php endif; ?>

</div>

</body>
</html>