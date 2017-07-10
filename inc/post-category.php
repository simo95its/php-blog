<?php

$stmt = $db->prepare('SELECT catID,catTitle FROM blog_cats WHERE catID = :catID');
$stmt->execute(array(':catID' => $_GET['catID']));
$row = $stmt->fetch();

if($row['catID'] == ''){
	header('Location: ./');
	exit;
}

echo '<h1 class="label-search"><span class="label label-primary">'.$row['catTitle'].'</span></h1><hr>';

try {
	$paginator = new Paginator($post_per_page,'p');
	$stmt = $db->prepare('SELECT blog_posts.postID FROM blog_posts, blog_post_cats WHERE blog_posts.postID = blog_post_cats.postID AND blog_post_cats.catID = :catID');
	$stmt->execute(array(':catID' => $row['catID']));
	$paginator->set_total($stmt->rowCount());
	$stmt = $db->prepare('
		SELECT
			blog_posts.postID, blog_posts.postTitle, blog_posts.postDesc, blog_posts.postDate
		FROM
			blog_posts,
			blog_post_cats
		WHERE
			 blog_posts.postID = blog_post_cats.postID
			 AND blog_post_cats.catID = :catID
		ORDER BY
			postID DESC
		'.$paginator->get_limit());
	$stmt->execute(array(':catID' => $row['catID']));
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
	echo $paginator->page_links($pages['blog'].'&'.'catID='.$_GET['catID'].'&');
} catch(PDOException $e) {
    echo $e->getMessage();
}
?>
