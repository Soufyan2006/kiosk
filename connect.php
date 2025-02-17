<?php
$dbhost = "localhost";  
$dbuser = "root";       
$password = "";         
$dbname = "kiosk";      

// Create connection
$conn = new mysqli($dbhost, $dbuser, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>