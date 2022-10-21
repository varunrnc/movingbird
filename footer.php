
<footer class="bg-dark text-white py-2 my-1">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<?php
				include('config.php');
				
				$sqlf = "SELECT * FROM settings";
				$resultf = $conn->query($sqlf) or die("Query Failed " . $conn->error);
				if($resultf->num_rows > 0) {
					while($rowf = $resultf->fetch_assoc()) {
						
				?>
				<span><?php echo $rowf['footerdesc']; ?></span>
				
				<?php
				
					}
				}
				?>
			</div>
		</div>
	</div>
</footer>	



	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="../js/script.js"></script>
</body>
</html>