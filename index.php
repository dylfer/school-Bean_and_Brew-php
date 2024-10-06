<?php
  include 'components/session.php';
  include 'components/DB_close.php';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>

    <link href="stlye.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <?php
      include 'components/nav.php';
      ?>
      <div class="text-2xl flex flex-col items-center justify-center w-screen h-screen">
        <h1 class="text-center">Welcome to Bean and Brew</h1>
        <p class="text-center">The best coffee shop in town</p>
    </div>
      <?php
      include 'components/footer.php';
      ?>
    <script src="script.js"></script>
  </body>
</html>
