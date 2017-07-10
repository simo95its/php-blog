<head>
  <meta charset="utf-8">
  <title>Admin Login</title>
  <link rel="stylesheet" href="./style/normalize.css">
  <link rel="stylesheet" href="./style/main.css">
  <?php if($_SERVER['REQUEST_URI'] == $pages['admin'] || $_SERVER['REQUEST_URI'] == $pages['admin_index']): ?>
    <script language="JavaScript" type="text/javascript">
    function delpost(id, title)
    {
      if (confirm("Are you sure you want to delete '" + title + "'"))
      {
        window.location.href = 'index.php?delpost=' + id;
      }
    }
    </script>
  <?php elseif($_SERVER['REQUEST_URI'] == $pages['add_post']): ?>
    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
    <script>
            tinymce.init({
                selector: "textarea",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            });
    </script>
  <?php endif; ?>
</head>
