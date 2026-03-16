<?php
session_start();
require '../config/config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: /elearning/auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT courses.*
        FROM courses
        JOIN enrollments
        ON courses.id = enrollments.course_id
        WHERE enrollments.user_id = :user_id";

$stmt = $pdo->prepare($sql);
$stmt->execute([':user_id' => $user_id]);

$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>My Courses</h2>

<?php foreach($courses as $course): ?>

<div style="border:1px solid green; padding:15px; margin:10px; width:300px;">
    <h3><?php echo htmlspecialchars($course['title']); ?></h3>
    <p><?php echo htmlspecialchars($course['description']); ?></p>
    <a href="course_view.php?course_id=<?php echo $course['id']; ?>">
        View Course
    </a>
</div>

<?php endforeach; ?>