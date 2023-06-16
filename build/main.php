<?php
session_start();
require 'db.php';
require 'utilities.php';
function showProfilePicture()
{
  if (isset($_SESSION['userName'])) {
    return '<img src="imgs/Person-3.svg" alt="" class="h-9 w-9 rounded-full" />';
  } else {
    return '<img src="imgs/no profile.png" alt="" class="h-9 w-9 rounded-full" />';
  }
}
?>
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
        <!-- <h2 class="text-logo uppercase text-primary-500">Optimum</h2> -->
        <img src="./imgs/logo.jpg" alt="" class="w-10 h-10">
        <div class="flex items-center max-md:hidden">
          <a href="#" class="relative mr-6 text-sm font-semibold text-grey-500 transition-colors duration-500 before:absolute before:-bottom-[26px] before:h-[2px] before:w-full before:bg-primary-500 before:opacity-0 before:transition-opacity before:duration-500 hover:text-grey-900 hover:before:opacity-100">Booking</a>
          <a href="#" class="relative mr-6 text-sm font-semibold text-grey-500 transition-colors duration-500 before:absolute before:-bottom-[26px] before:h-[2px] before:w-full before:bg-primary-500 before:opacity-0 before:transition-opacity before:duration-500 hover:text-grey-900 hover:before:opacity-100">About Us</a>
          <a href="#" class="relative mr-6 text-sm font-semibold text-grey-500 transition-colors duration-500 before:absolute before:-bottom-[26px] before:h-[2px] before:w-full before:bg-primary-500 before:opacity-0 before:transition-opacity before:duration-500 hover:text-grey-900 hover:before:opacity-100">Support</a>
          <a href="#" class="relative mr-6 text-sm font-semibold text-grey-500 transition-colors duration-500 before:absolute before:-bottom-[26px] before:h-[2px] before:w-full before:bg-primary-500 before:opacity-0 before:transition-opacity before:duration-500 hover:text-grey-900 hover:before:opacity-100">Terms & Conditions</a>
        </div>
        <div class="flex items-center gap-4" id="headerDropDownParent">
          <div class="relative flex items-center gap-2 ">

            <?php echo showProfilePicture() ?>
            <i class="fa-solid fa-chevron-up cursor-pointer text-lg text-grey-500 transition-transform duration-500" id="dropDownBtn"></i>
            <div class="absolute right-0 top-[3.3rem] -z-10 h-0 w-52  rounded-xl bg-white p-0 transition-all duration-500 " id="dropDown">
              <div class="bg-white flex items-center gap-3 border-b border-border-color px-4 pb-3">
                <?php echo showProfilePicture() ?>
                <h2 class="font-semibold text-grey-900" id="userName"><?php if (isset($_SESSION['userName'])) {
                                                                        echo   $_SESSION['userName'];
                                                                      } else {
                                                                        echo  "Guest";
                                                                      } ?></h2>
              </div>
              <ul>
                <li class="bg-white cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100  flex items-center gap-3" id="cart_toggler">
                  <i class="w-5 fa-solid fa-cart-shopping relative cursor-pointer text-lg text-grey-500 <?php if (isset($_SESSION['userName'])) echo 'after:w-4 after:h-4 after:rounded-full after:bg-red-300 after:absolute   after:content-[attr(data-cart)] after:text-white after:text-[0.5rem] after:grid after:place-content-center after:-top-2 after:-right-2' ?>" data-cart="<?php

                                                                                                                                                                                                                                                                                                                                                                                      if (isset($_SESSION['userName'])) {

                                                                                                                                                                                                                                                                                                                                                                                        if (isCartEmpty($conn) == false) {
                                                                                                                                                                                                                                                                                                                                                                                          $userId = $_SESSION['userId'];
                                                                                                                                                                                                                                                                                                                                                                                          echo countCartItems($conn, $userId);
                                                                                                                                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                                                                                                                                          echo 0;
                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                      } ?>" id="cart_count"></i>
                  Cart
                </li>
                <li class="bg-white cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100 flex items-center gap-3">
                  <i class="w-5 fa-regular fa-bell cursor-pointer text-lg text-grey-500"></i>
                  Notifications
                </li>
                <li class="bg-white cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100 flex items-center gap-3">
                  <i class="w-5 fa-solid fa-gear cursor-pointer text-lg text-grey-500"></i>
                  Settings
                </li>
                <li class="bg-white cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100">
                  <a href="authentication/<?= (isset($_SESSION['userName'])) ? 'logout' : "login" ?>.php" class="flex items-center gap-3">
                    <?php if (isset($_SESSION['userName'])) {
                      echo '<i
                      class="w-5 fa-solid fa-right-from-bracket rotate-180 cursor-pointer text-lg text-grey-500"
                    ></i>';
                      echo   'Log out';
                    } else {
                      echo '<i
                      class="fa-solid fa-right-from-bracket cursor-pointer text-lg text-grey-500"
                    ></i>';
                      echo   'Log in';
                    } ?>
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
  <div class="max-md:rounded-none max-md:transition-opacity max-md:opacity-0 absolute h-[309px] max-md:h-full max-md:w-full max-md:top-0 w-[300px] rounded-xl py-5 bg-white right-0 top-[69px] border-2 border-border-color -z-10 flex flex-col justify-between transition-transform duration-500" id="cart">
    <div class="flex justify-between items-center  pb-5 border-b border-border-color px-5">
      <h4 class=" text-grey-900 font-bold">Cart</h4>
      <i class="fa-solid fa-xmark text-lg text-grey-600 cursor-pointer md:hidden" id="close_cart"></i>
    </div>
    <div class="flex-1  h-64 overflow-y-scroll px-5" id="cart_cars">
      <?php
      if (isCartEmpty($conn) == false) {
        // Get user id
        $userId = $_SESSION['userId'];
        $stmt = $conn->prepare('SELECT name , price , image , quantity  FROM cars INNER JOIN carts ON cars.id = carts.car_id  WHERE user_id = :userId ');
        $stmt->execute(['userId' => $userId]);
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($results as $car) {
          echo  " <div class='flex gap-3 items-center mt-4'>
                       <div class='rounded-lg shadow-shadow-1 px-1'>
                         <img src='$car->image' class='w-16 h-12' alt=''>
                       </div>
                       <div class='flex-1'>
                         <h5 class='text-grey-700 font-bold mb-2'>$car->name</h5>
                         <span class='text-grey-500 text-sm'>$<span class='font-semibold'>$car->price</span> x <span>$car->quantity</span></span>
                       </div>
                       <i class='fa-solid fa-trash-can text-lg cursor-pointer text-red-300' id='removeFromCart'></i>
                       </div> ";
        }
      } else {
        echo " <div class='grid place-items-center place-content-center h-full'>
                    <img src='./imgs/empty-cart.png' alt='' class='w-24' >
                    <p class='text-grey-600 font-bold mt-2 text-lg'>Your cart is empty</p>
                  </div>";
      }
      ?>
    </div>
    <button class="hidden mx-auto px-[33%]  mt-4 text-center text-white bg-primary-500 rounded-xl py-3 font-bold text-sm hover:bg-grey-900 transition-colors duration-500">Checkout</button>

  </div>
  <div class="absolute left-0 top-0 z-10 flex h-screen  -translate-x-full flex-col justify-between bg-white px-5 py-7 shadow-shadow-1 transition-transform duration-500" id="sideBar">
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
    <div id="sideBarDropDownParent">
    </div>
  </div>
  <main>
    <section>
      <div class="container flex items-center bg-white gap-8 py-10 max-md:flex-col">
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
      <div class="container relative flex items-start gap-9 pt-10 py-8">
        <aside class="w-fit rounded-xl border-2 border-border-color bg-white p-8 pe-0 max-md:absolute max-md:left-5 max-md:top-24 max-md:-z-10  max-md:h-[500px] max-md:overflow-hidden  max-md:opacity-0 max-md:transition-all max-md:duration-500">
          <h2 class="border-b border-border-color pb-3 font-semibold text-grey-900">
            Filter By
          </h2>
          <div class="max-md:h-[400px] pe-8 max-md:overflow-y-scroll">

            <div class="mt-5">
              <p class="mb-4 text-sm font-semibold text-grey-700">Car type</p>
              <ul id="filterByType">
                <li class="mb-3 flex items-center gap-3">
                  <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                    <i class="fa-solid fa-check text-sm"></i>
                  </div>
                  <label class="font-semibold text-grey-500">Sports Car <span class="ml-2" id="quantity">(<?= countCarsByType("Sports Car") ?>)</span>
                  </label>
                </li>
                <li class="mb-3 flex items-center gap-3">
                  <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                    <i class="fa-solid fa-check text-sm"></i>
                  </div>
                  <label class="font-semibold text-grey-500">Hatchback <span class="ml-2" id="quantity">(<?= countCarsByType("Hatchback") ?>)</span>
                  </label>
                </li>
                <li class="mb-3 flex items-center gap-3">
                  <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                    <i class="fa-solid fa-check text-sm"></i>
                  </div>
                  <label class="font-semibold text-grey-500">Sedan <span class="ml-2" id="quantity">(<?= countCarsByType("Sedan") ?>)</span>
                  </label>
                </li>
                <li class="mb-3 flex items-center gap-3">
                  <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                    <i class="fa-solid fa-check text-sm"></i>
                  </div>
                  <label class="font-semibold text-grey-500">Truck <span class="ml-2" id="quantity">(<?= countCarsByType("Truck") ?>)</span>
                  </label>
                </li>
                <li class="mb-3 flex items-center gap-3">
                  <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                    <i class="fa-solid fa-check text-sm"></i>
                  </div>
                  <label class="font-semibold text-grey-500">SUV <span class="ml-2" id="quantity">(<?= countCarsByType("SUV") ?>)</span>
                  </label>
                </li>
                <li class="flex items-center gap-3">
                  <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                    <i class="fa-solid fa-check text-sm"></i>
                  </div>
                  <label class="font-semibold text-grey-500">Electric <span class="ml-2" id="quantity">(<?= countCarsByType("Electric") ?>)</span>
                  </label>
                </li>
              </ul>
            </div>
            <div class="mt-5">
              <p class="mb-4 text-sm font-semibold text-grey-700">Capacity</p>
              <ul id="filterByCapacity">
                <li class="mb-3 flex items-center gap-3">
                  <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                    <i class="fa-solid fa-check text-sm"></i>
                  </div>
                  <label class="font-semibold text-grey-500">2 - 5 <span class="ml-2" id="quantity">(<?= capacityGt2AndLs5() ?>)</span>
                  </label>
                </li>
                <li class="mb-3 flex items-center gap-3">
                  <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                    <i class="fa-solid fa-check text-sm"></i>
                  </div>
                  <label class="font-semibold text-grey-500">6 or more <span class="ml-2" id="quantity">(<?= capacityGt6() ?>)</span>
                  </label>
                </li>
              </ul>
            </div>
            <div class="mt-5">
              <p class="mb-4 text-sm font-semibold text-grey-700">
                Customer Recommendation
              </p>
              <ul id="filterByRecommendation">
                <li class="mb-3 flex items-center gap-3">
                  <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                    <i class="fa-solid fa-check text-sm"></i>
                  </div>
                  <label class="font-semibold text-grey-500">70 - 100% <span class="ml-2" id="quantity">(<?= customRecGt70() ?>)</span>
                  </label>
                </li>
                <li class="mb-3 flex items-center gap-3">
                  <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                    <i class="fa-solid fa-check text-sm"></i>
                  </div>
                  <label class="font-semibold text-grey-500">40 - 69% <span class="ml-2" id="quantity">(<?= customRecBt40And70() ?>)</span>
                  </label>
                </li>
                <li class="mb-3 flex items-center gap-3">
                  <div class="grid h-5 w-5 cursor-pointer place-content-center rounded-md border-2 border-border-color bg-white text-transparent" id="checkBox">
                    <i class="fa-solid fa-check text-sm"></i>
                  </div>
                  <label class="font-semibold text-grey-500">0 - 39% <span class="ml-2" id="quantity">(<?= customRecLt39() ?>)</span>
                  </label>
                </li>
              </ul>
            </div>
          </div>

        </aside>
        <div class="flex-1">
          <div>
            <div class=" relative rounded-[35px] overflow-hidden bg-white px-5 py-3">
              <div class="absolute top-0 left-0 bg-grey-700  place-content-center h-full ps-3 pe-2  cursor-pointer hover:bg-grey-600 transition-colors  hidden max-md:grid">
                <img src="imgs/icons8-filter-96.png" alt="" class=" h-5 w-5 cursor-pointer " id="filterBtn" />
              </div>
              <input type="text" name="search" id="search_input" placeholder="Search Cars" class="max-md:ps-7 w-full flex-1 border-none font-semibold text-grey-700 placeholder-grey-700 placeholder:text-sm placeholder:font-bold focus:outline-none" />
              <div class="absolute top-0 right-0 bg-grey-700 grid place-content-center h-full pe-3 ps-2  cursor-pointer hover:bg-grey-600 transition-colors " id="search_button">
                <i class="fa-solid fa-search text-lg text-white"></i>
              </div>

            </div>
          </div>
          <div class="mt-5 grid max-h-[575px] max-md:max-h-[650px] grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-9 overflow-y-scroll pb-1 pr-4" id="search_results">
            <?= showAllCars() ?>
          </div>
        </div>
      </div>
    </section>
  </main>
  <div class=" opacity-0 -z-10 max-md:h-full  transition-opacity duration-500 absolute w-full h-full bg-[#0005] backdrop-blur-[2px] inset-0" id="car_view">
    <div class="absolute bg-grey-100 w-[80%] h-[50%] top-1/2 gap-10 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-xl flex md:items-center px-7 pb-5 max-md:flex-col max-md:w-full max-md:h-screen max-md:gap-0 max-md:rounded-none max-md:top-0 max-md:translate-x-0 max-md:translate-y-0 max-md:left-0 max-md:overflow-y-scroll">
      <i class="fa-solid fa-ellipsis text-2xl absolute top-4 left-4 text-grey-600 cursor-pointer <?php if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== 'YES') echo 'hidden' ?>" id="actionsBtn"></i>
      <i class="fa-solid fa-xmark text-2xl absolute top-4 right-4 text-grey-600 cursor-pointer" id="close_car_view"></i>
      <div class="shadow-shadow-1 absolute left-4 top-12 -z-10 h-0 w-52  rounded-xl bg-white p-0 transition-all duration-500 overflow-hidden" id="actions">
        <ul>
          <li class="bg-white cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100  flex items-center gap-3" id="add_new_car">
            <i class="w-5 fa-solid fa-circle-plus relative cursor-pointer text-lg text-grey-500 "></i>
            Add car
          </li>
          <li class="bg-white cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100 flex items-center gap-3" id="edit_car">
            <i class="w-5 fa-solid fa-pen cursor-pointer text-lg text-grey-500"></i>
            Edit car
          </li>
          <li class="bg-white cursor-pointer p-4 font-semibold text-grey-700 duration-500 hover:bg-grey-100 flex items-center gap-3" id="delete_car">
            <i class="w-5 fa-solid fa-trash-can cursor-pointer text-lg text-grey-500"></i>
            Delete car
          </li>

        </ul>
      </div>
      <div class="flex-1 grid place-content-center">
        <img src="imgs/car-01.svg" alt="" class="w-[500px] h-[350px]  mx-auto ">
      </div>
      <div class="flex-1 flex flex-col max-md:justify-center gap-6">
        <h2 class="text-4xl font-bold text-grey-700" id="name">Honda Accord Coupe</h2>
        <h3 class="text-lg font-bold text-grey-600" id="type">SUV</h3>
        <div class="flex gap-12 max-sm:justify-between">
          <div class='flex items-center'>
            <img src='imgs/icons8-gear-stick-50.png' alt='' class='mr-2 h-5 w-5' />
            <span class='font-semibold text-grey-500' id="gear_shift">Automatic</span>
          </div>
          <div>
            <i class='fa-solid fa-user mr-2 text-primary-500'></i>
            <span class='font-semibold text-grey-500 ' id="capacity">
              4 Seats
          </div>
          </span>
        </div>
        <p class="font-semibold text-grey-600"><span class="bg-primary-500 px-2 py-1 mr-2 text-sm rounded-lg  text-white font-bold" id="recommendation">70%</span>Of our customers recommend this car.</p>
        <h3 class="text-xl font-bold text-grey-900" id="price">$50,000</h3>
        <div class=" flex gap-9 max-xs:flex-col">
          <div class="bg-[#eee] py-3 px-5 rounded-xl flex justify-between items-center flex-1 xs:w-40" id="car_quantity">
            <i class="fa-solid fa-plus text-primary-500 cursor-pointer"></i>
            <span class="font-bold text-lg">1</span>
            <i class="fa-solid fa-minus text-primary-500 cursor-pointer"></i>
          </div>
          <button class="  text-center text-white bg-primary-500 rounded-xl tracking-wider  py-3 flex-[1.5] font-bold text-sm hover:bg-grey-900 transition-colors duration-500"><i class='fa-solid fa-cart-plus  mr-2 text-lg text-white'></i> Add To Cart</button>
        </div>
      </div>
    </div>
    <div class=" max-md:overflow-y-scroll absolute bg-white w-0 h-0 overflow-hidden p-0 transition-all duration-500  top-1/2 gap-10 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-xl  max-md:flex-col  max-md:gap-0 max-md:rounded-none" id="add_edit_car_modal">
      <div class="flex justify-between items-center pb-7 border-b border-border-color">
        <h2 class="text-2xl font-bold text-grey-900">Add New Car</h2>
        <i class="fa-solid fa-xmark text-2xl  text-grey-600 cursor-pointer" id="close"></i>
      </div>
      <form action="">
        <input type="hidden" name="action" value="add">
        <div class="flex max-sm:flex-col gap-4 my-7">
          <label class="font-semibold text-grey-900 flex-1">
            Name
            <input type="text" placeholder="Name" name="Name" class="mt-3 w-full rounded-full bg-grey-100 py-3 px-5 font-semibold text-grey-700 focus:outline-none" />
          </label>
          <label class="font-semibold text-grey-900 flex-1">
            Type
            <input type="text" placeholder="Type" name="Type" class="mt-3 w-full rounded-full bg-grey-100 py-3 px-5 font-semibold text-grey-700 focus:outline-none" />
          </label>
        </div>
        <div class="flex max-sm:flex-col gap-4 ">
          <label class="pb-2 font-semibold text-grey-900 flex-1 sm:flex-col sm:flex sm:justify-between relative">
            Capacity (2-10)
            <input type="range" min="2" max="10" value="5" name="Capacity" step="1" class="max-sm:mt-6 outline-none bg-transparent cursor-pointer appearance-none w-full ">
            <div id="capacityValue" class="absolute -translate-x-1/2 top-4 left-1/2 w-10 py-1 text-center text-grey-700 rounded-md shadow-shadow-1 text-xs">5</div>
          </label>
          <div class="flex-1">
            <label class="font-semibold text-grey-900 block mb-6">Transmission</label>
            <div class="flex justify-between">
              <label class="font-semibold text-grey-900  flex items-center">
                <input type="radio" id="Manual" value="Manual" name="Transmission" class="text-grey-700 w-5 cursor-pointer h-5 mr-3" checked>
                Manual
              </label>
              <label class="font-semibold text-grey-900 flex items-center">
                <input type="radio" id="Automatic" value="Automatic" name="Transmission" class="text-grey-700 w-5 cursor-pointer h-5 mr-3">
                Automatic
              </label>
            </div>
          </div>
        </div>
        <label class="font-semibold text-grey-900 flex-1 block my-7">
          Price ($)
          <input type="number" placeholder="Price" name="Price" class="mt-3 w-full rounded-full bg-grey-100 py-3 px-5 font-semibold text-grey-700 focus:outline-none" />
        </label>
        <div class="flex max-sm:flex-col gap-4 items-start">
          <label class="font-semibold text-grey-900 flex-1 max-sm:w-full">
            Image
            <input type="file" name="Image" accept="image/*" multiple="false" class=" block w-full text-sm text-grey-700  file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-grey-500 file:cursor-pointer file:text-white  rounded-full bg-grey-100 p-[6px] mt-3 " />
            <p class="text-sm font-bold text-red-300 mt-4 opacity-0" id="type_error">
              Please select an image file (e.g., JPG, PNG, SVG)
            </p>
          </label>
          <div class=" w-64 h-40 shadow-shadow-1 bg-no-repeat rounded-xl bg-center bg-contain max-sm:w-full" id="image_preview"></div>
        </div>
        <button type="submit" class=" max-sm:block max-sm:mx-auto max-sm:mt-6 max-sm:w-[60%]  text-center text-white bg-primary-500 rounded-2xl tracking-wider px-12  py-3 font-bold text-lg hover:bg-grey-900 transition-colors duration-500">
          Add</button>
      </form>
    </div>
    <div class=" absolute inset-0 max-md:rounded-none  h-[50%] w-[80%] max-md:h-full max-md:w-full opacity-0 -z-10 top-1/2  rounded-xl left-1/2 -translate-x-1/2 -translate-y-1/2 bg-[#0004] backdrop-blur-[1px] grid place-content-center transition-opacity duration-300" id="delete_car_modal">
      <div class="bg-white w-fit px-7 text-center max-xs:w-full h-[250px] rounded-xl  grid place-content-center">
        <h2 class="font-bold text-grey-700 text-lg">Are you sure you want to delete this car ?</h2>
        <div class="flex justify-evenly mt-12">
          <button class="bg-red-300 py-2 px-4 text-white font-bold rounded-xl cursor-pointer hover:opacity-80 transition-opacity" id="yes_button">Yes</button>
          <button class="bg-blue-300 py-2 px-4 text-white font-bold rounded-xl cursor-pointer hover:opacity-80 transition-opacity" id="no_button">No</button>
        </div>
      </div>
    </div>
  </div>
  <div class="absolute -top-[120px] left-0 w-full p-5 bg-red-300 transition-all duration-500 z-40" id="empty_fields">
    <p class="text-white text-lg font-bold text-center">
      Please fill out all required fields. Missing fields: [
      <span id="fields"></span> ]
    </p>
  </div>
</body>

</html>
<!-- 
  <p class="error_content">
        Sorry, the current password you entered is incorrect. Please check and
        try again.
      </p>
 -->