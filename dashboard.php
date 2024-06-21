<?php
  include 'DB_conect.php';
  include 'components/session.php';
  include 'components/authenticate.php';
  include 'DB_close.php';



?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="stlye.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php
      include 'components/nav.php';
    ?>





    <?php
      include 'components/footer.php';
    ?>
  </body>
</html>
