<?php
	try {

    $query_paginator = 'SELECT '
      .'postID '
    .'FROM '
      .'blog_posts '
    .'WHERE ';

    $query_post = 'SELECT '
      .'postID, postTitle, postDesc, postCont, postDate '
    .'FROM '
      .'blog_posts '
    .'WHERE ';

    $search = explode(' ',$_GET['search']);

    for ($i=0; $i < count($search); $i++) {
      echo '<h1 class="label-search" style="display:inline-block;"><span class="label label-primary">'.$search[$i].'</span></h1>';
      $query_paginator .= "postTitle LIKE concat('%', :arg$i, '%') OR postDesc LIKE concat('%', :arg$i, '%') OR postCont LIKE concat('%', :arg$i, '%') ";
      $query_paginator .= ($i != count($search) - 1) ? ' OR ' : '' ;
      $query_post .= "postTitle LIKE concat('%', :arg$i, '%') OR postDesc LIKE concat('%', :arg$i, '%') OR postCont LIKE concat('%', :arg$i, '%') ";
      $query_post .= ($i != count($search) - 1) ? ' OR ' : '' ;
    }
    echo '<hr>';

    $paginator = new Paginator($post_per_page,'p');

    $stmt_paginator = $db->prepare($query_paginator);

    for ($i=0; $i < count($search); $i++) {
      $stmt_paginator->bindParam(":arg$i", $search[$i], PDO::PARAM_STR);
    }

		$stmt_paginator->execute();

		$paginator->set_total($stmt_paginator->rowCount());


		$stmt_post = $db->prepare($query_post.$paginator->get_limit());

    for ($i=0; $i < count($search); $i++) {
      $stmt_post->bindParam(":arg$i", $search[$i], PDO::PARAM_STR);
    }

		$stmt_post->execute();

		while($row = $stmt_post->fetch()){
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

		echo $paginator->page_links($pages['blog'].'&'.'search='.$_GET['search'].'&');

	} catch(PDOException $e) {
	    echo $e->getMessage();
	}
?>
