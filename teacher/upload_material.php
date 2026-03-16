<?php
include("../config/auth_check.php");
include("../config/role_check.php");
checkRole('teacher');
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload Material</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="card p-4 shadow">

<h4>Upload Material</h4>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="title" class="form-control mb-2" placeholder="Title" required>

<textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>

<input type="file" name="file" class="form-control mb-2" required>

<button name="upload" class="btn btn-success">Upload</button>
<a href="dashboard.php" class="btn btn-secondary">Back</a>

</form>

</div>
</div>

</body>
</html>

<?php
if(isset($_POST['upload'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $file = $_FILES['file'];

    $fileName = time() . "_" . $file['name'];
    $tmp = $file['tmp_name'];

    move_uploaded_file($tmp, "../uploads/materials/" . $fileName);

    $stmt = $pdo->prepare("INSERT INTO materials (teacher_id,title,description,file_name)
                            VALUES (:tid,:title,:desc,:file)");

    $stmt->execute([
        ':tid'=>$_SESSION['user_id'],
        ':title'=>$title,
        ':desc'=>$description,
        ':file'=>$fileName
    ]);

    echo "<script>alert('Uploaded Successfully');</script>";
}
?>