<div class="container">

  <div class=" jumbotron no-padding">
    <div class="blog-header text-image-color-shadow-cover">
      <img src="<?php echo $cover_logo; ?>" alt="">
      <p class="lead blog-description"><?php echo $blog_subtitle; ?></p>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-8 blog-main">
      <?php
        if (isset($_GET['postID'])) {
          include 'single-post.php';
        }
        elseif (isset($_GET['catID'])) {
          include 'post-category.php';
        }
        elseif (isset($_GET['month']) && isset($_GET['year'])) {
          include 'archives.php';
        }
        elseif(isset($_GET['search'])) {
          include 'result-search.php';
        }
        else {
          include 'posts.php';
        }
      ?>

    </div>

    <?php include 'sidebar.php'; ?>

  </div>

</div>

<?php include 'footer.php'; ?>
