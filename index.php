<?php include './inc/config.php'; ?>
<!DOCTYPE html>
<html lang="it-IT">
  <?php include './inc/head.php'; ?>
  <body>
    <?php
    switch($page) {
      case 'blog':
        include './inc/navbar.php';
        include './inc/blog.php';
        break;
      case 'about':
      case 'contact':
        //include './inc/navbar.php';
        include './comingsoon/comingsoon.php';
        break;
      case 'cover':
      default:
        include './inc/cover.php';
        break;
    }
    ?>
    <?php include './inc/js-script.php'; ?>
  </body>
</html>
