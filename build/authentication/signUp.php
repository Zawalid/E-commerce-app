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
  <section class="flex min-h-screen flex-col justify-between gap-12 bg-white p-8 max-xs:p-4 lg:w-3/5">
    <div class="flex items-center justify-between">
      <img src="../imgs/logo.jpg" alt="" class="w-20" />
      <a class="text-grey-700 font-bold text-lg" href="login.php">Login</a>
    </div>
    <div class="px-5 sm:px-16  max-xs:px-2 ">
      <h1 class="mb-5 text-logo text-grey-900 max-md:text-center max-sm:text-2xl font-bold">
        Begin Your Automotive Journey: Sign Up and Own the Road!
      </h1>
      <form action="signupValidation.php" method="post">
        <div class="mb-7 flex gap-5 max-sm:flex-col">
          <label class="w-1/2 font-semibold text-grey-700 max-sm:w-full">
            First name
            <input class="focus:outline-none w-full rounded-xl  mt-3  outline-transparent placeholder:text-nobleDark300 bg-grey-100 p-3 font-semibold text-grey-700" type="text" required placeholder="First name" name="firstName" <?php if (isset($_SESSION['firstName'])) : ?> value="<?= $_SESSION['firstName'] ?>" <?php endif; ?> />
          </label>
          <label class="w-1/2 font-semibold text-grey-700 max-sm:w-full">
            Last name
            <input class="focus:outline-none w-full rounded-xl  mt-3  outline-transparent placeholder:text-nobleDark300 bg-grey-100 p-3 font-semibold text-grey-700" type="text" required placeholder="Last name" name="lastName" <?php if (isset($_SESSION['lastName'])) : ?> value="<?= $_SESSION['lastName'] ?>" <?php endif; ?> />
          </label>
        </div>
        <label class="block font-semibold text-grey-700 max-sm:w-full mb-7 ">
          Email
          <input class="focus:outline-none w-full rounded-xl  mt-3  outline-transparent placeholder:text-nobleDark300 bg-grey-100 p-3 font-semibold text-grey-700" type="email" required placeholder="Email" name="email" <?php if (isset($_SESSION['email'])) : ?> value="<?= $_SESSION['email'] ?>" <?php endif; ?> />
        </label>
        <div class="flex gap-5 max-sm:flex-col">
          <label class="w-1/2 font-semibold text-grey-700 max-sm:w-full">
            Password
            <div class="relative">

              <input class="peer focus:outline-none w-full rounded-xl  mt-3  outline-transparent placeholder:text-nobleDark300 bg-grey-100 p-3 font-semibold text-grey-700" type="password" required placeholder="Password" name="password" />
              <i class="fa-solid fa-eye eye-icon showPasswordIcon" id="show_password"></i>
              <div class="absolute w-full sm:w-[325px]  rounded-xl shadow-shadow-1 bg-white p-5 -top-[210px] transition-opacity duration-500 opacity-0 -z-10 peer-focus:opacity-100 peer-focus:z-10" id="password_validation">
                <h3 class="font-bold text-grey-700">Password requirements</h3>
                <ul class="mt-3">
                  <li class="text-sm mb-2  text-grey-500"><i id="chars_long_validation" class="fa-regular fa-circle-check mr-3 text-red-300"></i>Should be at least 8 characters</li>
                  <li class="text-sm mb-2  text-grey-500"><i id="uppercase_validation" class="fa-regular fa-circle-check mr-3 text-red-300"></i>Contain at least one uppercase</li>
                  <li class="text-sm mb-2  text-grey-500"><i id="lowercase_validation" class="fa-regular fa-circle-check mr-3 text-red-300"></i>Contain at least one lowercase</li>
                  <li class="text-sm mb-2  text-grey-500"><i id="numbers_validation" class="fa-regular fa-circle-check mr-3 text-red-300"></i>Contain at least one digit</li>
                  <li class="text-sm  text-grey-500"><i id="special_chars_validation" class="fa-regular fa-circle-check mr-3 text-red-300"></i>Contain at least one special character</li>
                </ul>
              </div>
            </div>
          </label>
          <label class="w-1/2 font-semibold text-grey-700 max-sm:w-full">
            Repeat password
            <div class="relative">

              <input class="focus:outline-none w-full rounded-xl  mt-3  outline-transparent placeholder:text-nobleDark300 bg-grey-100 p-3 font-semibold text-grey-700" type="password" required placeholder="Repeat password" name="repeatPassword" />
              <i class="fa-solid fa-eye eye-icon showPasswordIcon" id="show_password"></i>
            </div>
          </label>
        </div>

        <input type="submit" name="create" value=" Create free account" href="#" class="mt-10 cursor-pointer text-l w-full rounded-2xl bg-primary-500 py-3 font-bold transition text-white hover:bg-grey-900 ">
      </form>
      <?php
      if (isset($_SESSION['error_msg'])) : ?>
        <div class=" text-red-300 text-center mt-5 font-bold"><?= $_SESSION['error_msg'] ?></div>
      <?php endif; ?>
    </div>

    <span class="text-sm font-medium text-nobleDark300">Walid.Zakan © 2023</span>

  </section>
  <section class="w-1/2 bg-signup bg-cover bg-center transition-all duration-1000 max-md:hidden" id="signup_image"></section>

</body>

</html>
<?php
session_unset();
?>