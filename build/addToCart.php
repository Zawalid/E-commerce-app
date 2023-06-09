<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    $carName =  $data['carName'];
    // Get car id
    $sql = 'SELECT * from cars WHERE name = :name';
    $stmt = $conn->prepare($sql);
    $stmt->execute([':name' => $carName]);
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    $carId = $results['id'];
    // Get user id
    $token = $_COOKIE['remember_token'];
    $sql = "SELECT id FROM `users` WHERE `Token` = :token ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':token' => $token]);
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    $userId = $results['id'];
    //   Add the product to the carts table
    $sql = 'INSERT INTO carts (user_id , car_id , quantity) VALUES (:user_id , :car_id , 1)';
    $stmt = $conn->prepare($sql);
    $stmt->execute([':user_id' => $userId, ':car_id' => $carId]);
    // Get the cars that are in the cart
    $sql = 'SELECT name , price , image , quantity  FROM cars INNER JOIN carts ON cars.id = carts.car_id';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $carsInCart = $results;
    // Get the number of cars that are in the cart
    $sql = 'SELECT COUNT(*) as Count FROM carts';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    $carsInCartCount = $results['Count'];
    // Send response
    $response = array(
        'cars' => $carsInCart,
        'count' => $carsInCartCount
    );
    echo json_encode($response);
}
