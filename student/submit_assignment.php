<?php
session_start();
require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/db.php");

checkRole('student');

$student_id = $_SESSION['user_id'];

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$assignment_id = $_GET['id'];

/* =========================
   FETCH ASSIGNMENT DETAILS
========================= */
$stmt = $pdo->prepare("SELECT * FROM assignments WHERE id = :id");
$stmt->execute([':id' => $assignment_id]);
$assignment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$assignment) {
    die("Assignment not found.");
}

/* =========================
   HANDLE SUBMISSION
========================= */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!empty($_FILES['submission_file']['name'])) {

        $uploadDir = "../uploads/submissions/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = time() . "_" . basename($_FILES['submission_file']['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['submission_file']['tmp_name'], $targetFile)) {

            $stmt = $pdo->prepare("INSERT INTO submissions 
                (assignment_id, student_id, file_name, submitted_at) 
                VALUES (:aid, :sid, :file, NOW())");

            $stmt->execute([
                ':aid' => $assignment_id,
                ':sid' => $student_id,
                ':file' => $fileName
            ]);

            header("Location: dashboard.php?success=submitted");
            exit();
        } else {
            $error = "File upload failed.";
        }

    } else {
        $error = "Please select a file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Submit Assignment</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
display:flex;
min-height:100vh;
background:#f4f6f9;
font-family:Poppins;
}
.sidebar{
width:240px;
background:#198754;
color:#fff;
padding:25px 20px;
}
.sidebar h2{
margin-bottom:30px;
}
.sidebar a{
color:#fff;
text-decoration:none;
display:block;
padding:10px;
border-radius:10px;
margin-bottom:10px;
}
.sidebar a:hover{
background:rgba(255,255,255,0.2);
}
.main{
flex:1;
display:flex;
flex-direction:column;
}
.topbar{
background:#fff;
padding:15px 25px;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 4px 10px rgba(0,0,0,0.05);
}
.content{
padding:30px;
}
.card-custom{
background:#fff;
padding:25px;
border-radius:15px;
box-shadow:0 8px 20px rgba(0,0,0,0.05);
}
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
<h2>🎓 Student Panel</h2>
<a href="dashboard.php">🏠 Dashboard</a>
<a href="dashboard.php#assignments">📝 Assignments</a>
</div>

<div class="main">

<!-- Topbar -->
<div class="topbar">
<div>
<strong><?php echo $_SESSION['name']; ?></strong>
</div>
<div>
<?php echo $_SESSION['email'] ?? ''; ?>
<a href="../auth/logout.php" class="btn btn-danger btn-sm">Logout</a>
</div>
</div>

<div class="content">

<div class="card-custom">

<h4><?php echo htmlspecialchars($assignment['title']); ?></h4>
<p><strong>Due Date:</strong> <?php echo $assignment['due_date']; ?></p>
<hr>

<?php if(isset($error)): ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label class="form-label">Upload Your Assignment</label>
<input type="file" name="submission_file" class="form-control" required>
</div>

<button type="submit" class="btn btn-success">
Submit Assignment
</button>

</form>

</div>

</div>
</div>

</body>
</html>