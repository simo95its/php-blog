<div class="col-sm-3 col-sm-offset-1 blog-sidebar">

  <div class="sidebar-module">
    <h3>Search</h3>
    <hr>
    <form method="get" class="form-inline" action="./inc/search.php">
      <div class="form-group">
        <input type="text" name="search" class="form-control" id="exampleInputName2" placeholder="Search">
      </div>
    </form>
  </div>

  <?php include 'profile-card.php'; ?>

  <div class="sidebar-module">
    <h3>Recent Posts</h3>
    <hr>
    <ol class="list-unstyled">
      <?php
      $stmt = $db->query('SELECT postTitle, postID FROM blog_posts ORDER BY postID DESC LIMIT 5');
      while($row = $stmt->fetch()){
      	echo '<li><a href="'.$pages['blog'].'&'.'postID='.$row['postID'].'">'.$row['postTitle'].'</a></li>';
      }
      ?>
    </ol>
  </div>

  <div class="sidebar-module">
    <h3>Categories</h3>
    <hr>
    <!--<ol class="list-unstyled">-->
      <?php

      $color_label = ['default', 'primary', 'success', 'info', 'warning', 'danger'];
      $stmt = $db->query('SELECT catTitle, catID FROM blog_cats ORDER BY catID DESC');
      while($row = $stmt->fetch()){
      	echo '<a class="category-label" href="'.$pages['blog'].'&'.'catID='.$row['catID'].'">'.'<span class="label label-'.$color_label[rand(0,5)].'">'.$row['catTitle'].'</span>'.'</a>';
      }
      ?>
    <!--</ol>-->
  </div>

  <div class="sidebar-module">
    <h3>Archives</h3>
    <hr>
    <ol class="list-unstyled">
      <?php
      $stmt = $db->query("SELECT Month(postDate) as Month, Year(postDate) as Year FROM blog_posts GROUP BY Month(postDate), Year(postDate) ORDER BY postDate DESC");
      while($row = $stmt->fetch()){
      	$monthName = date("F", mktime(0, 0, 0, $row['Month'], 10));
        $year = $row['Year'];
      	echo "<li><a href='".$pages['blog']."&"."month=".$monthName."&"."year=".$year."'>$monthName $year</a></li>";
      }
      ?>
    </ol>
  </div>
