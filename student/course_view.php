<?php
session_start();
require '../config/config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: /elearning/auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(!isset($_GET['course_id'])){
    die("Invalid Course");
}

$course_id = $_GET['course_id'];


// ✅ Check if user enrolled
$checkEnroll = $pdo->prepare("SELECT * FROM enrollments 
                              WHERE user_id = :user_id 
                              AND course_id = :course_id");

$checkEnroll->execute([
    ':user_id' => $user_id,
    ':course_id' => $course_id
]);

if($checkEnroll->rowCount() == 0){
    die("Access Denied! You are not enrolled in this course.");
}


// ✅ Fetch Course Details
$courseStmt = $pdo->prepare("SELECT * FROM courses WHERE id = :course_id");
$courseStmt->execute([':course_id' => $course_id]);
$course = $courseStmt->fetch(PDO::FETCH_ASSOC);


// ✅ Fetch Lessons
$lessonStmt = $pdo->prepare("SELECT * FROM lessons WHERE course_id = :course_id");
$lessonStmt->execute([':course_id' => $course_id]);
$lessons = $lessonStmt->fetchAll(PDO::FETCH_ASSOC);


// ✅ Fetch Completed Lessons
$progressStmt = $pdo->prepare("SELECT lesson_id FROM progress WHERE user_id = :user_id");
$progressStmt->execute([':user_id' => $user_id]);
$completedLessons = $progressStmt->fetchAll(PDO::FETCH_COLUMN);

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($course['title']); ?></title>
</head>
<body>

<h2><?php echo htmlspecialchars($course['title']); ?></h2>
<p><?php echo htmlspecialchars($course['description']); ?></p>

<hr>

<h3>Lessons</h3>

<?php if(empty($lessons)): ?>
    <p>No lessons added yet.</p>
<?php endif; ?>

<?php foreach($lessons as $lesson): ?>

<div style="border:1px solid #ccc; padding:15px; margin:15px 0;">

    <h4><?php echo htmlspecialchars($lesson['title']); ?></h4>

    <video width="600" controls>
        <source src="../uploads/videos/<?php echo $lesson['video']; ?>" type="video/mp4">
        Your browser does not support video.
    </video>

    <br><br>

    <?php if(in_array($lesson['id'], $completedLessons)): ?>
        <p style="color:green; font-weight:bold;">✔ Completed</p>
    <?php else: ?>
        <form method="POST" action="mark_complete.php">
            <input type="hidden" name="lesson_id" value="<?php echo $lesson['id']; ?>">
            <button type="submit">Mark Complete</button>
        </form>
    <?php endif; ?>

</div>

<?php endforeach; ?>

<br>
<a href="my_courses.php">← Back to My Courses</a>

</body>
</html>