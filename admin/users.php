<?php
include( 'header.php' );
include( 'config.php' );

if($_SESSION['role'] == 0){
	header("Location: {$hostname}/admin/post.php");
}

$limit = 3;
if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM users ORDER BY user_id DESC LIMIT $offset, $limit";
$result = $conn->query( $sql )or die( "Query Failed : " . $conn->error );


?>
<section class="post-section">
  <div class="container">
    <div>
      <h1>All Users</h1>
      <a href="add-user.php" class="btn btn-primary">Add User</a> </div>
    <hr>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">S.No.</th>
          <th scope="col">Full Name</th>
          <th scope="col">User Name</th>
          <th scope="col">Role</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
		  $serial = $offset + 1;
        if ( $result->num_rows > 0 ) {
          while ( $row = $result->fetch_assoc() ) {
            ?>
        <tr>
          <td><?php echo $serial; ?></td>
          <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
          <td><?php echo $row['username']; ?></td>
          <td><?php
          if ( $row[ 'role' ] == 1 ) {
            echo 'Admin';
          } else {
            echo 'Normal';
          }
          ?></td>
          <td><a href="update-user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-info">Edit</a></td>
          <td><a href="delete-user.php?id=<?php echo $row['user_id']; ?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php
			  $serial++;
        }
			?>
      </tbody>
    </table>
	  <?php
			}else{
			echo "<h3>No Record Found.</h3>";
		}
		  // show pagination
		  $sql1 = "SELECT * FROM users";
		  $result1 = $conn->query($sql1) or die("Query Failed." . $conn->error);
		  if($result1->num_rows > 0) {
			  $total_records = $result1->num_rows;
			  $total_page = ceil($total_records / $limit);
		  }
			?>
	  
    <div class="admin-pagination">
      <nav aria-label="Page navigation">
        <ul class="pagination">
			<?php 
			if($page > 1){
				echo "<li class='page-item'><a class='page-link' href='users.php?page=". ($page - 1) ."'>Previous</a></li>";
			}else{
				echo "<li class='page-item disabled'><a class='page-link' href='#' tabindex='-1' aria-disabled='true'>Previous</a></li>";
			}
			
			for($i=1; $i<=$total_page; $i++) {
				if($i == $page){
					$active = 'active';
				}else{
					$active = '';
				}
				echo "<li class='page-item " . $active . "'><a class='page-link' href='users.php?page=". $i ."'> $i </a></li>";
			}
			if($total_page > $page) {
				echo "<li class='page-item'><a class='page-link' href='users.php?page=". ($page + 1) ."'>Next</a></li>";
			}else{
				echo "<li class='page-item disabled'><a class='page-link' href='#' tabindex='+1' aria-disabled='true'>Next</a></li>";
			}
			?>
<!--          <li class="page-item disabled"> <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a> </li>-->
			
<!--
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item active" aria-current="page"> <a class="page-link" href="#">2</a> </li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"> <a class="page-link" href="#">Next</a> </li>
-->
        </ul>
      </nav>
    </div>
  </div>
</section>
<?php
include_once( 'footer.php' );
?>
