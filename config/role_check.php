<?php
function checkRole($required_role){
    if(!isset($_SESSION['role']) || $_SESSION['role'] !== $required_role){
        header("Location: /elearning/auth/login.php");
        exit();
    }
}

?>