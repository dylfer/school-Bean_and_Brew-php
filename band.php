<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Band</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="h-screen">
    <p class="text-red-700 w-screen flex h-1/2 justify-center items-center">

        your ip has been band. duration: <?= htmlspecialchars($_GET["duration"]);?>. reason: <?= htmlspecialchars($_GET["reason"]);?>
    </p>
    <script src="script.js"></script>
  </body>
</html>
