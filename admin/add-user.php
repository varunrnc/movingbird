<?php
ob_start();
include( 'header.php' );
include('config.php');

if($_SESSION['role'] == 0){
	header("Location: {$hostname}/admin/post.php");
}

if(isset($_POST['save'])) {
	
	$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
	$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
	$username = mysqli_real_escape_string($conn, $_POST['user_name']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$password = md5($password);
	$role = mysqli_real_escape_string($conn, $_POST['role']);
	
	$sql = "SELECT username FROM users WHERE username = '$username'";
	$result = $conn->query($sql) or die("Query Failed : " . $conn->error);
	
	if($result->num_rows > 0) {
		echo "<p style='color:red;text-align:center;margin: 10px 0;'>UserName already Exists.</p>";
	}else{
		$sql1 = "INSERT INTO users (first_name, last_name, username, password, role) VALUES ('$first_name', '$last_name', '$username', '$password', '$role')";
		
		if($conn->query($sql1)){
      header("Location: {$hostname}/admin/users.php");
    }else{
      echo "<p style='color:red;text-align:center;margin: 10px 0;'>Can't Insert User.</p>";
    }
	}
}
?>

<section class="admin-container">
	<div class="container">
		<h1>Add User</h1><hr>
		<div class="admin-box p-3">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="form-group py-1">
					<label for="first_name">First Name</label>
					<input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" required>
				</div>
				<div class="form-group py-2">
					<label for="last_name">Last Name</label>
					<input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required>
				</div>
				<div class="form-group py-2">
					<label for="user_name">Username</label>
					<input type="text" name="user_name" id="user_name" class="form-control" placeholder="Username" required>
				</div>
				<div class="form-group py-2">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
				</div>
				<div class="form-group py-2">
					<label for="role">User Role</label>
					<select name="role" id="role" class="form-control" required>
						<option value="" disabled selected>Select Role</option>
						<option value="0">Normal User</option>
						<option value="1">Admin</option>
					</select>
				</div>
				<input type="submit" value="Save" name="save" class="btn btn-primary">
			</form>
		</div>
	</div>
</section>



<?php
include_once( 'footer.php' );
?>
