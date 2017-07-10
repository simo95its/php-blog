<?php
  include 'config.php';
  if ($_GET['search'] == '') {
    header('Location: '.'../'.$pages['blog'].'&'.'error=null_search');
  }
  else {
    header('Location: '.'../'.$pages['blog'].'&'.'search='.$_GET['search']);
  }

?>
