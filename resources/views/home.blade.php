<html>
  <head>
  </head>
  <body>
    <h1><center>Selamat Datang</center></h1>
    @<?php foreach ($blog as $blog1): ?>
      <li>{{ $blog->title }}</li>
    <?php endforeach; ?>
  </body>
</html>
