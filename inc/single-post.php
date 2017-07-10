<?php
    try {
      $postID = isset($_GET['postID']) ? $_GET['postID'] : "";
      if($postID != "") {
        $stmt = $db->query("SELECT postTitle, postDesc, postCont, postDate FROM blog_posts WHERE postID=$postID");
      }

      $row = $stmt->fetch();
      echo '<div class="blog-post">';
        echo '<h2 class="blog-post-title">'.$row['postTitle'].'</h2>';
        echo '<p class="blog-post-meta">Posted on '.date('F j, Y', strtotime($row['postDate'])).'</p>';
        echo '<hr>';
        echo $row['postDesc'];
        echo '<hr>';
        echo $row['postCont'];
      echo '</div>';

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>
