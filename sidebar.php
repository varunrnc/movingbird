<?php
include('config.php');

?>

<div class="sidebar">
  <!--	Search Box -->
  <div class="search-box-container">
    <form class="search-post" action="search.php" method="GET">
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button type="submit" class="btn btn-danger">Search</button>
        </span>
      </div>
    </form>
  </div>

  <!--	Recent Post -->

  <div class="recent-post-container my-2">
    <h4 class="p-3">Recent Post</h4>
    <?php
    $limit = 3;

    $sql = "SELECT posts.post_id, posts.title, posts.description, posts.post_date, posts.author, 
                        category.category_name, users.username, posts.category, posts.post_img FROM posts
                        LEFT JOIN category ON posts.category = category.category_id
                        LEFT JOIN users ON posts.author = users.user_id
                        ORDER BY posts.post_id DESC LIMIT {$limit}";

    $result = $conn->query($sql) or die("Query Failed : " . $conn->error);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {

    ?>
        <div class="recent-post d-flex my-2"> 
          <div class="p-1 d-flex justify-content-center" style="width: 60%;">
          <a href="single.php?id=<?php echo $row['post_id']; ?>" class="post-img p-3">
           <img src="./admin/upload/<?php echo $row['post_img']; ?>" alt="" class="img-fluid">
          </a>
          </div>
          <div class="post-content p-3">
            <h5><a href="single.php?id=<?php echo $row['post_id']; ?>"><?php echo substr($row['title'],0,30) . "..."; ?></a></h5>
            <span><a href="author.php?aid=<?php echo $row['author']; ?>"><?php echo $row['username']; ?></a>&nbsp;|&nbsp;</span>
            <span><a href="category.php?cid=<?php echo $row['category']; ?>"><?php echo $row['category_name']; ?></a></span> <span><?php echo $row['post_date']; ?></span> <br><a href="single.php?id=<?php echo $row['post_id']; ?>">Read</a>
          </div>
        </div>
    <?php
      }
    }
    ?>
  </div>

  <!--	Category -->

  <div class="category-container">
    <div class="category-list">
      <h4 class="p-3">Category</h4>
      <ul class="p-3">
        <?php
        $sqlc = "SELECT * FROM category";
        $resultc = $conn->query($sqlc) or die("Query Faield " . $conn->error);
        if ($resultc->num_rows > 0) {
          while ($rowc = $resultc->fetch_assoc()) {

        ?>
            <li><a href="category.php?cid=<?php echo $rowc['category_id']; ?>"><?php echo $rowc['category_name']; ?></a></li>
        <?php

          }
        }
        ?>
      </ul>
    </div>
  </div>
</div>