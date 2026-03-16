<?php
require_once("../config/config.php");

// Get current logged in role
$current_role = $_SESSION['role'];

try {
    $stmt = $pdo->prepare("
        SELECT * FROM notices 
        WHERE target_role = :role 
        OR target_role = 'both'
        ORDER BY created_at DESC
    ");

    $stmt->bindParam(':role', $current_role);
    $stmt->execute();

    $notices = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($notices) > 0){
        echo "<div class='card mb-3'>";
        echo "<div class='card-header bg-dark text-white'>Latest Notices</div>";
        echo "<div class='card-body'>";

        foreach($notices as $row){
            echo "<div class='alert alert-info'>";
            echo "<h5>".$row['title']."</h5>";
            echo "<p>".$row['message']."</p>";
            echo "<small>".$row['created_at']."</small>";
            echo "</div>";
        }

        echo "</div></div>";
    }

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>