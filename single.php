<?php
include('header.php');
include('config.php');
?>
	<!--	================== Main ================= -->
	
	<main>
		<div class="container py-4">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-12">
					<div class="post-container">
						<?php
						$post_id = $_GET['id'];
						
						$sql = "SELECT posts.post_id, posts.title, posts.description, posts.post_date, posts.author,
                        category.category_name, users.username, posts.category, posts.post_img FROM posts
                        LEFT JOIN category ON posts.category = category.category_id
                        LEFT JOIN users ON posts.author = users.user_id
                        WHERE posts.post_id = {$post_id}";
						$result = $conn->query($sql) or die("Query Failed " . $conn->error);
						
						if($result->num_rows > 0){
							while($row = $result->fetch_assoc()) {
								
						
						?>
						<div class="post-content p-4 my-3">
							<h3><a href="single.php?id=<?php echo $row['post_id']; ?>"><?php echo $row['title']; ?></a></h3>
							<div class="post-information py-2">
								<span><a href="author.php?aid=<?php echo $row['author']; ?>"><?php echo $row['username']; ?></a></span>
								<span><?php echo $row['post_date']; ?></span>
								<span><a href="category.php?cid=<?php echo $row['category']; ?>"><?php echo $row['category_name']; ?></a></span>

							</div>
							
							<div class="post-img-container">
								<img src="./admin/upload/<?php echo $row['post_img']; ?>" alt="post 01" class="img-fluid">
							</div><br>
							<p><?php echo $row['description']; ?></p>
						</div>
						<?php
						
							}
						}
						?>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-12">
					<?php 
					include('sidebar.php');
					?>
				</div>
			</div>
		</div>
	</main>
	
	
	

<?php 
include('footer.php');
?>