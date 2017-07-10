<div class="background-image"></div>
<div class="site-wrapper content text-image-color-shadow-cover">
  <div class="site-wrapper-inner">
    <div class="cover-container">
      <div class="masthead clearfix">
        <div class="inner">
          <?php include './inc/navbar.php'; ?>
        </div>
      </div>
      <div class="inner cover">
        <img src="<?php echo $cover_logo; ?>" alt="">
        <h1 class="cover-heading"><?php echo $blog_subtitle; ?></h1>
        <p class="lead"><?php echo $cover_text; ?></p>
        <p class="lead">
          <a href="<?php echo $pages['blog']; ?>" class="btn btn-lg btn-default"><?php echo $cover_button_text; ?></a>
        </p>
      </div>
      <?php include './inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
