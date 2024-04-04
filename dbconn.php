<?php
header("Cache-Control: no-cache");
$servername = "localhost";
$username = "root";
$password = "";
$database = "mycompany";
$conn = new mysqli($servername,$username, $password,$database);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
?>
