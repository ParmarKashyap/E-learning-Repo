<?php
// Database configuration
$host = "localhost";     // or "localhost"
$username = "root";      // Default username for local servers
$password = "";          // Default password is usually empty
$database = "feedback";  // The database name from your screenshot

// Create the MySQLi connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// You can uncomment the line below to test if it works, 
// but remember to remove it or comment it out for your final project!
// echo "Connected successfully to the feedback database!";
?>