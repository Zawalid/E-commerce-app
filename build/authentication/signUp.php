<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link rel="stylesheet" href="../css/all.min.css" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <script defer src="../js/authentication.js"></script>
</head>

<body class="flex min-h-screen flex-col bg-nobleDark700 font-Jakarta md:flex-row">
  <section class="flex min-h-screen flex-col justify-between gap-12 bg-nobleDark700 p-8 lg:w-4/5">
    <div class="flex items-center justify-between">
      <a href="../main.php">
        <img src="../imgs/Logo.svg" alt="" class="w-7 cursor-pointer" />
      </a>
      <a class="bg-gradient-to-br from-Blue to-Green500 bg-clip-text font-semibold text-transparent" href="login.php">Login</a>
    </div>
    <div class="px-5 sm:px-16">
      <h1 class="mb-12 text-4xl text-white max-md:text-center max-md:text-3xl">
        Connect with your team and bring your creative ideas to life.
      </h1>
      <form action="signupValidation.php" method="post">
        <div class="mb-7 flex gap-5 max-sm:flex-col">
          <label class="w-1/2 text-nobleDark300 max-sm:w-full">
            First name
            <input class="focus:outline-none focus-visible:shadow-activeInput mt-3 w-full rounded-xl border border-nobleDark500 bg-nobleDark600 p-3 text-white outline-transparent placeholder:text-nobleDark300" type="text" required placeholder="First name" name="firstName" <?php if (isset($_SESSION['firstName'])) : ?> value="<?= $_SESSION['firstName'] ?>" <?php endif; ?> />
          </label>
          <label class="w-1/2 text-nobleDark300 max-sm:w-full">
            Last name
            <input class="focus:outline-none focus-visible:shadow-activeInput mt-3 w-full rounded-xl border border-nobleDark500 bg-nobleDark600 p-3 text-white placeholder:text-nobleDark300" type="text" required placeholder="Last name" name="lastName" <?php if (isset($_SESSION['lastName'])) : ?> value="<?= $_SESSION['lastName'] ?>" <?php endif; ?> />
          </label>
        </div>
        <label class="block text-nobleDark300 max-sm:w-full mb-7 ">
          Email
          <input class="mt-3 focus:outline-none focus-visible:shadow-activeInput w-full rounded-xl border border-nobleDark500 bg-nobleDark600 p-3 text-white outline-transparent placeholder:text-nobleDark300" type="email" required placeholder="Email" name="email" <?php if (isset($_SESSION['email'])) : ?> value="<?= $_SESSION['email'] ?>" <?php endif; ?> />
        </label>
        <div class="flex gap-5 max-sm:flex-col">
          <label class="w-1/2 text-nobleDark300 max-sm:w-full">
            Password
            <div class="relative">

              <input class="focus:outline-none focus-visible:shadow-activeInput mt-3 w-full rounded-xl border border-nobleDark500 bg-nobleDark600 p-3 text-white outline-transparent placeholder:text-nobleDark300" type="password" required placeholder="Password" name="password" />
              <i class="fa-solid fa-eye eye-icon showPasswordIcon" id="show_password"></i>
            </div>
          </label>
          <label class="w-1/2 text-nobleDark300 max-sm:w-full">
            Repeat password
            <div class="relative">

              <input class="focus:outline-none focus-visible:shadow-activeInput mt-3 w-full rounded-xl border border-nobleDark500 bg-nobleDark600 p-3 text-white placeholder:text-nobleDark300" type="password" placeholder=" Repeat password" name="repeatPassword" />
              <i class="fa-solid fa-eye eye-icon showPasswordIcon" id="show_password"></i>
            </div>
          </label>
        </div>
        <div class="my-12 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="h-6 w-6 cursor-pointer rounded-lg border border-nobleDark500 bg-nobleDark600 text-transparent" id="rememberMe">
              <i class="fa-solid fa-check"></i>
            </div>
            <span class="text-nobleDark200 max-xs:text-xs">I agree with Terms and conditions</span>
          </div>
        </div>
        <input type="submit" name="create" value=" Create free account" href="#" class="cursor-pointer text-l block w-full rounded-2xl bg-stemGreen500 py-3 text-center font-bold transition hover:bg-stemGreen400 focus:bg-stemGreen300">

        />
      </form>
      <?php
      if (isset($_SESSION['error_msg'])) : ?>
        <div class="text-xl text-white text-center mt-5 font-bold"><?= $_SESSION['error_msg'] ?></div>
      <?php endif; ?>
    </div>
    <div class="flex justify-between">
      <span class="text-sm font-medium text-nobleDark300">Artificium.app © 2023</span>
      <span class="text-sm font-medium text-nobleDark300" href="#">Privacy Policy</span>
    </div>
  </section>
  <section class="w-1/2 rounded-bl-[30px] rounded-tl-[30px] bg-abstract-2 bg-cover bg-center transition-all duration-1000 max-md:hidden" id="illustration"></section>

  <!-- <script src="./js/all.min.js"></script> -->
</body>

</html>
<?php
session_unset();
?>