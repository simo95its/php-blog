<?php if(isset($_GET['error']) && $_GET['error'] == 'null_search'): ?>
<h1 class="label-search"><span class="label label-danger">Error: input form is empty - try again.</span></h1><hr>
<?php else: ?>
<h1 class="label-search"><span class="label label-primary">All posts</span></h1><hr>
<?php endif; ?>
<?php
    try {
      $paginator = new Paginator($post_per_page,'p');
      $stmt = $db->query('SELECT postID FROM blog_posts');
      $paginator->set_total($stmt->rowCount());
      $stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC '.$paginator->get_limit());
      while($row = $stmt->fetch()){
        echo '<div class="blog-post">';
          echo '<h2 class="blog-post-title">'.$row['postTitle'].'</h2>';
          echo '<p class="blog-post-meta">Posted on '.date('F j, Y', strtotime($row['postDate'])).' in ';
					$stmt2 = $db->prepare('SELECT blog_cats.catID, catTitle FROM blog_cats, blog_post_cats WHERE blog_cats.catID = blog_post_cats.catID AND blog_post_cats.postID = :postID');
					$stmt2->execute(array(':postID' => $row['postID']));
					$catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);
					$links = array();
					foreach ($catRow as $cat)
					{
					    $links[] = "<a href='".$pages['blog']."&"."catID=".$cat['catID']."'>".$cat['catTitle']."</a>";
					}
					echo implode(", ", $links);
					echo '</p>';
          echo '<p>'.$row['postDesc'].'</p>';
          echo '<p><a href="'.$pages['blog']."&postID=".$row['postID'].'">Read More</a></p>';
        echo '</div>';
      }
      echo $paginator->page_links($pages['blog'].'&');
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>
