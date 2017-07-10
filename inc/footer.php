<?php switch($page): ?>
<?php case 'blog': ?>
<footer class="blog-footer">
  <p>Developed by <a href=""><?php echo $author; ?></a></p>
  <a class="profile-a-lighter" href="#"><i class="fa fa-twitter"></i></a>
  <a class="profile-a-lighter" href="#"><i class="fa fa-linkedin"></i></a>
  <a class="profile-a-lighter" href="#"><i class="fa fa-facebook"></i></a>
</footer>
<?php break; ?>
<?php case 'cover': ?>
<?php default: ?>
<div class="mastfoot">
  <div class="inner">
    <p class="footer-paragraph">Developed by <a href=""><?php echo $author; ?></a></p>
    <a class="profile-a-lighter" href="#"><i class="fa fa-twitter"></i></a>
    <a class="profile-a-lighter" href="#"><i class="fa fa-linkedin"></i></a>
    <a class="profile-a-lighter" href="#"><i class="fa fa-facebook"></i></a>
  </div>
</div>
<?php break; ?>
<?php endswitch; ?>
