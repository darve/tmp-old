<?php
$servername = "localhost";
$username = "tmpmortg_website";
$password = "q212Kt1Lsshd123as";


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>