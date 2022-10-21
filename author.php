<?php
include( 'header.php' );
include( 'config.php' );
?>
<!--	================== Main ================= -->
<main>
  <div class="container py-4">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-12">
        <div class="post-container">
          <div class="post-content p-4 my-3">
            <?php
            if ( isset( $_GET[ 'aid' ] ) ) {
              $auth_id = $_GET[ 'aid' ];

              $sql1 = "SELECT * FROM posts JOIN users
                          ON posts.author = users.user_id
                          WHERE posts.author = {$auth_id}";

              $result1 = $conn->query( $sql1 )or die( "Query Failed " . $conn->error );
				$row1 = $result1->fetch_assoc();
                echo "<h2>Post By {$row1['username']}</h2>";
              
            }
            ?>
          </div>
          <?php
          /* Calculate Offset Code */
          $limit = 3;
          if ( isset( $_GET[ 'page' ] ) ) {
            $page = $_GET[ 'page' ];
          } else {
            $page = 1;
          }
          $offset = ( $page - 1 ) * $limit;

          $sql = "SELECT posts.post_id, posts.title, posts.description, posts.post_date, posts.author,
                  category.category_name, users.username, posts.category, posts.post_img FROM posts
                  LEFT JOIN category ON posts.category = category.category_id
                  LEFT JOIN users ON posts.author = users.user_id
                  WHERE posts.author = {$auth_id}
                  ORDER BY posts.post_id DESC LIMIT {$offset},{$limit}";
          $result = $conn->query( $sql );
          if ( $result->num_rows > 0 ) {
            while ( $row = $result->fetch_assoc() ) {

              ?>
          <div class="post-content p-4 my-3">
            <h3><a href="single.php?id=<?php echo $row['post_id']; ?>"><?php echo $row['title']; ?></a></h3>
            <div class="post-information py-2"> <span><a href="author.php?aid=<?php echo $row['author']; ?>"><?php echo $row['username']; ?></a></span> <span><?php echo $row['post_date']; ?></span> <span><a href="category.php?cid=<?php echo $row['category']; ?>"><?php echo $row['category_name']; ?></a></span> 
              <!--								<span>1 Comment</span>--> 
            </div>
            <div class="row py-2">
              <div class="col-lg-4 col-md-4 col-12"> <img src="./admin/upload/<?php echo $row['post_img']; ?>" alt="post pic" class="img-fluid"> </div>
              <div class="col-lg-8 col-md-8 col-12">
                <p><?php echo substr($row['description'],0,130) . "..."; ?></p>
                <a href="single.php?id=<?php echo $row['post_id']; ?>">
                <button class="btn btn-danger">Read More</button>
                </a> </div>
            </div>
            <div class="social-media-share"> <span>Share this: </span> <span>Facebook</span> <span>Twitter</span> <span>Google+</span> </div>
          </div>
          <?php

          }
          } else {
            echo "<h2>No Record Found.</h2>";
          }


          ?>
          
          <!--	========== Pagination ============ -->
          
          <?php
         
          if ( $result1->num_rows > 0 ) {
            $total_records = $result1->num_rows;
            $total_pages = ceil( $total_records / $limit );

            ?>
          <div class="pagination-section">
            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                <?php
                if ( $page > 1 ) {
                  echo "<li class='page-item'><a class='page-link' href='author.php?aid=".$auth_id."&page=".($page - 1)."'>Previous</a></li>";
                } else {
                  echo "<li class='page-item disabled'><span class='page-link'>Previous</span></li>";
                }

                for ( $i = 1; $i <= $total_pages; $i++ ) {
                  if ( $i == $page ) {
                    $active = "active";
                  } else {
                    $active = "";
                  }
                  echo "<li class='page-item " . $active . "'><a class='page-link' href='author.php?aid=".$auth_id."&page=".$i."'>$i</a></li>";
                }

                if ( $total_pages > $page ) {
                  echo "<li class='page-item'><a class='page-link' href='author.php?aid=".$auth_id."&page=".($page + 1)."'>Next</a></li>";
                } else {
                  echo "<li class='page-item disabled'><a class='page-link' href='#'>Next</a></li>";
                }
                ?>
              </ul>
            </nav>
          </div>
          <?php
          }
          ?>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-12">
        <?php include('sidebar.php'); ?>
      </div>
    </div>
  </div>
</main>
<?php
include( 'footer.php' );
?>