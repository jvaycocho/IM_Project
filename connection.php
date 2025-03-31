<?php
$servername = "localhost";
$username = "root"; // Change this if you have a different MySQL user
$password = ""; // Change this if you have set a password for MySQL
$database = "user_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    
}
?>