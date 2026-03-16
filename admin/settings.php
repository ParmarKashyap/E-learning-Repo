<?php
session_start();
require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/config.php");

checkRole('admin');

/* =========================
   CREATE NEW ADMIN
========================= */
if(isset($_POST['create_admin'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $pdo->prepare("SELECT id FROM users WHERE email = :email");
    $check->execute([':email' => $email]);

    if($check->rowCount() > 0){
        $error = "Email already exists.";
    } else {

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) 
                               VALUES (:name, :email, :password, 'admin')");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password
        ]);

        $success = "New admin created successfully.";
    }
}

/* =========================
   UPDATE USERNAME
========================= */
if(isset($_POST['update_username'])){

    $user_id = $_POST['user_id'];
    $new_name = trim($_POST['new_name']);

    $stmt = $pdo->prepare("UPDATE users SET name = :name WHERE id = :id");
    $stmt->execute([
        ':name' => $new_name,
        ':id' => $user_id
    ]);

    $success = "Username updated successfully.";
}

/* =========================
   UPDATE PASSWORD
========================= */
if(isset($_POST['update_password'])){

    $user_id = $_POST['user_id'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
    $stmt->execute([
        ':password' => $new_password,
        ':id' => $user_id
    ]);

    $success = "Password updated successfully.";
}

/* =========================
   FETCH USERS
========================= */
$stmt = $pdo->query("SELECT id, name, email, role FROM users ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Settings</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<h2 class="mb-4">Admin Settings</h2>

<?php if(isset($success)): ?>
<div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<?php if(isset($error)): ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<!-- ================= CREATE NEW ADMIN ================= -->

<div class="card mb-4 p-4">
<h4>Create New Admin</h4>

<form method="POST">
<input type="hidden" name="create_admin" value="1">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" class="btn btn-primary">
Create Admin
</button>
</form>
</div>

<!-- ================= UPDATE USERNAME ================= -->

<div class="card mb-4 p-4">
<h4>Update Username</h4>

<form method="POST">
<input type="hidden" name="update_username" value="1">

<div class="mb-3">
<label>Select User</label>
<select name="user_id" class="form-select" required>
<?php foreach($users as $user): ?>
<option value="<?php echo $user['id']; ?>">
<?php echo $user['name']; ?> (<?php echo $user['role']; ?>)
</option>
<?php endforeach; ?>
</select>
</div>

<div class="mb-3">
<label>New Name</label>
<input type="text" name="new_name" class="form-control" required>
</div>

<button type="submit" class="btn btn-warning">
Update Username
</button>
</form>
</div>

<!-- ================= UPDATE PASSWORD ================= -->

<div class="card mb-4 p-4">
<h4>Update User Password</h4>

<form method="POST">
<input type="hidden" name="update_password" value="1">

<div class="mb-3">
<label>Select User</label>
<select name="user_id" class="form-select" required>
<?php foreach($users as $user): ?>
<option value="<?php echo $user['id']; ?>">
<?php echo $user['name']; ?> (<?php echo $user['role']; ?>)
</option>
<?php endforeach; ?>
</select>
</div>

<div class="mb-3">
<label>New Password</label>
<input type="password" name="new_password" class="form-control" required>
</div>

<button type="submit" class="btn btn-danger">
Update Password
</button>
</form>
</div>

<a href="dashboard.php" class="btn btn-secondary">Back</a>

</div>

</body>
</html>