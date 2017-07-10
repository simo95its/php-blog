<?php
ob_start();
session_start();

define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','blog');

$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

date_default_timezone_set('Europe/Rome');

spl_autoload_register(function ($class) {
   $class = strtolower($class);
   $classpath = 'classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
   }
   $classpath = '../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
   }
   $classpath = '../../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
   }
});

$pages = [
  'cover' => '?page=cover',
  'blog' => '?page=blog',
  'about' => '?page=about',
  'contact' => '?page=contact',
  'admin' => '/blog/admin/',
  'admin_index' => '/blog/admin/index.php',
  'login' => '/blog/admin/login.php',
  'add_post' => '/blog/admin/add-post.php',
  'add_category' => '/blog/admin/add_category.php',
  'add_user' => 'add-user.php',
  'edit_post' => '/blog/admin/edit-post.php',
  'edit_category' => '/blog/admin/edit_category.php',
  'edit_user' => 'blog/admin/edit-user.php',
  'categories' => '/blog/admin/categories.php',
  'users' => '/blog/admin/users.php'
];

$navbar_label = [
  'blog' => 'Posts',
  'about' => 'About',
  'contact' => 'Contact'
];

$cover_logo = './img/ml-logo.png';
$blog_subtitle = 'Make your code smarter.';
$cover_text = 'This is the right place.';
$cover_button_text = 'View Posts';
$post_per_page = '10';

$author = 'Simone Fuoco';
$role = 'Back-End Developer<br>Machine Learning Specialist';
$school = 'ITS-ICT Piemonte';

$user = new User($db);

$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
