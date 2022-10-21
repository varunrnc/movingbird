<?php
$hostname = "http://localhost/movingbird";

$server = "localhost";
$user = "root";
$password = "";
$db_name = "movingbird";

$conn = new mysqli($server, $user, $password, $db_name);

if($conn->connect_error) {
	die("Connection Failed : " . $conn->connect_error);
}



?>