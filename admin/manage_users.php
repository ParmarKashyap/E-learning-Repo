<?php
session_start();

require_once("../config/auth_check.php");
require_once("../config/role_check.php");
require_once("../config/config.php");

checkRole('admin');

/* =========================
   DELETE USER (SECURE)
========================= */
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    // Prevent admin deleting himself
    if($id == $_SESSION['user_id']){
        header("Location: manage_users.php");
        exit();
    }

    // Check role before deleting
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if($userData){

        // Do NOT allow deleting admin
        if($userData['role'] != 'admin'){

            $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute([':id' => $id]);

        }
    }

    header("Location: manage_users.php");
    exit();
}

/* =========================
   FETCH USERS
========================= */
$stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Users</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<h2 class="mb-4">Manage Users</h2>

<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php foreach($users as $user): ?>

<tr>
<td><?php echo $user['id']; ?></td>
<td><?php echo htmlspecialchars($user['name']); ?></td>
<td><?php echo htmlspecialchars($user['email']); ?></td>

<td>
<?php if($user['role'] == 'admin'): ?>
    <span class="badge bg-danger">Admin</span>

<?php elseif($user['role'] == 'teacher'): ?>
    <span class="badge bg-success">Teacher</span>

<?php else: ?>
    <span class="badge bg-primary">Student</span>
<?php endif; ?>
</td>

<td>
<?php if($user['role'] != 'admin'): ?>
    <a href="?delete=<?php echo $user['id']; ?>" 
       class="btn btn-sm btn-danger"
       onclick="return confirm('Are you sure you want to delete this user?');">
       Delete
    </a>
<?php else: ?>
    <span class="text-muted">Protected</span>
<?php endif; ?>
</td>

</tr>

<?php endforeach; ?>

</tbody>
</table>

<a href="dashboard.php" class="btn btn-secondary">Back</a>

</div>

</body>
</html>