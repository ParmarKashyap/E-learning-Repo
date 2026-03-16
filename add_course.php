    <?php
   session_start();
    require 'config/config.php';

    if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
        header("Location: ./auth/login.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $title = $_POST['title'];
        $description = $_POST['description'];

        // Image upload logic
        $imageName = $_FILES['image']['name'];
        $tempName = $_FILES['image']['tmp_name'];
        $folder = "uploads/" . $imageName;

        move_uploaded_file($tempName, $folder);

        $sql = "INSERT INTO courses (title, description, image) 
                VALUES (:title, :description, :image)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':image' => $imageName
        ]);
        echo "Material Added Successfully.";
    }
    ?>
<!DOCTYPE html>
<html>
<head>
<title>Add Course</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:linear-gradient(135deg,#eef2ff,#f8fbff);
font-family:'Poppins',sans-serif;
}

.card{
border-radius:20px;
box-shadow:0 10px 30px rgba(0,0,0,0.08);
border:none;
}

.btn-custom{
background:linear-gradient(45deg,#4e73df,#1cc88a);
border:none;
color:white;
font-weight:500;
}

.btn-custom:hover{
opacity:0.9;
}

.header-title{
font-weight:600;
color:#4e73df;
}
</style>

</head>
<body>

<div class="container mt-5">

<div class="card p-4">

<h3 class="header-title mb-4">📘 Add New Course</h3>


<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label class="form-label">Course Title</label>
<input type="text" name="title" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Course Description</label>
<textarea name="description" class="form-control" rows="4" required></textarea>
</div>

<div class="mb-3">
<label class="form-label">Course Image</label>
<input type="file" name="image" class="form-control" required>
</div>

<button type="submit" class="btn btn-custom">Add Course</button>
<a href="/elearning/admin/dashboard.php" class="btn btn-secondary">Back</a>

</form>

</div>

</div>

</body>
</html>