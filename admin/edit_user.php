<?php
include("../config/auth_check.php");
include("../config/role_check.php");
checkRole('admin');

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute([':id'=>$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['update'])){

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $role = $_POST['role'];

    $update = $conn->prepare("UPDATE users 
                              SET name=:name, mobile=:mobile, role=:role 
                              WHERE id=:id");

    $update->execute([
        ':name'=>$name,
        ':mobile'=>$mobile,
        ':role'=>$role,
        ':id'=>$id
    ]);

    header("Location: manage_users.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-4">

<h4>Edit User</h4>

<form method="POST">

<input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control mb-2">

<input type="text" name="mobile" value="<?php echo $user['mobile']; ?>" class="form-control mb-2">

<select name="role" class="form-control mb-2">
<option value="student" <?php if($user['role']=='student') echo 'selected'; ?>>Student</option>
<option value="teacher" <?php if($user['role']=='teacher') echo 'selected'; ?>>Teacher</option>
<option value="admin" <?php if($user['role']=='admin') echo 'selected'; ?>>Admin</option>
</select>

<button name="update" class="btn btn-success">Update</button>

</form>

</div>
</body>
</html>