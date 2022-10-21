<?php
include('header.php');
include('config.php');

if($_SESSION['role'] == 0){
	$post_id = $_GET['id'];
	$sql2 = "SELECT author FROM posts WHERE post_id = $post_id ";
	$result2 = $conn->query($sql2) or die("Query Failed : " . $conn->error);
	
	$row2 = $result2->fetch_assoc();
	
	if($row2['author'] != $_SESSION['user_id']){
		header("Location: {$hostname}/admin/post.php");
	}
}


if(isset($_POST['update'])){
	$errors = array();
	
	$file_name = $_FILES['post_image']['name'];
	$file_size = $_FILES['post_image']['size'];
	$file_tmp = $_FILES['post_image']['tmp_name'];
	$file_type = $_FILES['post_image']['type'];
//	$file_ext = end(explode('.', $file_name));
	$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
	
	$extension = ["jpeg", "jpg", "png"];
	
	if(in_array($file_ext, $extension) == false) {
		$errors[] = "This extension file not allowed, Please choose a JPEG or JPG or PNG file.";
	}
	
	if($file_size > 2097152){
		$errors[] = "File size must be 2MB or lower.";
	}
	
	$new_name = time()."_".basename($file_name);
	$target = "upload/".$new_name;
	
	if(empty($errors) == true) {
		move_uploaded_file($file_tmp, $target);
	}else{
		print_r($errors);
		die();
	}


$update_post_id = $_POST['post_id'];
$title = mysqli_real_escape_string($conn, $_POST['title']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
//$date = date("d M, Y");
//$author = $_SESSION['user_id'];
	
$sql = "UPDATE posts SET title = '$title', description = '$description', category = '$category', post_img = '$new_name' WHERE post_id = $update_post_id ";

//$sql = "INSERT INTO posts (title, description, category, post_date, author, post_img) 
//VALUES ('$title', '$description', $category, '$date', $author, '$new_name');";

//$result = $conn->multi_query($sql) or die("Query Failed : " . $conn->error);

if($conn->query($sql)) {
	echo "<script>";
	echo "window.location = '{$hostname}/admin/post.php'";
	echo "</script>";

//	header("location : {$hostname}/admin/post.php");

}else{
	echo "<div class='alert alert-danger'>Query Failed.</div>";
}

}

?>

<div class="admin-container">
	<div class="container">
		<h1>Edit Post</h1><hr>
		<div class="admin-box p-3">
			<?php
			$post_id = $_GET['id'];
			$sql = "SELECT posts.post_id, posts.title, posts.description, posts.post_img,
        category.category_name, posts.category FROM posts
        LEFT JOIN category ON posts.category = category.category_id
        LEFT JOIN users ON posts.author = users.user_id
        WHERE posts.post_id = {$post_id}";
			
			$result = $conn->query($sql) or die("Query Failed " . $conn->error);
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					
			?>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
				<div class="form-group py-1">
					<label for="title">Title</label>
					<input type="hidden" name="post_id" value="<?php echo $row['post_id']; ?>">
					<input type="text" name="title" id="title" value="<?php echo $row['title']; ?>" class="form-control" placeholder="Title" required>
				</div>
				<div class="form-group py-2">
					<label for="description">Description</label>
					<textarea name="description" id="description" rows="5" class="form-control" placeholder="Description" required><?php echo $row['description']; ?></textarea>
				</div>
				<div class="form-group py-2">
					<label for="category">Category</label>
					<select name="category" id="category" class="form-control" required>
						<option value="" disabled>Select Category</option>
						<?php 
						$sqlc = "SELECT * FROM category";
						$resultc = $conn->query($sqlc) or die("Query Failed " . $conn->error);
						if($resultc->num_rows > 0) {
							while($rowc = $resultc->fetch_assoc()) {
								if($row['category'] == $rowc['category_id']){
									$selected = "selected";
								}else{
									$selected = "";
								}
								echo "<option $selected value='{$rowc['category_id']}'>{$rowc['category_name']}</option>";
							}
						}
						?>
					</select>
					       
				</div>
				<div class="form-group py-2">
					<label for="post_img">Post Image</label><br>
					<input type="file" name="post_image" id="post_img" required>
				</div><br>
				<input type="submit" value="Update" name="update" class="btn btn-primary">
			</form>
			<?php 
				}
			}
					?>
		</div>
	</div>
</div>

<?php
include('footer.php');
?>