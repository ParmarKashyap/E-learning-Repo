<?php
require_once("../config/db.php");

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM notices WHERE id = :id");
$stmt->execute([':id'=>$id]);
$notice = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['update'])){

$stmt = $pdo->prepare("
UPDATE notices 
SET title=:title,
message=:message,
target_role=:target_role,
priority=:priority,
expiry_date=:expiry_date
WHERE id=:id
");

$stmt->execute([
':title'=>$_POST['title'],
':message'=>$_POST['message'],
':target_role'=>$_POST['target_role'],
':priority'=>$_POST['priority'],
':expiry_date'=>$_POST['expiry_date'] ?: null,
':id'=>$id
]);

header("Location: manage_notices.php");
exit;
}
?>


<form method="POST">
<input type="text" name="title" value="<?php echo htmlspecialchars($notice['title']); ?>" class="form-control mb-2">

<textarea name="message" class="form-control mb-2"><?php echo htmlspecialchars($notice['message']); ?></textarea>

<select name="target_role" class="form-control mb-2">
<option value="student" <?php if($notice['target_role']=='student') echo 'selected'; ?>>Student</option>
<option value="teacher" <?php if($notice['target_role']=='teacher') echo 'selected'; ?>>Teacher</option>
<option value="both" <?php if($notice['target_role']=='both') echo 'selected'; ?>>Both</option>
</select>

<select name="priority" class="form-control mb-2">
<option value="normal" <?php if($notice['priority']=='normal') echo 'selected'; ?>>Normal</option>
<option value="important" <?php if($notice['priority']=='important') echo 'selected'; ?>>Important</option>
</select>

<input type="date" name="expiry_date" 
value="<?php echo $notice['expiry_date']; ?>" 
class="form-control mb-2">

<button type="submit" name="update" class="btn btn-success">
Update Notice
</button>
</form>