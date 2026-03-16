<?php
session_start();

require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/db.php");

checkRole('teacher');

/* ===============================
   FETCH NOTICES
=================================*/
$stmt = $pdo->prepare("
    SELECT * FROM notices 
    WHERE (target_role = 'teacher' OR target_role = 'both')
    AND is_active = 1
    AND (expiry_date IS NULL OR expiry_date >= CURDATE())
    ORDER BY 
        CASE WHEN priority = 'important' THEN 0 ELSE 1 END,
        created_at DESC
");
$stmt->execute();
$notices = $stmt->fetchAll();

/* ===============================
   FETCH COURSES
=================================*/
$stmt = $pdo->prepare("
    SELECT * FROM courses
    WHERE teacher_id = :tid
    ORDER BY created_at DESC
");
$stmt->execute([
    ':tid' => $_SESSION['user_id']
]);
$courses = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>

<title>Teacher Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* Font and Base Styles */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: #f0f9fa; /* Light teal tint background */
    display: flex;
}

/* Sidebar Styling */
.sidebar {
    width: 260px; /* Slightly wider for better spacing */
    height: 100vh;
    background: linear-gradient(180deg, #00bcd4 0%, #36b9cc 100%);
    color: white;
    padding-top: 20px;
    position: fixed;
    box-shadow: 4px 0 10px rgba(0,0,0,0.1);
}

.sidebar h4 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 600;
    letter-spacing: 1px;
}

.sidebar a {
    display: block;
    color: white;
    text-decoration: none;
    padding: 14px 25px;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.sidebar a:hover {
    background: rgba(255, 255, 255, 0.2);
    padding-left: 35px; /* Smooth slide effect */
}

/* Main Content Area */
.main {
    margin-left: 260px;
    width: calc(100% - 260px);
}

/* Topbar Styling */
.topbar {
    background: white;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.topbar h5 {
    color: #444;
    font-weight: 500;
    margin: 0;
}

/* Content Container */
.content {
    padding: 35px;
}

/* Notice Bar - Updated to a softer style */
.notice-bar {
    background: #fff3cd;
    border-left: 5px solid #ffc107;
    padding: 15px;
    border-radius: 8px;
    color: #856404;
    font-weight: 500;
    margin-bottom: 30px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

/* Cards Design */
.card-box {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    margin-bottom: 20px;
    transition: transform 0.3s ease;
    border: 1px solid #eef2f3;
}

.card-box:hover {
    transform: translateY(-5px);
}

.card-box h5 {
    color: #00bcd4; /* Brand Teal */
    font-weight: 600;
    margin-bottom: 12px;
}

.card-box p {
    color: #666;
    font-size: 0.9rem;
    line-height: 1.5;
}

.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}

/* Button Customization */
.btn-primary {
    background-color: #00bcd4 !important;
    border-color: #00bcd4 !important;
    border-radius: 20px;
    padding: 6px 20px;
}

.btn-primary:hover {
    background-color: #00acc1 !important;
}

.btn-success {
    background-color: #36b9cc !important;
    border-color: #36b9cc !important;
    border-radius: 20px;
}

hr {
    margin: 40px 0;
    opacity: 0.1;
}

</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4>🎓 Teacher Panel</h4>
    <a href="#"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="upload_material.php"><i class="fas fa-upload me-2"></i> Upload Material</a>
    <a href="manage_materials.php"><i class="fas fa-book me-2"></i> My Materials</a>
    <a href="upload_video.php"><i class="fas fa-video me-2"></i> Course Videos</a>
    <a href="analytics.php"><i class="fas fa-chart-line me-2"></i> Analytics</a>
    <a href="add_course.php"><i class="fas fa-plus-circle me-2"></i> Add Course</a>
</div>


<div class="main">

<!-- Topbar -->

<div class="topbar">

<h5>Welcome, <?= $_SESSION['name']; ?> 👋</h5>

<a href="../auth/logout.php" class="btn btn-danger btn-sm">Logout</a>

</div>


<div class="content">

<!-- Notice -->

<?php if(count($notices) > 0): ?>

<div class="notice-bar">

<?php foreach($notices as $notice): ?>

📢 <?= htmlspecialchars($notice['title']); ?> |

<?php endforeach; ?>

</div>

<?php endif; ?>


<!-- Quick Actions -->

<h4 class="mb-3">Quick Actions</h4>

<div class="cards">

<div class="card-box">

<h5>Upload Study Material</h5>

<p>Add PDFs, Notes or Videos for students.</p>

<a href="upload_material.php" class="btn btn-primary btn-sm">
Upload
</a>

</div>

<div class="card-box">

<h5>Manage Materials</h5>

<p>View and manage your uploaded materials.</p>

<a href="manage_materials.php" class="btn btn-success btn-sm">
View
</a>

</div>

</div>


<hr>


<!-- Courses -->

<h4 class="mb-3">📚 My Assigned Courses</h4>

<?php if(count($courses) > 0): ?>

<div class="cards">

<?php foreach($courses as $course): ?>

<div class="card-box">

<h5><?= htmlspecialchars($course['title']); ?></h5>

<p>
<?= substr(htmlspecialchars($course['description']),0,120); ?>...
</p>

<a href="course_details.php?id=<?= $course['id']; ?>" class="btn btn-primary btn-sm">
View Course
</a>

</div>

<?php endforeach; ?>

</div>

<?php else: ?>

<p>No courses assigned yet.</p>

<?php endif; ?>


</div>

</div>

</body>
</html>