<?php 
include('config.php');
session_start();

if(!isset($_SESSION['username'])){
	header("Location: {$hostname}/admin/index.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Admin | Panel</title>
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
	
	<!--	Bootstrap CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	
	<!--	Font Awesome Icons CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!--	Custom CSS -->
	<link rel="stylesheet" href="../css/style.css">
</head>
	
<body>
	
	<header>
		<div class="container d-flex justify-content-between py-3">
			<h2>Moving Bird</h2>
			<h2>Hello, <?php echo $_SESSION['first_name']; ?></h2>
			<a href="logout.php" class="btn btn-danger">Logout</a>
		</div>
	</header>

	<div class="admin-nav">
		<nav class="bg-dark">
			<div class="container">
				<ul class="d-flex p-3">
					<li class="px-3"><a href="post.php">Post</a></li>
					<?php 
					if($_SESSION['role'] == 1){
						
					?>
					<li class="px-3"><a href="category.php">Category</a></li>
					<li class="px-3"><a href="users.php">Users</a></li>
					<li class="px-3"><a href="settings.php">Settings</a></li>
					<?php } ?>
				</ul>
			</div>
		</nav>
	</div>