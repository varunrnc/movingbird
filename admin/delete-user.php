<?php
include('config.php');

if($_SESSION['role'] == 0){
	header("Location: {$hostname}/admin/post.php");
}

$userid = $_GET['id'];
$sql = "DELETE FROM users WHERE user_id = $userid";
$result = $conn->query($sql) or die("Query Failed . " . $conn->error);

if($result) {
	header("Location: {$hostname}/admin/users.php");
}else{
	echo "<p style='color:red;margin: 10px 0;'>Can\'t Delete the User Record.</p>";
}

$conn->close();

?>