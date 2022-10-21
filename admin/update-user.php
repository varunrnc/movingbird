<?php

include( 'header.php' );
include('config.php');

if($_SESSION['role'] == 0){
	header("Location: {$hostname}/admin/post.php");
}

if(isset($_POST['submit'])) {
	$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
	$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$role = mysqli_real_escape_string($conn, $_POST['role']);
	
	$sql1 = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username = '$username', role = '$role' WHERE user_id = $user_id";
		
	if($conn->query($sql1)){
      header("Location: {$hostname}/admin/users.php");
    }else{
      echo "<p style='color:red;text-align:center;margin: 10px 0;'>Can't Update User.</p>";
    }
	
}
?>

<section class="add-user">
	<div class="container">
		<h1>Edit User</h1><hr>
		<div class="add-user-box p-3">
			<?php
			$user_id = $_GET['id'];
			$sql = "SELECT * FROM users WHERE user_id = $user_id";
			$result = $conn->query($sql) or die("Query Failed : " . $conn->error);
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()){
					?>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="form-group py-1">
					<input type="hidden" name="user_id" id="user_id" value="<?php echo $row['user_id']; ?>">
					<label for="first_name">First Name</label>
					<input type="text" name="first_name" id="first_name" value="<?php echo $row['first_name']; ?>" class="form-control" placeholder="First Name" required>
				</div>
				<div class="form-group py-2">
					<label for="last_name">Last Name</label>
					<input type="text" name="last_name" id="last_name" value="<?php echo $row['last_name']; ?>" class="form-control" placeholder="Last Name" required>
				</div>
				<div class="form-group py-2">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" value="<?php echo $row['username']; ?>" class="form-control" placeholder="Username" required>
				</div>

				<div class="form-group py-2">
					<label for="role">User Role</label>
					<select name="role" id="role" value="<?php echo $row['role']; ?>" class="form-control" required>
						<option value="" disabled>Select Role</option>
						<?php
					if($row['role'] == 1) {
						echo "<option value='0'>Normal User</option>
								<option value='1' selected>Admin</option>";
					}else{
								echo "<option value='0' selected>Normal User</option>
								<option value='1'>Admin</option>";
					}
					
					?>
					</select>
				</div>
				<input type="submit" value="Update" name="submit" class="btn btn-primary">
			</form>
			<?php
				}
			}
			
			?>
		</div>
	</div>
</section>



<?php
include_once( 'footer.php' );
?>
