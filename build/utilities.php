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

function rememberedUser()
{
    require 'db.php';
    $token = $_COOKIE['remember_token'];

    $sql = "SELECT * FROM `users` WHERE `Token` = :token ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':token' => $token]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count === 1) {
        foreach ($data as $key) {
            $username =  ($key['First Name']);
        }
        return $username;
    }
}

function showAllProducts()
{
    require 'db.php';
    $stmt = $conn->prepare("SELECT * FROM `cars`");
    $stmt->execute();
    $cars = $stmt->fetchAll(PDO::FETCH_OBJ);

    foreach ($cars as $car) {
        echo " <div class='rounded-xl bg-white p-5 shadow-shadow-1'>
        <div class='mb-3 flex items-center justify-between'>
        <h4 class='font-bold text-grey-900'>$car->name</h4>
        <div class='grid place-content-center w-8 h-8 rounded-full bg-grey-500 p1 transition-colors duration-500'>
        <i class='fa-solid fa-cart-plus cursor-pointer text-lg text-white' id='addToCart'></i>
        </div>
    </div>
    <p class='font-semibold text-grey-500'>$car->type</p>
    <img src='$car->image' alt='' class='mx-auto my-3 h-28' />
    <div class='flex items-center justify-between gap-3 mb-4'>
            <span class='font-semibold text-grey-500'>
                <i class='fa-solid fa-user mr-2 text-primary-500'></i>
                $car->capacity
            </span>
            <div class='flex items-center'>
                <img src='imgs/icons8-gear-stick-50.png' alt='' class='mr-1 h-5 w-5' />
                <span class='font-semibold text-grey-500'>$car->gearShift</span>
            </div>
            </div>
            <div class='flex items-center justify-between'>
            <span class='font-bold text-grey-700'>$$car->price</span>
            <span class='font-bold text-grey-600'><i class='fa-solid fa-thumbs-up me-2 text-primary-500'></i> $car->customRecommendation </span>
            </div>

</div>";
    }
}
function countProductsByType($value)
{
    require 'db.php';
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM `cars` WHERE type = :value ");
    $stmt->execute([':value' => $value]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['total'];
    echo  $count;
}

function capacityGt6()
{
    require 'db.php';
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM `cars` WHERE capacity >= 6 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['total'];
    echo  $count;
}
function capacityGt2AndLs5()
{
    require 'db.php';
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM `cars` WHERE capacity >= 2 AND capacity <= 5 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['total'];
    echo  $count;
}
function customRecGt70()
{
    require 'db.php';
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM `cars` WHERE customRecommendation >= 70 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['total'];
    echo  $count;
}
function customRecBt40And70()
{
    require 'db.php';
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM `cars` WHERE customRecommendation >= 40 AND customRecommendation <= 69 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['total'];
    echo  $count;
}
function customRecLt39()
{
    require 'db.php';
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM `cars` WHERE customRecommendation <= 39 ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['total'];
    echo  $count;
}
