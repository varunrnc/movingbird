<?php
include( 'config.php' );
$page = basename( $_SERVER[ 'PHP_SELF' ] );

switch ( $page ) {
  case "single.php":
    if ( isset( $_GET[ 'id' ] ) ) {
      $sql_title = "SELECT * FROM posts WHERE post_id = {$_GET['id']}";
      $result_title = $conn->query( $sql_title )or die( "Query Failed : " . $conn->error );
      $row_title = $result_title->fetch_assoc();
      $page_title = $row_title[ 'title' ];
    } else {
      $page_title = "No page found.";
    }
    break;
  case "category.php":
    if ( isset( $_GET[ 'cid' ] ) ) {
      $sql_title = "SELECT * FROM category WHERE category_id = {$_GET['cid']}";
      $result_title = $conn->query( $sql_title )or die( "Title Query Failed" );
      $row_title = $result_title->fetch_assoc();
      $page_title = $row_title[ 'category_name' ] . " News";
    } else {
      $page_title = "No Post Found";
    }
    break;
  case "author.php":
    if ( isset( $_GET[ 'aid' ] ) ) {
      $sql_title = "SELECT * FROM users WHERE user_id = {$_GET['aid']}";
      $result_title = $conn->query( $sql_title )or die( "Title Query Failed" );
      $row_title = $result_title->fetch_assoc();
      $page_title = "Posted By " . $row_title[ 'first_name' ] . " " . $row_title[ 'last_name' ];
    } else {
      $page_title = "No Post Found";
    }
    break;
  case "search.php":
    if ( isset( $_GET[ 'search' ] ) ) {

      $page_title = $_GET[ 'search' ];
    } else {
      $page_title = "No Search Result Found";
    }
    break;
  default:
    $sql_title = "SELECT website_name FROM settings";
    $result_title = $conn->query( $sql_title )or die( "Title Query Failed" );
    $row_title = $result_title->fetch_assoc();
    $page_title = $row_title[ 'website_name' ];
    break;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $page_title; ?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<!--	Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!--	Font Awesome Icons CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--	Custom CSS -->
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
<!--	================== Header ================= -->
<header>
  <div class="container py-4 text-center"> 
	  <?php
//	  include('config.php');
	  $sql = "SELECT * FROM settings";
	  $result = $conn->query($sql) or die("Query Failed : " . $conn->error);
	  if($result->num_rows > 0) {
		  while($row = $result->fetch_assoc()) {
	  ?>
	  <a href="index.php"><h1><?php echo $row['website_name']; ?></h1></a>
	  <?php
	  		  }
	  }
	  ?>
    <p>Sub Heading</p>
  </div>
</header>

<!--	================== Navbar ================= -->

<nav class="main-nav">
  <div class="container">
	  <?php 
	  if(isset($_GET['cid'])){
		  $cat_id = $_GET['cid'];
	  }
	  
	  $sql = "SELECT * FROM category WHERE post > 0";
	  $result = $conn->query($sql) or die("Query Failed : Category " . $conn->error);
	  if($result->num_rows > 0){
		  $active = "";
	  
	  ?>
    <ul class="d-flex justify-content-center align-items-center">
      <li class="p-3"><a href="<?php echo $hostname; ?>">Home</a></li>
		<?php
		  while($row = $result->fetch_assoc()) {
			  if(isset($_GET['cid'])){
				  if($row['category_id'] == $cat_id){
					  $active = "active";
				  }else{
					  $active = "";
				  }
			  }
			  echo "<li class='p-3 {$active}'><a href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
		  }
		  ?>
<!--
      <li class="p-3"><a href="#">About</a></li>
      <li class="p-3"><a href="#">Services</a></li>
      <li class="p-3"><a href="#">Blog</a></li>
      <li class="p-3"><a href="#">Contact</a></li>
-->
    </ul>
	  <?php 
	  }
	  ?>
  </div>
</nav>
