<?php
session_start();
require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/db.php");

checkRole('student');

$student_id = $_SESSION['user_id'];

/* =========================
   FETCH MATERIALS
========================= */
$stmt = $pdo->query("SELECT * FROM materials ORDER BY id DESC");
$materials = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* =========================
   FETCH ASSIGNMENTS
========================= */
$stmt = $pdo->query("SELECT * FROM assignments ORDER BY id DESC");
$assignments = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* =========================
   FETCH SUBMISSIONS
========================= */
$stmt = $pdo->prepare("SELECT assignment_id FROM submissions WHERE student_id = :sid");
$stmt->execute([':sid'=>$student_id]);
$submittedAssignments = $stmt->fetchAll(PDO::FETCH_COLUMN);

/* =========================
   FETCH NOTICES (NEW PART)
========================= */
$current_role = $_SESSION['role'];

$stmt = $pdo->prepare("
    SELECT title, message 
    FROM notices 
    WHERE target_role = :role 
    OR target_role = 'both'
    ORDER BY created_at DESC
");

$stmt->execute([':role' => $current_role]);
$notices = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ===============================
   FETCH COURSE VIDEOS
=================================*/

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
<title>Student Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

body {
    display: flex;
    min-height: 100vh;
    background: #f0f9fa; /* Light teal tint */
    font-family: 'Poppins', sans-serif;
    margin: 0;
}

/* Sidebar Styling - Matching Teacher Panel */
.sidebar {
    width: 260px;
    background: linear-gradient(180deg, #00bcd4 0%, #36b9cc 100%);
    color: #fff;
    padding: 25px 20px;
    display: flex;
    flex-direction: column;
    position: fixed;
    height: 100vh;
    box-shadow: 4px 0 10px rgba(0,0,0,0.1);
}

.sidebar h2 {
    margin-bottom: 35px;
    font-size: 22px;
    text-align: center;
    font-weight: 600;
}

.sidebar a {
    color: #fff;
    text-decoration: none;
    padding: 12px 15px;
    margin: 4px 0;
    border-radius: 12px;
    transition: 0.3s;
    font-size: 15px;
}

.sidebar a:hover {
    background: rgba(255, 255, 255, 0.2);
    padding-left: 25px;
}

/* Main Section */
.main {
    flex: 1;
    margin-left: 260px;
    display: flex;
    flex-direction: column;
}

/* Topbar */
.topbar {
    background: #fff;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.logout {
    background: #ff4757;
    color: #fff;
    padding: 8px 18px;
    border-radius: 25px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    transition: 0.3s;
}

.logout:hover {
    background: #e84118;
    color: white;
}

/* Notice Bar */
.notice-bar {
    background: #00bcd4;
    color: white;
    padding: 10px;
    font-size: 14px;
}

/* Content */
.content {
    padding: 35px;
}

.card-custom {
    border-radius: 20px;
    padding: 25px;
    background: #fff;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    transition: 0.3s;
    border: 1px solid #eef2f3;
    height: 100%;
}

.card-custom:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0, 188, 212, 0.1);
}

.card-custom h5 {
    color: #333;
    font-weight: 600;
    margin-bottom: 10px;
}

.btn-primary {
    background-color: #00bcd4 !important;
    border: none !important;
    border-radius: 20px;
}

.btn-success {
    background-color: #1cc88a !important;
    border: none !important;
    border-radius: 20px;
}

/* Video Grid */
.video-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.video-card {
    background: white;
    padding: 15px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.video-card video {
    border-radius: 10px;
    margin-top: 10px;
}
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
<h2>🎓 Student Panel</h2>

<a href="#">🏠 Dashboard</a>
<a href="#materials">📚 Study Materials</a>
<a href="#assignments">📝 Assignments</a>
<a href="course_videos.php">🎥 Course Videos</a>

</div>

<!-- Main Section -->
<div class="main">

<!-- Topbar -->
<div class="topbar">
<div>
<h5>Welcome, <?php echo $_SESSION['name']; ?> 👋</h5>
</div>

<div>
<?php echo $_SESSION['email'] ?? ''; ?>
<a href="../auth/logout.php" class="logout">Logout</a>
</div>
</div>

<!-- ================= NOTICE MARQUEE ================= -->
<?php if(!empty($notices)): ?>
<div class="notice-bar">
    <marquee behavior="scroll" direction="left">
        <?php foreach($notices as $row): ?>
            📢 <?php echo htmlspecialchars($row['title']); ?> 
            - <?php echo htmlspecialchars($row['message']); ?> 
            &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
        <?php endforeach; ?>
    </marquee>
</div>
<?php endif; ?>

<!-- Content -->
<div class="content">

<!-- ================= MATERIALS ================= -->
<h3 id="materials">📚 Study Materials</h3>
<div class="row mt-3">

<?php foreach($materials as $m): ?>
<div class="col-md-4 mb-4">
<div class="card-custom">
<h5><?php echo htmlspecialchars($m['title']); ?></h5>
<p>Uploaded by Teacher</p>
<a href="../uploads/materials/<?php echo $m['file_name']; ?>" 
   class="btn btn-primary btn-sm" target="_blank">
Download
</a>
</div>
</div>
<?php endforeach; ?>

</div>

<!-- ================= Course Videos ================= -->

<h4 class="mt-4 mb-3">🎥 Course Videos</h4>

<?php if(count($videos) > 0): ?>

<div class="cards">

<?php foreach($videos as $video): ?>

<div class="card">

<h6><?= htmlspecialchars($video['course_title']); ?></h6>

<p><?= htmlspecialchars($video['title']); ?></p>

<video width="100%" controls>
<source src="../uploads/videos/<?= $video['video_file']; ?>">
</video>

</div>

<?php endforeach; ?>

</div>

<?php else: ?>

<p>No videos available yet.</p>

<?php endif; ?>

<!-- ================= ASSIGNMENTS ================= -->

<hr class="my-5">
<h3 id="assignments">📝 Assignments</h3>
<div class="row mt-3">

<?php foreach($assignments as $a): ?>
<div class="col-md-4 mb-4">
<div class="card-custom">

<h5><?php echo htmlspecialchars($a['title']); ?></h5>
<p>Due Date: <?php echo $a['due_date']; ?></p>

<?php if(in_array($a['id'], $submittedAssignments)): ?>
<span class="badge bg-success">Submitted</span>
<?php else: ?>
<a href="submit_assignment.php?id=<?php echo $a['id']; ?>" 
   class="btn btn-success btn-sm">
Submit
</a>
<?php endif; ?>

</div>
</div>
<?php endforeach; ?>

</div>

</div>
</div>

</body>
</html>