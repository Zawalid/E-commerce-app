<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Car Booking</title>
  <link rel="stylesheet" href="./css/all.min.css" />
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <script defer src="./js/main.js"></script>
</head>

<body class="relative min-h-screen font-Jakarta before:absolute before:-z-20 before:h-full before:w-full before:bg-[rgba(0,0,0,0.5)] before:opacity-0 before:backdrop-blur-sm before:transition-opacity">
  <header>
    <div class="container border-b-2 border-border-color py-4">
      <div class="flex items-center justify-between">
        <h2 class="text-logo uppercase text-primary-500">Optimum</h2>
        <div class="flex items-center max-md:hidden">
          <a href="#" class="relative mr-6 text-sm font-semibold text-grey-500 transition-colors duration-500 before:absolute before:-bottom-[26px] before:h-[2px] before:w-full before:bg-primary-500 before:opacity-0 before:transition-opacity before:duration-500 hover:text-grey-900 hover:before:opacity-100">Booking</a>
          <a href="#" class="relative mr-6 text-sm font-semibold text-grey-500 transition-colors duration-500 before:absolute before:-bottom-[26px] before:h-[2px] before:w-full before:bg-primary-500 before:opacity-0 before:transition-opacity before:duration-500 hover:text-grey-900 hover:before:opacity-100">About Us</a>
          <a href="#" class="relative mr-6 text-sm font-semibold text-grey-500 transition-colors duration-500 before:absolute before:-bottom-[26px] before:h-[2px] before:w-full before:bg-primary-500 before:opacity-0 before:transition-opacity before:duration-500 hover:text-grey-900 hover:before:opacity-100">Support</a>
          <a href="#" class="relative mr-6 text-sm font-semibold text-grey-500 transition-colors duration-500 before:absolute before:-bottom-[26px] before:h-[2px] before:w-full before:bg-primary-500 before:opacity-0 before:transition-opacity before:duration-500 hover:text-grey-900 hover:before:opacity-100">Terms & Conditions</a>
        </div>
        <div class="flex items-center gap-4">
          <div class="relative flex items-center gap-2 max-md:hidden">
            <!-- src="./imgs/Person-4.svg" -->
            <img src="imgs/no profile.png" alt="" class="h-9 w-9 rounded-full" />
            <i class="fa-solid fa-chevron-down cursor-pointer text-lg text-grey-500 transition-transform duration-500" id="dropDownBtn"></i>
            <div class="absolute right-0 top-[3.3rem] -z-10 h-0 w-52 overflow-hidden rounded-xl bg-white p-0 transition-all duration-500" id="dropDown">
              <div class="flex items-center gap-3 border-b border-border-color px-4 pb-3">
                <!-- src="imgs/Person-4.svg" -->
                <img src="imgs/no profile.png" alt="" class="h-9 w-9 rounded-full" />
                <h2 class="font-semibold text-grey-900"><?php if (isset($_SESSION['userName'])) {
                                                          echo   $_SESSION['userName'];
                                                        } else {
                                                          echo  "Guest";
                                                        } ?> </h2>
              </div>
              <ul>
                <li class="cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100">
                  <a href="#" class="flex items-center gap-3">
                    <i class="fa-regular fa-heart cursor-pointer text-lg text-grey-500"></i>
                    Favorites
                  </a>
                </li>
                <li class="cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100">
                  <a href="#" class="flex items-center gap-3">
                    <i class="fa-regular fa-bell cursor-pointer text-lg text-grey-500"></i>
                    Notifications
                  </a>
                </li>
                <li class="cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100">
                  <a href="#" class="flex items-center gap-3">
                    <i class="fa-solid fa-gear cursor-pointer text-lg text-grey-500"></i>
                    Settings
                  </a>
                </li>
                <li class="cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100">
                  <a href="<?= (isset($_SESSION['userName'])) ? 'logout' : "login" ?>.php" class="flex items-center gap-3">
                    <?php if (isset($_SESSION['userName'])) {
                      echo '<i
                      class="fa-solid fa-right-from-bracket rotate-180 cursor-pointer text-lg text-grey-500"
                    ></i>';
                      echo   'Log out';
                    } else {
                      echo '<i
                      class="fa-solid fa-right-from-bracket cursor-pointer text-lg text-grey-500"
                    ></i>';
                      echo   'Log in';
                    } ?>
                    <!-- <i
                        class="fa-solid fa-right-from-bracket rotate-180 cursor-pointer text-lg text-grey-500"
                      ></i>
                      Log out -->
                    <!-- <i class="fa-solid fa-right-from-bracket cursor-pointer text-lg text-grey-500"></i>
                    Log in -->
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <i class="fa-solid fa-bars cursor-pointer text-xl text-grey-500 md:hidden" id="sideBarOpenBtn"></i>
        </div>
      </div>
    </div>
  </header>
  <div class="absolute left-0 top-0 z-10 flex h-screen -translate-y-full flex-col justify-between bg-white px-5 py-7 shadow-shadow-1 transition-transform duration-500" id="sideBar">
    <div class="flex flex-col">
      <a href="#" class="mb-8 text-lg font-semibold text-grey-500 transition-colors duration-500 hover:text-grey-900 hover:before:opacity-100">
        <i class="fa-solid fa-ticket-simple mr-3"></i>
        Booking</a>
      <a href="#" class="mb-8 text-lg font-semibold text-grey-500 transition-colors duration-500 hover:text-grey-900 hover:before:opacity-100">
        <i class="fa-solid fa-circle-exclamation mr-3"></i>
        About Us</a>
      <a href="#" class="mb-8 text-lg font-semibold text-grey-500 transition-colors duration-500 hover:text-grey-900 hover:before:opacity-100">
        <i class="fa-solid fa-headset mr-3"></i>
        Support</a>
      <a href="#" class="mb-8 text-lg font-semibold text-grey-500 transition-colors duration-500 hover:text-grey-900 hover:before:opacity-100">
        <i class="fa-solid fa-file-contract mr-3"></i>
        Terms & conditions</a>
    </div>
    <div>
      <div class="relative flex items-center justify-between">
        <i class="fa-solid fa-chevron-up cursor-pointer text-lg text-grey-500 transition-transform duration-500" id="sideBarDropDownBtn"></i>
        <img src="./imgs/Person-4.svg" alt="" class="h-9 w-9 rounded-full" />
        <div class="absolute bottom-14 left-1/2 -z-10 h-0 w-52 -translate-x-1/2 overflow-hidden rounded-xl bg-white p-0 transition-all duration-500" id="sideBarDropDown">
          <div class="flex items-center gap-3 border-b border-border-color px-4 pb-3">
            <img src="imgs/Person-4.svg" alt="" class="h-9 w-9 rounded-full" />
            <h2 class="font-semibold text-grey-900">Walid</h2>
          </div>
          <ul>
            <li class="cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100">
              <a href="#" class="flex items-center gap-3">
                <i class="fa-regular fa-heart cursor-pointer text-lg text-grey-500"></i>
                Favorites
              </a>
            </li>
            <li class="cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100">
              <a href="#" class="flex items-center gap-3">
                <i class="fa-regular fa-bell cursor-pointer text-lg text-grey-500"></i>
                Notifications
              </a>
            </li>
            <li class="cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100">
              <a href="#" class="flex items-center gap-3">
                <i class="fa-solid fa-gear cursor-pointer text-lg text-grey-500"></i>
                Settings
              </a>
            </li>
            <li class="cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100">
              <a href="#" class="flex items-center gap-3">
                <i class="fa-solid fa-right-from-bracket rotate-180 cursor-pointer text-lg text-grey-500"></i>
                Log out
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <main>
    <section>
      <div class="container flex items-center gap-8 py-10 max-md:flex-col">
        <div class="flex-1">
          <h1 class="text-[2.1rem] font-bold text-grey-900">
            Book car in easy steps
          </h1>
          <p class="my-5 w-[85%] text-lg text-grey-500">
            Renting a car brings you freedom, we’ll help you find the best car
            for you at a great price.
          </p>
          <div class="flex items-center gap-7">
            <div class="relative flex h-12 w-36">
              <div class="absolute left-0 top-0 z-[1] h-12 w-12 rounded-full border-2 border-border-color bg-grey-100 bg-person1"></div>
              <div class="absolute left-[35px] top-0 z-[1] h-12 w-12 rounded-full border-2 border-border-color bg-grey-100 bg-person2"></div>
              <div class="absolute left-[65px] top-0 z-[1] h-12 w-12 rounded-full border-2 border-border-color bg-grey-100 bg-person3"></div>
              <div class="absolute left-[95px] top-0 z-[1] grid h-12 w-12 place-content-center rounded-full border-2 border-border-color bg-grey-100 text-sm font-bold">
                +2k
              </div>
            </div>
            <div class="h-12 w-[2px] bg-grey-100"></div>
            <div>
              <div class="flex gap-1">
                <span class="grid h-4 w-4 place-content-center rounded-md bg-primary-500 p-1">
                  <i class="fa-solid fa-star text-[9px] leading-[0] text-white"></i>
                </span>
                <span class="grid h-4 w-4 place-content-center rounded-md bg-primary-500 p-1">
                  <i class="fa-solid fa-star text-[9px] leading-[0] text-white"></i>
                </span>
                <span class="grid h-4 w-4 place-content-center rounded-md bg-primary-500 p-1">
                  <i class="fa-solid fa-star text-[9px] leading-[0] text-white"></i>
                </span>
                <span class="grid h-4 w-4 place-content-center rounded-md bg-primary-500 p-1">
                  <i class="fa-solid fa-star text-[9px] leading-[0] text-white"></i>
                </span>
                <span class="grid h-4 w-4 place-content-center rounded-md bg-primary-500 p-1">
                  <i class="fa-solid fa-star text-[9px] leading-[0] text-white"></i>
                </span>
              </div>
              <p class="mt-2 text-xs text-grey-500">
                Trusted by 10 million customers
              </p>
            </div>
          </div>
        </div>
        <div class="flex flex-[1.5] gap-4 rounded-2xl border-2 border-border-color p-8 max-sm:flex-col">
          <div>
            <label class="font-semibold text-grey-900">
              <i class="fa-solid fa-location-dot mr-2 text-primary-500"></i>
              Pick-up
              <input type="text" value="London (LHR - Heathrow)" class="mt-3 w-full rounded-2xl bg-grey-100 p-3 font-semibold text-grey-700 focus:outline-none" />
            </label>
            <div class="mt-6 flex gap-3 max-xs:flex-col">
              <label class="font-semibold text-grey-900">
                <i class="fa-regular fa-calendar mr-2 text-primary-500"></i>
                Pick-up Date
                <input type="text" value="18 December" class="mt-3 w-full rounded-2xl bg-grey-100 p-3 font-semibold text-grey-700 focus:outline-none" />
              </label>
              <label class="font-semibold text-grey-900">
                <i class="fa-regular fa-calendar mr-2 text-primary-500"></i>
                Drop-off Date
                <input type="text" value="19 December" class="mt-3 w-full rounded-2xl bg-grey-100 p-3 font-semibold text-grey-700 focus:outline-none" />
              </label>
            </div>
          </div>
          <div>
            <label class="font-semibold text-grey-900">
              <i class="fa-solid fa-location-dot mr-2 text-primary-500"></i>
              Drop-off
              <input type="text" value="London (LGW - Gatwick)" class="mt-3 w-full rounded-2xl bg-grey-100 p-3 font-semibold text-grey-700 focus:outline-none" />
            </label>
            <div class="mt-6 flex gap-3 max-xs:flex-col">
              <label class="font-semibold text-grey-900">
                <i class="fa-regular fa-clock mr-2 text-primary-500"></i>
                Pick-up Time
                <input type="text" value="10:00" class="mt-3 w-full rounded-2xl bg-grey-100 p-3 font-semibold text-grey-700 focus:outline-none" />
              </label>
              <label class="font-semibold text-grey-900">
                <i class="fa-regular fa-clock mr-2 text-primary-500"></i>
                Drop-off Date
                <input type="text" value="10:00" class="mt-3 w-full rounded-2xl bg-grey-100 p-3 font-semibold text-grey-700 focus:outline-none" />
              </label>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="bg-light-grey">
      <div class="container relative flex items-start gap-9 py-10">
        <aside class="w-fit rounded-xl border-2 border-border-color bg-white p-8 max-md:absolute max-md:right-5 max-md:top-24 max-md:-z-10 max-md:h-[550px] max-md:overflow-y-scroll max-md:opacity-0 max-md:transition-all max-md:duration-500">
          <h2 class="border-b border-border-color pb-3 font-semibold text-grey-900">
            Filter By
          </h2>
          <div class="mt-5">
            <p class="mb-4 text-sm font-semibold text-grey-700">Car type</p>
            <ul>
              <li class="mb-3 flex items-center gap-3">
                <div class="checkedBox grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                  <i class="fa-solid fa-check text-sm"></i>
                </div>
                <label class="font-semibold text-grey-500">Coupe <span class="ml-2" id="quantity">(24)</span>
                </label>
              </li>
              <li class="mb-3 flex items-center gap-3">
                <div class="checkedBox grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                  <i class="fa-solid fa-check text-sm"></i>
                </div>
                <label class="font-semibold text-grey-500">Hatchback <span class="ml-2" id="quantity">(12)</span>
                </label>
              </li>
              <li class="mb-3 flex items-center gap-3">
                <div class="checkedBox grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                  <i class="fa-solid fa-check text-sm"></i>
                </div>
                <label class="font-semibold text-grey-500">Sedan <span class="ml-2" id="quantity">(16)</span>
                </label>
              </li>
              <li class="mb-3 flex items-center gap-3">
                <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                  <i class="fa-solid fa-check text-sm"></i>
                </div>
                <label class="font-semibold text-grey-500">MPV <span class="ml-2" id="quantity">(28)</span>
                </label>
              </li>
              <li class="flex items-center gap-3">
                <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                  <i class="fa-solid fa-check text-sm"></i>
                </div>
                <label class="font-semibold text-grey-500">SUV <span class="ml-2" id="quantity">(20)</span>
                </label>
              </li>
            </ul>
          </div>
          <div class="mt-5">
            <p class="mb-4 text-sm font-semibold text-grey-700">Capacity</p>
            <ul>
              <li class="mb-3 flex items-center gap-3">
                <div class="checkedBox grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                  <i class="fa-solid fa-check text-sm"></i>
                </div>
                <label class="font-semibold text-grey-500">2 - 5 <span class="ml-2" id="quantity">(100)</span>
                </label>
              </li>
              <li class="mb-3 flex items-center gap-3">
                <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                  <i class="fa-solid fa-check text-sm"></i>
                </div>
                <label class="font-semibold text-grey-500">6 or more <span class="ml-2" id="quantity">(4)</span>
                </label>
              </li>
            </ul>
          </div>
          <div class="mt-5">
            <p class="mb-4 text-sm font-semibold text-grey-700">
              Customer Recommendation
            </p>
            <ul>
              <li class="mb-3 flex items-center gap-3">
                <div class="checkedBox grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                  <i class="fa-solid fa-check text-sm"></i>
                </div>
                <label class="font-semibold text-grey-500">70 - 100% <span class="ml-2" id="quantity">(72)</span>
                </label>
              </li>
              <li class="mb-3 flex items-center gap-3">
                <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                  <i class="fa-solid fa-check text-sm"></i>
                </div>
                <label class="font-semibold text-grey-500">40 - 69%<span class="ml-2" id="quantity">(41)</span>
                </label>
              </li>
              <li class="mb-3 flex items-center gap-3">
                <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                  <i class="fa-solid fa-check text-sm"></i>
                </div>
                <label class="font-semibold text-grey-500">0 - 39% <span class="ml-2" id="quantity">(28)</span>
                </label>
              </li>
            </ul>
          </div>
        </aside>
        <div class="flex-1">
          <div class="flex items-center justify-between gap-12">
            <div class="flex flex-1 items-center gap-5 rounded-[35px] bg-white px-5 py-3">
              <i class="fa-solid fa-search text-lg text-grey-600"></i>
              <input type="text" name="search" placeholder="Search Cars" class="w-full flex-1 border-none font-semibold text-grey-700 placeholder-grey-700 placeholder:text-sm placeholder:font-bold focus:outline-none" />
            </div>
            <img src="imgs/icons8-filter-90.png" alt="" class="hidden h-7 w-7 cursor-pointer max-md:block" id="filterBtn" />
          </div>
          <div class="mt-5 grid max-h-[535px] grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-9 overflow-y-scroll pb-1 pr-4">
            <div class="rounded-xl bg-white p-5 shadow-shadow-1">
              <div class="mb-3 flex items-center justify-between">
                <h4 class="font-bold text-grey-900">Porsche 718 Cayman S</h4>
                <i class="fa-solid fa-heart cursor-pointer text-lg text-red-300" id="addToFav"></i>
              </div>
              <p class="font-semibold text-grey-500">Coupe</p>
              <img src="imgs/car-03.svg" alt="" class="mx-auto my-3 h-28" />
              <div class="flex items-center justify-between">
                <div class="flex gap-3">
                  <span class="font-semibold text-grey-500">
                    <i class="fa-solid fa-user mr-2 text-primary-500"></i>
                    2
                  </span>
                  <div class="flex items-center">
                    <img src="imgs/icons8-gearshift-50.png" alt="" class="mr-1 h-5 w-5" />
                    <span class="font-semibold text-grey-500">Manual</span>
                  </div>
                </div>
                <span class="font-bold text-grey-900">$400 <span class="text-grey-500">/d</span></span>
              </div>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-shadow-1">
              <div class="mb-3 flex items-center justify-between">
                <h4 class="font-bold text-grey-900">Mini Cooper 5-DOOR</h4>
                <i class="fa-regular fa-heart cursor-pointer text-lg text-grey-600" id="addToFav"></i>
              </div>
              <p class="font-semibold text-grey-500">Hatchback</p>
              <img src="imgs/car-04.svg" alt="" class="mx-auto my-3 h-28 w-52" />
              <div class="flex items-center justify-between">
                <div class="flex gap-3">
                  <span class="font-semibold text-grey-500">
                    <i class="fa-solid fa-user mr-2 text-primary-500"></i>
                    4
                  </span>
                  <div class="flex items-center">
                    <img src="imgs/icons8-gearshift-50.png" alt="" class="mr-1 h-5 w-5" />
                    <span class="font-semibold text-grey-500">Matic</span>
                  </div>
                </div>
                <span class="font-bold text-grey-900">$394 <span class="text-grey-500">/d</span></span>
              </div>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-shadow-1">
              <div class="mb-3 flex items-center justify-between">
                <h4 class="font-bold text-grey-900">Toyota GR Supra</h4>
                <i class="fa-regular fa-heart cursor-pointer text-lg text-grey-600" id="addToFav"></i>
              </div>
              <p class="font-semibold text-grey-500">Coupe</p>
              <img src="imgs/car-01.svg" alt="" class="mx-auto my-3 h-28" />
              <div class="flex items-center justify-between">
                <div class="flex gap-3">
                  <span class="font-semibold text-grey-500">
                    <i class="fa-solid fa-user mr-2 text-primary-500"></i>
                    2
                  </span>
                  <div class="flex items-center">
                    <img src="imgs/icons8-gearshift-50.png" alt="" class="mr-1 h-5 w-5" />
                    <span class="font-semibold text-grey-500">Manual</span>
                  </div>
                </div>
                <span class="font-bold text-grey-900">$360 <span class="text-grey-500">/d</span></span>
              </div>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-shadow-1">
              <div class="mb-3 flex items-center justify-between">
                <h4 class="font-bold text-grey-900">Porsche 911 Turbo</h4>
                <i class="fa-regular fa-heart cursor-pointer text-lg text-grey-600" id="addToFav"></i>
              </div>
              <p class="font-semibold text-grey-500">Coupe</p>
              <img src="imgs/car-05.svg" alt="" class="mx-auto my-3 h-28" />
              <div class="flex items-center justify-between">
                <div class="flex gap-3">
                  <span class="font-semibold text-grey-500">
                    <i class="fa-solid fa-user mr-2 text-primary-500"></i>
                    2
                  </span>
                  <div class="flex items-center">
                    <img src="imgs/icons8-gearshift-50.png" alt="" class="mr-1 h-5 w-5" />
                    <span class="font-semibold text-grey-500">Manual</span>
                  </div>
                </div>
                <span class="font-bold text-grey-900">$468 <span class="text-grey-500">/d</span></span>
              </div>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-shadow-1">
              <div class="mb-3 flex items-center justify-between">
                <h4 class="font-bold text-grey-900">Porsche Taycan 4S</h4>
                <i class="fa-regular fa-heart cursor-pointer text-lg text-grey-600" id="addToFav"></i>
              </div>
              <p class="font-semibold text-grey-500">Hatchback</p>
              <img src="imgs/car-06.svg" alt="" class="mx-auto my-3 h-28" />
              <div class="flex items-center justify-between">
                <div class="flex gap-3">
                  <span class="font-semibold text-grey-500">
                    <i class="fa-solid fa-user mr-2 text-primary-500"></i>
                    2
                  </span>
                  <div class="flex items-center">
                    <img src="imgs/icons8-gearshift-50.png" alt="" class="mr-1 h-5 w-5" />
                    <span class="font-semibold text-grey-500">Manual</span>
                  </div>
                </div>
                <span class="font-bold text-grey-900">$424 <span class="text-grey-500">/d</span></span>
              </div>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-shadow-1">
              <div class="mb-3 flex items-center justify-between">
                <h4 class="font-bold text-grey-900">Mini Cooper WORKS</h4>
                <i class="fa-regular fa-heart cursor-pointer text-lg text-grey-600" id="addToFav"></i>
              </div>
              <p class="font-semibold text-grey-500">Hatchback</p>
              <img src="imgs/car-02.svg" alt="" class="mx-auto my-3 h-28" />
              <div class="flex items-center justify-between">
                <div class="flex gap-3">
                  <span class="font-semibold text-grey-500">
                    <i class="fa-solid fa-user mr-2 text-primary-500"></i>
                    4
                  </span>
                  <div class="flex items-center">
                    <img src="imgs/icons8-gearshift-50.png" alt="" class="mr-1 h-5 w-5 scale-110" />
                    <span class="font-semibold text-grey-500">Matic</span>
                  </div>
                </div>
                <span class="font-bold text-grey-900">$360 <span class="text-grey-500">/d</span></span>
              </div>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-shadow-1">
              <div class="mb-3 flex items-center justify-between">
                <h4 class="font-bold text-grey-900">Porsche 718 Cayman S</h4>
                <i class="fa-solid fa-heart cursor-pointer text-lg text-red-300" id="addToFav"></i>
              </div>
              <p class="font-semibold text-grey-500">Coupe</p>
              <img src="imgs/car-03.svg" alt="" class="mx-auto my-3 h-28" />
              <div class="flex items-center justify-between">
                <div class="flex gap-3">
                  <span class="font-semibold text-grey-500">
                    <i class="fa-solid fa-user mr-2 text-primary-500"></i>
                    2
                  </span>
                  <div class="flex items-center">
                    <img src="imgs/icons8-gearshift-50.png" alt="" class="mr-1 h-5 w-5" />
                    <span class="font-semibold text-grey-500">Manual</span>
                  </div>
                </div>
                <span class="font-bold text-grey-900">$400 <span class="text-grey-500">/d</span></span>
              </div>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-shadow-1">
              <div class="mb-3 flex items-center justify-between">
                <h4 class="font-bold text-grey-900">Mini Cooper 5-DOOR</h4>
                <i class="fa-regular fa-heart cursor-pointer text-lg text-grey-600" id="addToFav"></i>
              </div>
              <p class="font-semibold text-grey-500">Hatchback</p>
              <img src="imgs/car-04.svg" alt="" class="mx-auto my-3 h-28 w-52" />
              <div class="flex items-center justify-between">
                <div class="flex gap-3">
                  <span class="font-semibold text-grey-500">
                    <i class="fa-solid fa-user mr-2 text-primary-500"></i>
                    4
                  </span>
                  <div class="flex items-center">
                    <img src="imgs/icons8-gearshift-50.png" alt="" class="mr-1 h-5 w-5" />
                    <span class="font-semibold text-grey-500">Matic</span>
                  </div>
                </div>
                <span class="font-bold text-grey-900">$394 <span class="text-grey-500">/d</span></span>
              </div>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-shadow-1">
              <div class="mb-3 flex items-center justify-between">
                <h4 class="font-bold text-grey-900">Toyota GR Supra</h4>
                <i class="fa-regular fa-heart cursor-pointer text-lg text-grey-600" id="addToFav"></i>
              </div>
              <p class="font-semibold text-grey-500">Coupe</p>
              <img src="imgs/car-01.svg" alt="" class="mx-auto my-3 h-28" />
              <div class="flex items-center justify-between">
                <div class="flex gap-3">
                  <span class="font-semibold text-grey-500">
                    <i class="fa-solid fa-user mr-2 text-primary-500"></i>
                    2
                  </span>
                  <div class="flex items-center">
                    <img src="imgs/icons8-gearshift-50.png" alt="" class="mr-1 h-5 w-5" />
                    <span class="font-semibold text-grey-500">Manual</span>
                  </div>
                </div>
                <span class="font-bold text-grey-900">$360 <span class="text-grey-500">/d</span></span>
              </div>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-shadow-1">
              <div class="mb-3 flex items-center justify-between">
                <h4 class="font-bold text-grey-900">Porsche 911 Turbo</h4>
                <i class="fa-regular fa-heart cursor-pointer text-lg text-grey-600" id="addToFav"></i>
              </div>
              <p class="font-semibold text-grey-500">Coupe</p>
              <img src="imgs/car-05.svg" alt="" class="mx-auto my-3 h-28" />
              <div class="flex items-center justify-between">
                <div class="flex gap-3">
                  <span class="font-semibold text-grey-500">
                    <i class="fa-solid fa-user mr-2 text-primary-500"></i>
                    2
                  </span>
                  <div class="flex items-center">
                    <img src="imgs/icons8-gearshift-50.png" alt="" class="mr-1 h-5 w-5" />
                    <span class="font-semibold text-grey-500">Manual</span>
                  </div>
                </div>
                <span class="font-bold text-grey-900">$468 <span class="text-grey-500">/d</span></span>
              </div>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-shadow-1">
              <div class="mb-3 flex items-center justify-between">
                <h4 class="font-bold text-grey-900">Porsche Taycan 4S</h4>
                <i class="fa-regular fa-heart cursor-pointer text-lg text-grey-600" id="addToFav"></i>
              </div>
              <p class="font-semibold text-grey-500">Hatchback</p>
              <img src="imgs/car-06.svg" alt="" class="mx-auto my-3 h-28" />
              <div class="flex items-center justify-between">
                <div class="flex gap-3">
                  <span class="font-semibold text-grey-500">
                    <i class="fa-solid fa-user mr-2 text-primary-500"></i>
                    2
                  </span>
                  <div class="flex items-center">
                    <img src="imgs/icons8-gearshift-50.png" alt="" class="mr-1 h-5 w-5" />
                    <span class="font-semibold text-grey-500">Manual</span>
                  </div>
                </div>
                <span class="font-bold text-grey-900">$424 <span class="text-grey-500">/d</span></span>
              </div>
            </div>
            <div class="rounded-xl bg-white p-5 shadow-shadow-1">
              <div class="mb-3 flex items-center justify-between">
                <h4 class="font-bold text-grey-900">Mini Cooper WORKS</h4>
                <i class="fa-regular fa-heart cursor-pointer text-lg text-grey-600" id="addToFav"></i>
              </div>
              <p class="font-semibold text-grey-500">Hatchback</p>
              <img src="imgs/car-02.svg" alt="" class="mx-auto my-3 h-28" />
              <div class="flex items-center justify-between">
                <div class="flex gap-3">
                  <span class="font-semibold text-grey-500">
                    <i class="fa-solid fa-user mr-2 text-primary-500"></i>
                    4
                  </span>
                  <div class="flex items-center">
                    <img src="imgs/icons8-gearshift-50.png" alt="" class="mr-1 h-5 w-5 scale-110" />
                    <span class="font-semibold text-grey-500">Matic</span>
                  </div>
                </div>
                <span class="font-bold text-grey-900">$360 <span class="text-grey-500">/d</span></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>

</html>