<?php
include( 'header.php' );
include( 'config.php' );

if($_SESSION['role'] == 0){
	header("Location: {$hostname}/admin/post.php");
}

if ( isset( $_POST[ 'save' ] ) ) {
	$category_id =  mysqli_real_escape_string( $conn, $_POST[ 'category_id' ] );
  $category = mysqli_real_escape_string( $conn, $_POST[ 'category' ] );

  $sql = "UPDATE category SET category_name = '$category' WHERE category_id = $category_id ";
  $result = $conn->query( $sql );

  if ( $result ) {
    header( "Location: {$hostname}/admin/category.php" );
  } else {
    echo "<p style = 'color:red;text-align:center;margin: 10px 0';>Query Failed.</p>";
  }
}


?>
<div class="admin-container">
  <div class="container">
    <h1>Add Category</h1>
    <hr>
    <div class="admin-box p-3">
		 <?php
		  $catId = $_GET['id'];
		  $sql = "SELECT * FROM category WHERE category_id = $catId ";
		  $result = $conn->query($sql) or die("Query Failed " . $conn->error);
		  if($result->num_rows > 0) {
		  ?>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group py-1">
          <label for="category">Category Name</label>
			<?php
			while($row = $result->fetch_assoc()) {
			?>
			<input type="hidden" name="category_id" value="<?php echo $row['category_id']; ?>">
          <input type="text" name="category" id="category" value="<?php echo $row['category_name']; ?>" class="form-control" placeholder="Category" required>
        </div>
        <br>
        <input type="submit" value="Update" name="save" class="btn btn-primary">
		  <?php
		    }
		  }
		  ?>
      </form>
    </div>
  </div>
</div>
<?php
$conn->close();
include( 'footer.php' );
?>
