<?php
include( 'header.php' );
include( 'config.php' );

$limit = 5;
if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}

$offset = ($page - 1) * $limit;

if($_SESSION['role'] == 1){
	/* select query of post table for admin user */
	$sql = "SELECT posts.post_id, posts.title, posts.post_date, posts.category, posts.description, category.category_name, users.username FROM posts LEFT JOIN category ON posts.category = category.category_id
	LEFT JOIN users ON posts.author = users.user_id ORDER BY posts.post_id DESC LIMIT $offset, $limit";
}elseif($_SESSION['role'] == 0) {
	$sql = "SELECT posts.post_id, posts.title, posts.post_date, posts.category, posts.description, category.category_name, users.username FROM posts LEFT JOIN category ON posts.category = category.category_id
	LEFT JOIN users ON posts.author = users.user_id 
	WHERE posts.author = {$_SESSION['user_id']}
	ORDER BY posts.post_id DESC LIMIT $offset, $limit";
}

?>
<section class="post-section">
  <div class="container">
    <div>
      <h1>All Posts</h1>
      <a href="add-post.php" class="btn btn-primary">Add Post</a> </div>
    <hr>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">S.No.</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Date</th>
          <th scope="col">Author</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
		  <?php 
		  $result = $conn->query($sql) or die("Query Failed : " . $conn->error);
		  if($result->num_rows > 0){
			$serial = $offset + 1;
		  while($row = $result->fetch_assoc()) {
		  ?>
        <tr>
          <td><?php echo $serial; ?></td>
          <td><?php echo $row['title']; ?></td>
          <td><?php echo $row['category_name']; ?></td>
          <td><?php echo $row['post_date']; ?></td>
          <td><?php echo $row['username']; ?></td>
          <td><a href="update-post.php?id=<?php echo $row['post_id']; ?>" class="btn btn-info">Edit</a></td>
          <td><a href="delete-post.php?id=<?php echo $row['post_id']; ?>&cat_id=<?php echo $row['category']; ?>" class="btn btn-danger">Delete</a></td>
        </tr>
		  <?php 
			  $serial++;
		  } 
			}else{
	echo "<h3>No Results Found.</h3>";
}  
		  ?>
      </tbody>
    </table>
	  <?php
	  
// show pagination
if($_SESSION['role'] == 1){
	$sql1 = "SELECT * FROM posts";
}elseif($_SESSION['role'] == 0){
	$sql1 = "SELECT * FROM posts WHERE author = {$_SESSION['user_id']}";
}

$result1 = $conn->query($sql1) or die("Query Failed : " . $conn->error);
if($result1->num_rows > 0) {
	$total_records = $result1->num_rows;
	$total_page = ceil($total_records / $limit);
	  ?>
    <div class="admin-pagination">
      <nav aria-label="Page navigation">
        <ul class="pagination">
			<?php
			if($page > 1){
				echo "<li class='page-item'><a class='page-link' href='post.php?page=". ($page - 1) ."'>Previous</a></li>";
			}else{
				echo "<li class='page-item disabled'><a class='page-link' href='#' tabindex='-1' aria-disabled='true'>Previous</a></li>";
			}
			for($i=1; $i<=$total_page; $i++) {
				if($i == $page){
					$active = 'active';
				}else{
					$active = '';
				}
				echo "<li class='page-item " . $active . "'><a class='page-link' href='post.php?page=". $i ."'> $i </a></li>";
			}
			if($total_page > $page) {
				echo "<li class='page-item'><a class='page-link' href='post.php?page=". ($page + 1) ."'>Next</a></li>";
			}else{
				echo "<li class='page-item disabled'><a class='page-link' href='#' tabindex='+1' aria-disabled='true'>Next</a></li>";
			}
			?>	
        </ul>
		  <?php } ?>
      </nav>
    </div>
	  
  </div>
</section>
<?php
include( 'footer.php' );
?>
