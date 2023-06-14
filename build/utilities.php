<?php
function checkPassword($password)
{

    $uppercase = preg_match('/[A-Z]/', $password); // At least one uppercase letter
    $lowercase = preg_match('/[a-z]/', $password); // At least one lowercase letter
    $number = preg_match('/\d/', $password); // At least one digit
    $specialChars = preg_match('/[^A-Za-z0-9]/', $password); // At least one special character
    $minLength = strlen($password) >= 8; // Minimum length of 8 characters
    if (!$uppercase || !$lowercase || !$number || !$specialChars || !$minLength) {
        $error_msg = "Password should be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character";
        $validated = false;
    } else {
        $validated = true;
    }
    return $validated ? 'valid' : $error_msg;
}

function showError($msg, $location)
{
    $_SESSION['error_msg'] = $msg;
    header("Location: $location");
}

function rememberedUser($conn)
{
    $token = $_COOKIE['remember_token'];

    $sql = "SELECT * FROM `users` WHERE `Token` = :token ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':token' => $token]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count === 1) {
        $userName =  $data['First Name'];
        $userId = $data['id'];
        return array($userId, $userName);
    }
}
function showAllCars()
{
    require 'db.php';
    $stmt = $conn->prepare("SELECT * FROM `cars`");
    $stmt->execute();
    $cars = $stmt->fetchAll(PDO::FETCH_OBJ);

    foreach ($cars as $car) {
        echo " 
        <div class='group rounded-xl bg-white p-5 shadow-shadow-1 relative  overflow-hidden'>
        <div class='group-hover:opacity-100 absolute w-full h-full backdrop-blur-[2px] grid place-content-center inset-0 opacity-0 transition-opacity duration-500 show'>
        <i class='fa-solid fa-eye cursor-pointer text-3xl text-white ' id='show_car_view'></i>
        </div>
                <div class='mb-3 flex items-center justify-between'>
                <h4 class='font-bold text-grey-900 carName'>$car->name</h4>
                <div class='grid place-content-center w-8 h-8 rounded-full bg-grey-500 p1 transition-colors duration-500 relative'>
                <i class='fa-solid fa-cart-plus cursor-pointer text-lg text-white' id='addToCart'></i>
                </div>
            </div>
            <p class='font-semibold text-grey-500 carType'>$car->type</p>
            <img src='$car->image' alt='' class='mx-auto my-3 h-28 ' />
            <div class='flex items-center justify-between gap-3 mb-4'>
                
                    <span class='font-semibold text-grey-500 carCapacity'>
                        <i class='fa-solid fa-user mr-2 text-primary-500'></i>
                        $car->capacity
                    </span>
                    <div class='flex items-center'>
                        <img src='imgs/icons8-gear-stick-50.png' alt='' class='mr-1 h-5 w-5' />
                        <span class='font-semibold text-grey-500 carGearShift'>$car->gearShift</span>
                    </div>
                    </div>
                    <div class='flex items-center justify-between'>
                    <span class='font-bold text-grey-900 carPrice'>$$car->price</span>
                    <span class='font-bold text-grey-600 carRec'><i class='fa-solid fa-thumbs-up me-2 text-primary-500'></i> $car->customRecommendation </span>
                    </div>
        </div>";
    }
    // CLose the connection
    $conn = null;
}
function countCarsByType($value)
{
    require 'db.php';
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM `cars` WHERE type = :value ");
    $stmt->execute([':value' => $value]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['total'];
    echo  $count;
    // CLose the connection
    $conn = null;
}

function capacityGt6()
{
    require 'db.php';
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM `cars` WHERE capacity >= 6 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['total'];
    echo  $count;
    // CLose the connection
    $conn = null;
}
function capacityGt2AndLs5()
{
    require 'db.php';
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM `cars` WHERE capacity >= 2 AND capacity <= 5 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['total'];
    echo  $count;
    // CLose the connection
    $conn = null;
}
function customRecGt70()
{
    require 'db.php';
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM `cars` WHERE customRecommendation >= 70 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['total'];
    echo  $count;
    // CLose the connection
    $conn = null;
}
function customRecBt40And70()
{
    require 'db.php';
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM `cars` WHERE customRecommendation >= 40 AND customRecommendation <= 69 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['total'];
    echo  $count;
    // CLose the connection
    $conn = null;
}
function customRecLt39()
{
    require 'db.php';
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM `cars` WHERE customRecommendation <= 39 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['total'];
    echo  $count;
    // CLose the connection
    $conn = null;
}
// Check if cart is empty
function isCartEmpty($conn)
{

    $stmt = $conn->prepare('SELECT * FROM carts');
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
        return false;
    } else {
        return true;
    }
}
// Get Count of cart items
function countCartItems($conn, $userId)
{
    if (isCartEmpty($conn) == false) {
        $stmt = $conn->prepare('SELECT COUNT(*) as Count FROM carts WHERE user_id = :userId GROUP BY user_id');
        $stmt->execute(['userId' => $userId]);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results['Count'];
    }
}
