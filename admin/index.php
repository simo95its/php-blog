<?php
require_once('../inc/config.php');

/*==============================================================================
 * REDIRECT TO LOGIN PAGE IF USER IS NOT LOGGED IN
 *============================================================================*/
if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['delpost'])){

	$stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID') ;
	$stmt->execute(array(':postID' => $_GET['delpost']));

	//delete post categories.
	$stmt = $db->prepare('DELETE FROM blog_post_cats WHERE postID = :postID');
	$stmt->execute(array(':postID' => $_GET['delpost']));

	header('Location: index.php?action=deleted');
	exit;
}

?>
<!DOCTYPE html>
<html lang="it-IT">
	<?php include 'head.php'; ?>
	<body>
		<div id="wrapper">
			<?php include('menu.php');?>
			<?php
			//show message from add / edit page
			if(isset($_GET['action'])){
				echo '<h3>Post '.$_GET['action'].'.</h3>';
			}
			?>
			<table>
				<tr>
					<th>Title</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
				<?php
				try {
					$stmt = $db->query('SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID DESC');
					while($row = $stmt->fetch()){
						echo '<tr>';
						echo '<td>'.$row['postTitle'].'</td>';
						echo '<td>'.date('jS M Y', strtotime($row['postDate'])).'</td>';
				?>
						<td>
							<a href="edit-post.php?id=<?php echo $row['postID'];?>">Edit</a> |
							<a href="javascript:delpost('<?php echo $row['postID'];?>','<?php echo $row['postTitle'];?>')">Delete</a>
						</td>
						<?php
						echo '</tr>';
					}
				} catch(PDOException $e) {
					echo $e->getMessage();
				}
				?>
			</table>
			<p><a href='add-post.php'>Add Post</a></p>
		</div>
	</body>
</html>
