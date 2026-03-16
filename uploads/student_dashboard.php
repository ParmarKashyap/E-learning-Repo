<?php

session_start();

require '../config/config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM courses");
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Available Courses</h2>

<?php foreach($courses as $course): ?>

<div style="border:1px solid #ccc; padding:15px; margin:10px; width:300px;">
    <img src="uploads/<?php echo $course['image']; ?>" width="100%">
    <h3><?php echo htmlspecialchars($course['title']); ?></h3>
    <p><?php echo htmlspecialchars($course['description']); ?></p>

    <form method="POST" action="enroll.php">
        <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
        <button type="submit">Enroll Now</button>
    </form>
</div>

<?php endforeach; ?>