<?php
	try {

		//collect month and year data
		$month = $_GET['month'];
		$year = $_GET['year'];

    echo '<h1 class="label-search"><span class="label label-primary">'.$month.' '.$year.'</span></h1><hr>';

		//set from and to dates
		$from = date('Y-m-01 00:00:00', strtotime("$year-$month"));
		$to = date('Y-m-31 23:59:59', strtotime("$year-$month"));


		$paginator = new Paginator($post_per_page,'p');

		$stmt = $db->prepare('SELECT postID FROM blog_posts WHERE postDate >= :from AND postDate <= :to');
		$stmt->execute(array(
			':from' => $from,
			':to' => $to
	 	));

		//pass number of records to
		$paginator->set_total($stmt->rowCount());

		$stmt = $db->prepare('SELECT postID, postTitle, postDesc, postDate FROM blog_posts WHERE postDate >= :from AND postDate <= :to ORDER BY postID DESC '.$paginator->get_limit());
		$stmt->execute(array(
			':from' => $from,
			':to' => $to
	 	));
		while($row = $stmt->fetch()){
      echo '<div class="blog-post">';
        echo '<h2 class="blog-post-title">'.$row['postTitle'].'</h2>';
        echo '<p class="blog-post-meta">Posted on '.date('F j, Y', strtotime($row['postDate'])).' in ';
					$stmt2 = $db->prepare('SELECT catTitle, blog_cats.catID	FROM blog_cats, blog_post_cats WHERE blog_cats.catID = blog_post_cats.catID AND blog_post_cats.postID = :postID');
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

		echo $paginator->page_links($pages['blog'].'&'.'month='.$_GET['month'].'&'.'year='.$_GET['year'].'&');

	} catch(PDOException $e) {
	    echo $e->getMessage();
	}
?>
