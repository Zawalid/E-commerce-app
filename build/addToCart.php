<?php
require 'db.php';
require 'utilities.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get user id
  session_start();
  $userId = $_SESSION['userId'];

  // Get car id
  function getCarId($conn, $carName)
  {
    $stmt = $conn->prepare('SELECT * from cars WHERE name = :name');
    $stmt->execute([':name' => $carName]);
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results['id'];
  }

  // Check if the request iś for showing the cart products or for adding new product to the cart
  if (isset($_POST['carNameToAdd'])) {
    // Get the car name
    $carName =  $_POST['carNameToAdd'];
    // Car id
    $carId = getCarId($conn, $carName);
    // Check if the product already exists and if so increment the quantity
    $stmt = $conn->prepare("SELECT car_id , quantity  FROM carts WHERE car_id = :car_id");
    $stmt->execute([':car_id' => $carId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
      $quantity = $row['quantity'] + 1;
      $stmt = $conn->prepare("UPDATE carts SET quantity = :quantity WHERE car_id = :car_id");
      $stmt->execute([':quantity' => $quantity, ':car_id' => $carId]);
    } else {
      // Add the product to the carts table
      $stmt = $conn->prepare('INSERT INTO carts (user_id , car_id , quantity) VALUES (:user_id , :car_id , 1)');
      $stmt->execute([':user_id' => $userId, ':car_id' => $carId]);
    }
  }
  // Check if the request iś for removing a product from  the cart 
  if (isset($_POST['carNameToRemove'])) {
    $carName =  $_POST['carNameToRemove'];
    // Car id
    $carId = getCarId($conn, $carName);
    // Remove product from cart
    $stmt = $conn->prepare('DELETE FROM carts WHERE car_id = :car_id');
    $stmt->execute([':car_id' => $carId]);
  }

  $response = "";
  if (isCartEmpty($conn) == false) {
    // Get all cart items
    $stmt = $conn->prepare('SELECT name , price , image , quantity  FROM cars INNER JOIN carts ON cars.id = carts.car_id  WHERE user_id = :userId ');
    $stmt->execute(['userId' => $userId]);
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);
    foreach ($results as $car) {
      $carsInCart[] =  " <div class='flex gap-3 items-center mt-4'>
       <div class='rounded-lg shadow-shadow-1 px-1'>
         <img src='$car->image' class='w-16 h-12' alt=''>
       </div>
       <div class='flex-1'>
         <h5 class='text-grey-700 font-bold mb-2'>$car->name</h5>
         <span class='text-grey-500 text-sm'>$<span class='font-semibold'>$car->price</span> x <span>$car->quantity</span></span>
       </div>
       <i class='fa-solid fa-trash-can text-lg cursor-pointer text-red-300' id='removeFromCart'></i>
       </div> ";
      $response = implode(' ', $carsInCart);
    }
  } else {
    $response = " <div class='grid place-items-center place-content-center h-full '>
    <img src='./imgs/empty-cart.png' alt='' class='w-24'>
    <p class='text-grey-600 font-bold mt-2 text-lg'>Your cart is empty</p>
    </div>";
  }
  echo json_encode(array(
    'cars' => $response,
    'count' => isCartEmpty($conn) == false ? countCartItems($conn, $userId) : 0,
  ));
}
// CLose the connection
$conn = null;
