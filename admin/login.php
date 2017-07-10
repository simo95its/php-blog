<?php
require_once('../inc/config.php');

/*==============================================================================
 * CHECK IF USER IS LOGGED IN OR NOT
 *============================================================================*/
if( $user->is_logged_in() ){ header('Location: index.php'); }
?>

<!DOCTYPE html>
<html lang="it-IT">
  <?php include 'head.php'; ?>
  <body>
    <div id="login">
    	<?php
    	/*========================================================================
       * LOGIN FORM SUBMIT
       *======================================================================*/
    	if(isset($_POST['submit'])){
    		$username = trim($_POST['username']);
    		$password = trim($_POST['password']);
    		if($user->login($username,$password)){
    			/*====================================================================
           * REDIRECT AFTER LOGIN SUCCESS
           *==================================================================*/
    			header('Location: index.php');
    			exit;
    		} else {
    			$message = '<p class="error">Wrong username or password</p>';
    		}
    	}
    	if(isset($message)){ echo $message; }
    	?>
    	<form method="post">
      	<p><label>Username</label><input type="text" name="username" value=""></p>
      	<p><label>Password</label><input type="password" name="password" value=""></p>
      	<p><label></label><input type="submit" name="submit" value="Login"></p>
    	</form>
    </div>
  </body>
</html>
