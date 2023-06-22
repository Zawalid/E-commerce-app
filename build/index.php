<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Loading...</title>
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body class="grid h-screen place-content-center text-center">
  <div id="animation-container" class="w-44 h-44"></div>
  <h2 class="text-logo uppercase text-primary-500">Wheelz</h2>

  <script src="../node_modules/lottie-web/build/player/lottie.js" type="module"></script>
  <script src="js/loading.js" type="module"></script>
  <script>
    setTimeout(function() {
      <?php
      if (isset($_COOKIE['remember_token'])) {
        echo 'window.location.href =  " authentication/verifyUser.php" ';
      } else {
        echo 'window.location.href =  " main.php" ';
      }
      ?>
    }, 3000);
  </script>

</body>

</html>