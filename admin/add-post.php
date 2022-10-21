<?php
include('header.php');
include('config.php');


if(isset($_POST['save'])){
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



$title = mysqli_real_escape_string($conn, $_POST['title']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$date = date("d M, Y");
$author = $_SESSION['user_id'];

$sql = "INSERT INTO posts (title, description, category, post_date, author, post_img) 
VALUES ('$title', '$description', $category, '$date', $author, '$new_name');";
$sql .= "UPDATE category SET post = post + 1 WHERE category_id = $category";
//$result = $conn->multi_query($sql) or die("Query Failed : " . $conn->error);

if($conn->multi_query($sql)) {
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
		<h1>Add Post</h1><hr>
		<div class="admin-box p-3">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
				<div class="form-group py-1">
					<label for="title">Title</label>
					<input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
				</div>
				<div class="form-group py-2">
					<label for="description">Description</label>
					<textarea name="description" id="description" rows="5" class="form-control" placeholder="Description" required></textarea>
				</div>
				<div class="form-group py-2">
					<label for="category">Category</label>
					<select name="category" id="category" class="form-control" required>
						<option value="" disabled selected>Select Category</option>
						<?php 
						$sql = "SELECT * FROM category";
						$result = $conn->query($sql) or die("Query Failed " . $conn->error);
						if($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
							}
						}
						?>
					</select>
				</div>
				<div class="form-group py-2">
					<label for="post_img">Post Image</label><br>
					<input type="file" name="post_image" id="post_img" required>
				</div><br>
				<input type="submit" value="Save" name="save" class="btn btn-primary">
			</form>
		</div>
	</div>
</div>

<?php
include('footer.php');
?>