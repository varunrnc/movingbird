<?php
include('header.php');
include('config.php');

if($_SESSION['role'] == 0){
	header("Location: {$hostname}/admin/post.php");
}

if(isset($_POST['save'])) {
	
	$category = mysqli_real_escape_string($conn, $_POST['category']);
	/* query for check input value exists in category table or not*/
	$sql = "SELECT * FROM category WHERE category_name = '$category'";
	$result = $conn->query($sql) or die("Query Failed . " . $conn->error);
	
	if($result->num_rows > 0) {
		// if input value exists
         echo "<p style = 'color:red;text-align:center;margin: 10px 0';> Category already exists.</p>";
	}else{
		// if input value not exists
        // query for insert record in category name 
		$sql = "INSERT INTO category (category_name) VALUES ('$category')";
		$result = $conn->query($sql);
		
		if($result){
			header("Location: {$hostname}/admin/category.php");
		}else{
			echo "<p style = 'color:red;text-align:center;margin: 10px 0';>Query Failed.</p>";
		}
	}
}


?>

<div class="admin-container">
	<div class="container">
		<h1>Add Category</h1><hr>
		<div class="admin-box p-3">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="form-group py-1">
					<label for="category">Category Name</label>
					<input type="text" name="category" id="category" class="form-control" placeholder="Category" required>
				</div>
				<br>
				<input type="submit" value="Save" name="save" class="btn btn-primary">
			</form>
		</div>
	</div>
</div>

<?php
$conn->close();
include('footer.php');
?>