<?php
include("../config/db.php");

$success = "";
$error = "";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    try {

        $sql = "INSERT INTO users (name, gender, email, mobile, password, role)
                VALUES (:name,:gender,:email,:mobile,:password,:role)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'=>$name,
            ':gender'=>$gender,
            ':email'=>$email,
            ':mobile'=>$mobile,
            ':password'=>$password,
            ':role'=>$role
        ]);

        $success = "Registration Successful! You can login now.";

    } catch(PDOException $e){
        $error = "Email already exists or something went wrong!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-Learning Register</title>

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
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    /* Updated gradient to match your home page colors */
    background: linear-gradient(135deg, #00bcd4 0%, #36b9cc 50%, #4e73df 100%);
    background-size: 400% 400%;
    animation: gradientMove 15s ease infinite;
    overflow: hidden;
}

@keyframes gradientMove{
    0%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
    100%{background-position:0% 50%;}
}

/* Floating education icons */
.floating i{
    position:absolute;
    color:rgba(255,255,255,0.1);
    font-size:40px;
    animation:float 8s linear infinite;
}

.floating i:nth-child(1){ top:10%; left:15%; animation-delay:0s;}
.floating i:nth-child(2){ top:70%; left:80%; animation-delay:2s;}
.floating i:nth-child(3){ top:40%; left:5%; animation-delay:4s;}
.floating i:nth-child(4){ top:80%; left:30%; animation-delay:6s;}

@keyframes float{
    0%{ transform:translateY(0);}
    50%{ transform:translateY(-30px);}
    100%{ transform:translateY(0);}
}

.login-box, .register-box {
    width: 380px;
    background: #ffffff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    animation: fadeIn 1s ease;
}

/* Specific size for register box to prevent overflow */
.register-box { width: 420px; max-height: 95vh; overflow-y: auto; }

@keyframes fadeIn{
    from{opacity:0; transform:translateY(20px);}
    to{opacity:1; transform:translateY(0);}
}

h2 {
    text-align: center;
    margin-bottom: 10px;
    color: #00bcd4; /* Teal color from Home Page */
}

.subtitle{
    text-align:center;
    font-size:14px;
    margin-bottom:25px;
    color:#777;
}

.input-group{
    position:relative;
    margin-bottom:20px;
}

.input-group input, .input-group select {
    width:100%;
    padding:12px 40px;
    border:1px solid #eee;
    border-radius:30px;
    outline:none;
    transition:0.3s;
    background: #fdfdfd;
}

.input-group input:focus, .input-group select:focus {
    border-color:#00bcd4;
    box-shadow:0 0 8px rgba(0, 188, 212, 0.3);
}

.input-group i{
    position:absolute;
    left:15px;
    top:50%;
    transform:translateY(-50%);
    color:#00bcd4;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:30px;
    background:#00bcd4; /* Matching Button Color */
    color:#fff;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#20c4da;
    transform:translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 188, 212, 0.3);
}

.link{
    text-align:center;
    margin-top:15px;
    font-size:14px;
}

.link a{
    color:#00bcd4;
    text-decoration:none;
    font-weight: 500;
}

.error, .message{
    padding:10px;
    border-radius:8px;
    text-align:center;
    margin-bottom:15px;
    font-size:13px;
}

.error { background:#ffe0e0; color:#b30000; }
.success { background:#e6fff5; color:#008060; }

@media(max-width:420px){
    .login-box, .register-box { width:90%; padding:30px; }
}


</style>
</head>
<body>

<div class="floating">
<i class="fa-solid fa-book"></i>
<i class="fa-solid fa-graduation-cap"></i>
<i class="fa-solid fa-laptop-code"></i>
<i class="fa-solid fa-chalkboard-user"></i>
</div>

<div class="register-box">

<h2>Create Account</h2>
<div class="subtitle">Start Your Learning Journey 🚀</div>

<?php if($success): ?>
<div class="message success"><?php echo $success; ?></div>
<?php endif; ?>

<?php if($error): ?>
<div class="message error"><?php echo $error; ?></div>
<?php endif; ?>

<form method="POST">

<div class="input-group">
<i class="fa fa-user"></i>
<input type="text" name="name" placeholder="Full Name" required>
</div>

<div class="input-group">
<i class="fa fa-venus-mars"></i>
<select name="gender" required>
<option value="">Select Gender</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
</div>

<div class="input-group">
<i class="fa fa-envelope"></i>
<input type="email" name="email" placeholder="Email" required>
</div>

<div class="input-group">
<i class="fa fa-phone"></i>
<input type="tel" name="mobile" placeholder="Mobile Number" maxlength="10" required>
</div>

<div class="input-group">
<i class="fa fa-lock"></i>
<input type="password" name="password" placeholder="Password" required>
</div>

<div class="input-group">
<i class="fa fa-user-tag"></i>
<select name="role" required>
<option value="">Select Role</option>
<option value="student">Student</option>
<option value="teacher">Teacher</option>
</select>
</div>

<button type="submit" name="register">Register</button>

</form>

<div class="link">
Already have account? <a href="login.php">Login</a>
</div>

</div>

</body>
</html>