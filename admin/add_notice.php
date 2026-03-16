<?php
// ================= DATABASE CONNECTION =================
$host = "localhost";
$dbname = "elearning";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}

// ================= CREATE UPLOAD FOLDER IF NOT EXISTS =================
$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// ================= INSERT NOTICE =================
$success = "";
$error = "";

if(isset($_POST['publish'])){

    $attachmentName = null;

    // ===== FILE UPLOAD =====
    if(isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0){

        $allowedTypes = ['jpg','jpeg','png','gif','pdf','doc','docx'];
        $fileName = $_FILES['attachment']['name'];
        $fileTmp = $_FILES['attachment']['tmp_name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if(in_array($fileExt, $allowedTypes)){

            $newFileName = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $fileName);
            move_uploaded_file($fileTmp, $uploadDir . $newFileName);
            $attachmentName = $newFileName;

        } else {
            $error = "Invalid file type!";
        }
    }

    if(empty($error)){
        $stmt = $pdo->prepare("
            INSERT INTO notices 
            (title, message, target_role, priority, expiry_date, attachment)
            VALUES (:title, :message, :target_role, :priority, :expiry_date, :attachment)
        ");

        $stmt->execute([
            ':title' => $_POST['title'],
            ':message' => $_POST['message'],
            ':target_role' => $_POST['target_role'],
            ':priority' => $_POST['priority'],
            ':expiry_date' => !empty($_POST['expiry_date']) ? $_POST['expiry_date'] : null,
            ':attachment' => $attachmentName
        ]);

        $success = "Notice Published Successfully 🎉";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Notice</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg,#1abc9c,#16a085);
    min-height:100vh;
}

.card{
    border-radius:15px;
}

.form-control, .form-select{
    border-radius:10px;
}

.btn-success{
    border-radius:10px;
    padding:8px 25px;
}
</style>

</head>
<body>

<div class="container mt-5">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-white">
            <h4 class="mb-0">📢 Add New Notice</h4>
        </div>

        <div class="card-body">

            <?php if($success): ?>
                <div class="alert alert-success">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <?php if($error): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Notice Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea name="message" rows="4" class="form-control" required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Display To</label>
                        <select name="target_role" class="form-select" required>
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                            <option value="both">Both</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Priority</label>
                        <select name="priority" class="form-select">
                            <option value="normal">Normal</option>
                            <option value="important">Important</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Expiry Date</label>
                        <input type="date" name="expiry_date" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Image / File</label>
                    <input type="file" name="attachment" class="form-control">
                    <small class="text-muted">
                        Allowed: JPG, PNG, GIF, PDF, DOC, DOCX
                    </small>
                </div>

                <div class="text-end">
                    <a href="dashboard.php" class="btn btn-secondary">Back</a>
                    <button type="submit" name="publish" class="btn btn-success">
                        Publish Notice
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>