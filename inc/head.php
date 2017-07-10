<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Machine Learning Blog">
  <meta name="author" content="Simone Fuoco">

  <title>Machine Learning Blog</title>
  <link rel="icon" href="./favicon.ico">

  <!-- Bootstrap core CSS -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
  crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="./css/nav.css" rel="stylesheet">

  <!-- Add icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php switch($page): ?>
<?php case 'blog': ?>
  <!-- Custom styles for this template -->
  <link href="./css/blog.css" rel="stylesheet">
  <link href="./css/myblog.css" rel="stylesheet">

  <!-- PROFILE CARD -->
  <link rel="stylesheet" href="./css/profile-card.css">
<?php break; ?>
<?php default: ?>
  <!-- Custom styles for this template -->
  <link href="./css/cover.css" rel="stylesheet">
  <link href="./css/mycover.css" rel="stylesheet">
<?php break; ?>
<?php endswitch; ?>



</head>
