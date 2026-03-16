<?php
session_start();

require_once("../config/auth_check.php");
require_once("../config/role_check.php");
include("../config/db.php");

checkRole('admin');

$name = $_SESSION['name'];
$email = $_SESSION['user_email'] ?? "admin@email.com";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* Font and Base Styles */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    display:flex;
    min-height:100vh;
    background: #f0f9fa; /* Light teal background to match the platform */
}

/* Sidebar - Matching Teacher & Student panels */
.sidebar{
    width:260px;
    background: linear-gradient(180deg, #00bcd4 0%, #36b9cc 100%);
    color:#fff;
    padding:25px 20px;
    display:flex;
    flex-direction:column;
    position: fixed;
    height: 100vh;
    box-shadow: 4px 0 15px rgba(0,0,0,0.1);
    z-index: 1000;
}

.sidebar h2{
    margin-bottom:35px;
    font-size:22px;
    text-align: center;
    font-weight: 600;
    letter-spacing: 1px;
}

.sidebar a{
    color:#fff;
    text-decoration:none;
    margin:5px 0;
    padding:12px 15px;
    border-radius:12px;
    transition:0.3s;
    display:flex;
    align-items:center;
    gap:12px;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.2);
    padding-left: 25px;
}

/* Main Section */
.main{
    flex:1;
    margin-left: 260px; /* Offset for the fixed sidebar */
    display:flex;
    flex-direction:column;
}

/* Topbar */
.topbar{
    background:#fff;
    padding:15px 30px;
    display:flex;
    justify-content:flex-end;
    align-items:center;
    box-shadow:0 2px 15px rgba(0,0,0,0.05);
}

.profile{
    display:flex;
    align-items:center;
    gap:15px;
}

.profile-info{
    text-align: right;
}

.profile-info strong{
    display: block;
    color:#333;
    font-size: 14px;
}

.profile-info span{
    font-size:11px;
    color:#888;
}

.logout{
    background:#ff4757;
    color:#fff;
    padding:7px 18px;
    border-radius:25px;
    text-decoration:none;
    font-size:13px;
    font-weight: 500;
    transition:0.3s;
}

.logout:hover{
    background:#e84118;
    transform: scale(1.05);
}

/* Content Area */
.content{
    padding:40px;
}

.content h2{
    color: #333;
    margin-bottom:30px;
    font-weight: 600;
}

/* Admin Cards */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    gap:25px;
}

.card{
    background:#fff;
    padding:35px 25px;
    border-radius:20px;
    text-align:center;
    transition:0.4s;
    border: 1px solid #eef2f3;
    box-shadow: 0 10px 25px rgba(0,0,0,0.03);
}

.card:hover{
    transform:translateY(-10px);
    box-shadow: 0 15px 35px rgba(0, 188, 212, 0.15);
}

.card i{
    font-size:40px;
    margin-bottom:15px;
    color: #00bcd4; /* Brand Teal */
}

.card h4{
    margin-bottom:10px;
    color:#2c3e50;
    font-weight: 600;
}

.card p{
    font-size:13px;
    color:#7f8c8d;
    line-height: 1.4;
}

/* Responsive Fix */
@media(max-width:992px){
    .sidebar { width: 80px; padding: 20px 10px; }
    .sidebar h2, .sidebar a span { display: none; }
    .main { margin-left: 80px; }
    .sidebar a { justify-content: center; }
}
</style>
</head>
<body>

<div class="sidebar">
<h2>🎓 Admin Panel</h2>

<a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a>
<a href="manage_users.php"><i class="fa fa-users"></i> Manage Users</a>
<a href="../add_course.php"><i class="fa fa-book"></i> Manage Courses</a>
<a href="analytics.php"><i class="fa fa-chart-line"></i> Analytics</a>
<a href="manage_notices.php"><i class="fa fa-bullhorn"></i> Manage Notices</a>
<a href="settings.php"><i class="fa fa-gear"></i> Settings</a>
</div>

<div class="main">

<div class="topbar">
<div class="profile">
<div class="profile-info">
<strong><?php echo htmlspecialchars($name); ?></strong>
<span><?php echo htmlspecialchars($email); ?></span>
</div>
<a href="../auth/logout.php" class="logout">Logout</a>
</div>
</div>

<div class="content">

<h2 style="margin-bottom:20px;">Welcome Back, <?php echo htmlspecialchars($name); ?> 👋</h2>

<div class="cards">

<a href="manage_users.php" style="text-decoration:none;">
<div class="card">
<i class="fa fa-users"></i>
<h4>Manage Users</h4>
<p>Control all students & teachers</p>
</div>
</a>

<a href="../add_course.php" style="text-decoration:none;">
<div class="card">
<i class="fa fa-book"></i>
<h4>Manage Courses</h4>
<p>Create and manage course content</p>
</div>
</a>

<a href="analytics.php" style="text-decoration:none;">
<div class="card">
<i class="fa fa-chart-line"></i>
<h4>Analytics</h4>
<p>Track system performance</p>
</div>
</a>

<a href="manage_notices.php" style="text-decoration:none;">
<div class="card">
<i class="fa fa-bullhorn"></i>
<h4>Manage Notices</h4>
<p>Create, edit and control system notices</p>
</div>
</a>

<a href="settings.php" style="text-decoration:none;">
<div class="card">
<i class="fa fa-gear"></i>
<h4>Settings</h4>
<p>System configuration options</p>
</div>
</a>

</div>
</div>
</div>

</body>
</html>