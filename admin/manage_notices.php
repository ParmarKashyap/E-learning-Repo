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
<title>Manage Notices</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
display:flex;
min-height:100vh;
background:linear-gradient(-45deg,#4e73df,#1cc88a,#36b9cc,#f6c23e);
background-size:400% 400%;
animation:gradientBG 12s ease infinite;
}

@keyframes gradientBG{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

/* Sidebar */
.sidebar{
width:240px;
background:rgba(44,62,80,0.95);
color:#fff;
padding:25px 20px;
display:flex;
flex-direction:column;
}

.sidebar h2{
margin-bottom:30px;
font-size:20px;
}

.sidebar a{
color:#fff;
text-decoration:none;
margin:8px 0;
padding:10px 12px;
border-radius:10px;
transition:0.3s;
display:flex;
align-items:center;
gap:10px;
}

.sidebar a:hover{
background:linear-gradient(90deg,#1cc88a,#4e73df);
transform:translateX(5px);
}

/* Main */
.main{
flex:1;
display:flex;
flex-direction:column;
}

/* Topbar */
.topbar{
background:rgba(255,255,255,0.8);
padding:15px 25px;
display:flex;
justify-content:flex-end;
align-items:center;
box-shadow:0 4px 15px rgba(0,0,0,0.1);
}

.profile{
display:flex;
align-items:center;
gap:15px;
}

.profile-info strong{
color:#4e73df;
}

.profile-info span{
font-size:12px;
color:#555;
}

.logout{
background:linear-gradient(45deg,#ff6b6b,#e74a3b);
color:#fff;
padding:6px 14px;
border-radius:20px;
text-decoration:none;
font-size:13px;
}

/* Content */
.content{
padding:30px;
color:#fff;
}

.add-btn{
background:#fff;
color:#333;
padding:8px 15px;
border-radius:8px;
text-decoration:none;
font-size:14px;
font-weight:500;
margin-bottom:20px;
display:inline-block;
transition:0.3s;
}

.add-btn:hover{
transform:scale(1.05);
}

/* Notice Card */
.notice-card{
background:rgba(255,255,255,0.95);
padding:20px;
border-radius:15px;
margin-bottom:15px;
color:#333;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
transition:0.3s;
}

.notice-card:hover{
transform:translateY(-3px);
}

.notice-card h4{
margin-bottom:8px;
}

.notice-card small{
color:#777;
font-size:12px;
}

.actions{
margin-top:10px;
}

.actions a{
text-decoration:none;
margin-right:10px;
font-size:13px;
font-weight:500;
}

.edit{
color:#4e73df;
}

.delete{
color:#e74a3b;
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
<a href="manage_notices.php" style="background:linear-gradient(90deg,#1cc88a,#4e73df);">
<i class="fa fa-bullhorn"></i> Manage Notices
</a>
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

<h2>📢 Manage Notices</h2>

<a href="add_notice.php" class="add-btn">
<i class="fa fa-plus"></i> Add New Notice
</a>

<?php
$result = mysqli_query($pdo, "SELECT * FROM notices ORDER BY created_at DESC");

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
?>
        <div class="notice-card">
            <h4><?php echo htmlspecialchars($row['title']); ?></h4>
            <p><?php echo htmlspecialchars($row['message']); ?></p>
            <small>Published: <?php echo $row['created_at']; ?></small>

            <div class="actions">
                <a href="edit_notice.php?id=<?php echo $row['id']; ?>" class="edit">
                    <i class="fa fa-edit"></i> Edit
                </a>

                <a href="delete_notice.php?id=<?php echo $row['id']; ?>" class="delete" 
                onclick="return confirm('Are you sure to delete this notice?')">
                    <i class="fa fa-trash"></i> Delete
                </a>
            </div>
        </div>
<?php
    }
}else{
    echo "<p>No notices available.</p>";
}
?>

</div>
</div>

</body>
</html>