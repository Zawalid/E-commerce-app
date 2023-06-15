<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="../css/all.min.css" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <script defer src="../js/authentication.js"></script>
</head>

<body class="flex min-h-screen flex-col bg-nobleDark700 font-Jakarta md:flex-row relative">
  <section class="flex min-h-screen flex-col justify-between gap-12 bg-nobleDark700 p-8 max-xs:p-4 lg:w-1/2">
    <a href="../main.php">
      <img src="../imgs/Logo.svg" alt="" class="w-7 cursor-pointer" />
    </a>
    <div class="px-5 sm:px-16 max-xs:px-2">
      <h1 class="mb-5 text-4xl text-white max-md:text-center max-md:text-3xl">
        Let's get
        <span class="bg-gradient-to-br from-DayBlue via-Blue to-Green500 bg-clip-text font-bold text-transparent">creative!</span>
      </h1>
      <p class="mb-12 text-nobleDark300 max-md:text-center">
        Log in to Artificium to start creating magic.
      </p>
      <form action="verifyUser.php" method="post">
        <label class="w-1/2 text-nobleDark300 max-sm:w-full">
          Email
          <input class="mb-5 focus-visible:shadow-activeInput focus:outline-none w-full rounded-xl border border-nobleDark500 mt-3 bg-nobleDark600 p-3 text-white outline-transparent placeholder:text-nobleDark300" type="email" placeholder="Email" required name="email" <?php if (isset($_SESSION['email'])) : ?> value="<?= $_SESSION['email'] ?>" <?php endif; ?> />
        </label>
        <label class=" text-nobleDark300 max-sm:w-full">
          Password
          <div class="relative">
            <input class="focus:outline-none focus-visible:shadow-activeInput mt-3 w-full rounded-xl border border-nobleDark500 bg-nobleDark600 p-3 text-white outline-transparent placeholder:text-nobleDark300" type="password" required placeholder="Password" name="password" />
            <i class="fa-solid fa-eye eye-icon showPasswordIcon" id="show_password"></i>
          </div>
        </label>

        <div class="my-12 flex items-center justify-between">
          <div class="flex items-center gap-3 relative">

            <input type="checkbox" name="rememberMe" id="activeRememberMe" class="absolute h-6 w-6 opacity-0 cursor-pointer">

            <div class="h-6 w-6  rounded-lg border border-nobleDark500 bg-nobleDark600 text-transparent" id="rememberMe">
              <i class="fa-solid fa-check"></i>
            </div>
            <span class="text-nobleDark200 max-xs:text-sm">Remember me</span>
          </div>
          <a class="bg-gradient-to-br from-Blue to-Green500 bg-clip-text font-semibold text-transparent max-xs:text-sm" href="#" id="forgot_password">Forgot password?</a>
        </div>
        <input type="submit" name="login" value="Login" class="cursor-pointer text-l w-full rounded-2xl bg-stemGreen500 py-3 font-bold transition hover:bg-stemGreen400 focus:bg-stemGreen300">
      </form>
      <?php
      if (isset($_SESSION['error_msg'])) : ?>
        <div class="text-xl text-white text-center mt-5 font-bold"><?= $_SESSION['error_msg'] ?></div>
      <?php endif; ?>
      <div class="my-12 flex items-center justify-center gap-4">
        <span class="h-[1px] w-full flex-1 bg-nobleDark400"></span>
        <span class="text-nobleDark400">or continue with</span>
        <span class="h-[1px] w-full flex-1 bg-nobleDark400"></span>
      </div>
      <div class="flex justify-between gap-6 max-xs:flex-col md:flex-col xl:flex-row">
        <a href="https://accounts.google.com/" class="flex w-1/2 cursor-pointer items-center justify-center gap-3 rounded-xl bg-nobleDark600 py-3 text-nobleDark400 transition-colors duration-500 hover:bg-nobleDark500 focus:bg-nobleDark400 focus:text-nobleDark200 max-xs:w-full md:w-full xl:w-1/2">
          <img src="../imgs/Google Logo.svg" alt="" />
          <span class="font-semibold">Google Account</span>
        </a>
        <a href="https://appleid.apple.com/account/home" class="flex w-1/2 cursor-pointer items-center justify-center gap-3 rounded-xl bg-nobleDark600 py-3 text-nobleDark400 transition-colors duration-500 hover:bg-nobleDark500 focus:bg-nobleDark400 focus:text-nobleDark200 max-xs:w-full md:w-full xl:w-1/2">
          <img src="../imgs/Apple Logo.svg" alt="" />
          <span class="font-semibold">Apple Account</span>
        </a>
      </div>
    </div>
    <div>
      <span class="mr-2 font-semibold text-nobleDark400">Don't have an account?</span>
      <a class="bg-gradient-to-br from-Blue to-Green500 bg-clip-text font-semibold text-transparent" href="signUp.php">Sign up</a>
    </div>
  </section>
  <section class="w-1/2 rounded-bl-[30px] rounded-tl-[30px] bg-abstract-4 bg-cover bg-center transition-all duration-1000 max-md:hidden" id="illustration"></section>
  <div class=" absolute inset-0 max-md:rounded-none   h-full w-full opacity-0 -z-10 top-1/2  rounded-xl left-1/2 -translate-x-1/2 -translate-y-1/2 bg-[#0004] backdrop-blur-[1px] grid place-content-center transition-opacity duration-300" id="forgot_password_modal">
    <div class="bg-white  p-5 w-[400px]  max-sm:w-full h-[200px] rounded-xl flex flex-col justify-between">
      <h2 class="font-bold text-grey-700 text-xl pb-4 border-b-2 border-border-color">Forgot Password ?</h2>
      <p class="text-grey-500 font-bold text-sm flex-1 mt-6">Relax and try to remember your password.</p>
      <button class="bg-red-300 py-2 px-4 self-end text-white font-bold rounded-xl cursor-pointer hover:opacity-80 transition-opacity">Thanks</button>

    </div>
  </div>
</body>

</html>
<?php
session_unset();
?>