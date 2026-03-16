<?php
include("../config/auth_check.php");
include("../config/role_check.php");
checkRole('teacher');
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Materials</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

<h4>My Materials</h4>

<table class="table table-bordered">

<tr>
<th>Title</th>
<th>Description</th>
<th>Action</th>
</tr>

<?php
$stmt = $pdo->prepare("SELECT * FROM materials WHERE teacher_id = :id");
$stmt->execute([':id'=>$_SESSION['user_id']]);

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>

<tr>
<td><?php echo $row['title']; ?></td>
<td><?php echo $row['description']; ?></td>
<td>
<a href="delete_material.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
</td>
</tr>
    
<?php } ?>

</table>

</button><a href="/elearning/teacher/dashboard.php" class="btn btn-secondary">Back</a></button>


</div>

</body>
</html>