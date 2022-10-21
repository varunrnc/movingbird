<?php
include('config.php');

if($_SESSION['role'] == 0){
	header("Location: {$hostname}/admin/post.php");
}

$catId = $_GET['id'];
$sql = "DELETE FROM category WHERE category_id = $catId";
$result = $conn->query($sql) or die("Query Failed " . $conn->error);

if($result) {
	header("Location: {$hostname}/admin/category.php");
}else{
	echo "<p style='color:red;margin: 10px 0;'>Can\'t Delete Category.</p>";
}


?>