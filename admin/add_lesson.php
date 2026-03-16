<?php
session_start();
require '../config/config.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: /elearning/auth/login.php");
    exit();
}

$courses = $pdo->query("SELECT * FROM courses")->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $course_id = $_POST['course_id'];
    $title = $_POST['title'];

    $videoName = $_FILES['video']['name'];
    $tempName = $_FILES['video']['tmp_name'];
    $folder = "../uploads/videos/" . $videoName;

    move_uploaded_file($tempName, $folder);

    $sql = "INSERT INTO lessons (course_id, title, video)
            VALUES (:course_id, :title, :video)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':course_id' => $course_id,
        ':title' => $title,
        ':video' => $videoName
    ]);

    echo "Lesson Added Successfully!";
}
?>

<h2>Add Lesson</h2>

<form method="POST" enctype="multipart/form-data">

<select name="course_id" required>
    <option value="">Select Course</option>
    <?php foreach($courses as $course): ?>
        <option value="<?php echo $course['id']; ?>">
            <?php echo $course['title']; ?>
        </option>
    <?php endforeach; ?>
</select>
<br><br>

<input type="text" name="title" placeholder="Lesson Title" required>
<br><br>

<input type="file" name="video" required>
<br><br>

<button type="submit">Add Lesson</button>

</form>