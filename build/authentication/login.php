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
  <section class="flex min-h-screen flex-col justify-between gap-12 bg-white p-8 max-xs:p-4 lg:w-1/2">
    <a href="../main.php">
      <img src="../imgs/logo.jpg" alt="" class="w-20 cursor-pointer" />
    </a>
    <div class="px-5 sm:px-16 max-xs:px-2">
      <h1 class="mb-5  text-grey-900 max-md:text-center max-md:text-3xl font-bold text-logo">
        Login and Reconnect with Your Automotive World!
      </h1>
      <form action="verifyUser.php" method="post" id="login_form">
        <label class="w-1/2 font-semibold text-grey-700 max-sm:w-full">
          Email
          <input class="mb-5 focus:outline-none w-full rounded-xl  mt-3  outline-transparent placeholder:text-nobleDark300 bg-grey-100 p-3 font-semibold text-grey-700" type="email" placeholder="Email" name="email" <?php if (isset($_SESSION['email'])) : ?> value="<?= $_SESSION['email'] ?>" <?php endif; ?> required />
        </label>
        <label class=" text-grey-700 font-semibold -sm:w-full">
          Password
          <div class="relative">
            <input class="outline-transparent focus:outline-none  mt-3 w-full rounded-xl  bg-grey-100 p-3 font-semibold text-grey-700" type="password" placeholder="Password" name="password" required />
            <i class="fa-solid fa-eye eye-icon showPasswordIcon" id="show_password"></i>
          </div>
        </label>

        <div class="my-12 flex items-center justify-between">
          <div class="flex items-center gap-3 relative">

            <input type="checkbox" name="rememberMe" id="activeRememberMe" class="absolute h-6 w-6 opacity-0 cursor-pointer">
            <div class="grid place-content-center h-6 w-6  rounded-md border-2 border-border-color bg-white text-transparent" id="rememberMe">
              <i class="fa-solid fa-check"></i>
            </div>
            <span class="text-grey-600 font-bold max-xs:text-sm">Remember me</span>
          </div>

          <a class="text-grey-500 font-semibold max-xs:text-sm" href="#" id="forgot_password">Forgot password?</a>
        </div>
        <input type="submit" name="login" value="Login" class="cursor-pointer text-l w-full rounded-2xl bg-primary-500 py-3 font-bold transition text-white hover:bg-grey-900 ">
      </form>
      <?php
      if (isset($_SESSION['error_msg'])) : ?>
        <div class=" text-red-300 text-center mt-5 font-bold"><?= $_SESSION['error_msg'] ?></div>
      <?php endif; ?>
      <div class="my-12 flex items-center justify-center gap-4">
        <span class="h-[1px] w-full flex-1 bg-grey-500"></span>
        <span class="text-grey-500">or continue with</span>
        <span class="h-[1px] w-full flex-1 bg-grey-500"></span>
      </div>
      <div class="flex justify-between gap-6 max-xs:flex-col md:flex-col xl:flex-row">
        <a href="https://accounts.google.com/" class="flex w-1/2 cursor-pointer items-center justify-center gap-3 rounded-xl hover:bg-grey-900 hover:text-white py-3 text-grey-600 transition-colors duration-500 bg-white  max-xs:w-full md:w-full xl:w-1/2 shadow-shadow-1">
          <img src="../imgs/Google Logo.svg" alt="" />
          <span class="font-semibold">Google Account</span>
        </a>
        <a href="https://appleid.apple.com/account/home" class="flex w-1/2 cursor-pointer items-center justify-center gap-3 rounded-xl hover:bg-white hover:text-grey-600 py-3 text-white transition-colors duration-500 bg-grey-900 max-xs:w-full md:w-full xl:w-1/2 shadow-shadow-1">
          <!-- <img src="../imgs/Apple Logo.svg" alt="" /> -->
          <i class="fa-brands fa-apple text-[25px]"></i>
          <span class="font-semibold">Apple Account</span>
        </a>
      </div>
    </div>
    <div>
      <span class="mr-2 font-semibold text-grey-500">Don't have an account?</span>
      <a class="text-grey-700 font-bold text-lg " href="signUp.php">Sign up</a>
    </div>
  </section>
  <section class="w-1/2   bg-login bg-cover bg-center transition-all duration-1000 max-md:hidden" id="illustration"></section>
  <div class=" absolute inset-0 max-md:rounded-none   h-full w-full opacity-0 -z-10 top-1/2  rounded-xl left-1/2 -translate-x-1/2 -translate-y-1/2 bg-[#0004] backdrop-blur-[1px] grid place-content-center transition-opacity duration-300" id="forgot_password_modal">
    <div class="bg-white  p-5 w-[400px]  max-sm:w-full h-[200px] rounded-xl flex flex-col justify-between">
      <h2 class="font-bold text-grey-700 text-xl pb-4 border-b-2 border-border-color">Forgot Password ?</h2>
      <p class="text-grey-500 font-bold text flex-1 mt-6">Relax and try to remember your password.</p>
      <button class="bg-red-300 py-2 px-4 self-end text-white font-bold rounded-xl cursor-pointer hover:opacity-80 transition-opacity">Thanks</button>

    </div>
  </div>
</body>

</html>
<?php
session_unset();
?>