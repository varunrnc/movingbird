<?php
include('config.php');

$post_id = $_GET['id'];
$cat_id = $_GET['cat_id'];

$sql1 = "SELECT * FROM posts WHERE post_id = $post_id ";
$result = $conn->query($sql1) or die("Query Failed .");
$row = $result->fetch_assoc();

unlink("upload/".$row['post_img']);


$sql = "DELETE FROM posts WHERE post_id = $post_id; ";
$sql .= "UPDATE category SET post = post - 1 WHERE category_id = $cat_id";
$result = $conn->multi_query($sql) or die("Query Failed " . $conn->error);

if($result) {
	header("Location: {$hostname}/admin/post.php");
}else{
	echo "<p style='color:red;margin: 10px 0;'>Can\'t Delete Post.</p>";
}





?>