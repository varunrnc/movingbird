<?php
include_once('config.php');
session_start();
if(isset($_SESSION['username'])){
	header("Location: {$hostname}/admin/post.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Admin | Login</title>
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
	
	<!--	Bootstrap CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	
	<!--	Font Awesome Icons CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!--	Custom CSS -->
	<link rel="stylesheet" href="../css/style.css">
</head>
	
<body>
	
	<div class="wrapper-login">
		<div class="login-container">
			<div class="login-box p-2">
				<h2 class="text-center">Moving Bird</h2>
				<h4>Admin</h4>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" name="username" id="username" class="form-control" required>
					</div>
					<div class="form-group my-2">
						<label for="password">Password</label>
						<input type="password" name="password" id="password" class="form-control" required>
					</div>
					<input type="submit" value="login" name="login" class="btn btn-primary login-btn">
				</form><br><br>
				<?php
				if(isset($_POST['login'])) {
					if(empty($_POST['username']) || empty($_POST['password'])){
						  echo '<div class="alert alert-danger">All Fields must be entered.</div>';
						die();
					}else{
						$username = mysqli_real_escape_string($conn, $_POST['username']);
						$password = mysqli_real_escape_string($conn, $_POST['password']);
						$password = md5($password);
						
						$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
						$result = $conn->query($sql) or die("Query Failed : " . $conn->error);
						
						if($result->num_rows > 0) {
							$row = $result->fetch_assoc();
							session_start();
							$_SESSION['username'] = $row['username'];
							$_SESSION['user_id'] = $row['user_id'];
							$_SESSION['first_name'] = $row['first_name'];
							$_SESSION['role'] = $row['role'];
							
							header("Location: {$hostname}/admin/post.php");
						}else{
							echo '<div class="alert alert-danger">Username and Password are not matched.</div>';
						}
					
					}
				}
				
				?>
			</div>
		</div>
	</div>
	
	
	

	
	
	
	
	
	
	
	
	
	
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="../js/script.js"></script>
</body>
</html>