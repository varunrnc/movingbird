<?php
include( 'header.php' );
include('config.php');

if($_SESSION['role'] == 0){
	header("Location: {$hostname}/admin/post.php");
}

if(isset($_POST['submit'])) {
	
if(empty($_FILES['logo']['name'])){
  $file_name = $_POST['old_logo'];
}else{
  $errors = array();

  $file_name = $_FILES['logo']['name'];
  $file_size = $_FILES['logo']['size'];
  $file_tmp = $_FILES['logo']['tmp_name'];
  $file_type = $_FILES['logo']['type'];
  $exp = explode('.',$file_name);
 $file_ext = end($exp);

  $extensions = array("jpeg","jpg","png");

  if(in_array($file_ext,$extensions) === false)
  {
    $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
  }

  if($file_size > 2097152){
    $errors[] = "File size must be 2mb or lower.";
  }

  if(empty($errors) == true){
    move_uploaded_file($file_tmp,"images/".$file_name);
  }else{
    print_r($errors);
    die();
  }
}

$website_name = $_POST['website_name'];
$footerdesc = $_POST['footer_desc'];

	$sql = "UPDATE settings SET website_name = '$website_name', logo = '$file_name', footerdesc = '$footerdesc' ";
	$result = $conn->query($sql) or die("Query Failed " . $conn->error);
	
if($result){
  header("location: {$hostname}/admin/settings.php");
}else{
  echo "Query Failed";
}


}

?>

<section class="setting-section">
	<div class="container d-flex justify-content-center py-4">
		<div class="setting-box col-md-6 p-3">
			<?php
			$sql = "SELECT * FROM settings";
			$result = $conn->query($sql) or die("Query Failed " . $conn->error);
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {

			?>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="website_name" class="my-2">Website Name</label>
					<input type="text" name="website_name" id="website_name" value="<?php echo $row['website_name']; ?>" class="form-control" autocomplete="off" required>
				</div><br>
				<div class="form-group">
					<label for="logo">Website Logo</label><br>
					<input type="file" name="logo" id="logo">
					<img src="images/<?php echo $row['logo']; ?>" alt="logo" class="img-fluid" style="width: 20%;">
					<input type="hidden" name="old_logo" value="<?php echo $row['logo']; ?>">
				</div>
				<div class="form-group">
					<label for="footer_desc">Footer Description</label>
					<textarea name="footer_desc" id="footer_desc" rows="5" class="form-control" required><?php echo $row['footerdesc']; ?></textarea>
				</div><br>
				<input type="submit" value="Save" name="submit" class="btn btn-primary">
			</form>
			<?php
				}
			}
			?>
		</div>
	</div>
</section>


<?php
include( 'footer.php' );
?>
