<?php
require 'db.php';
require 'utilities.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];


    move_uploaded_image();


    if (empty($_FILES['Image']['name'])) {
        $sql = "UPDATE users SET `First Name` = :firstName , `Last Name` = :lastName , Email = :email , phone = :phone , address = :address WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':firstName' => $firstName, ':lastName' => $lastName, ':email' => $email, ':phone' => $phone, ':address' => $address, ':id' => $_SESSION['userId']]);
    } else {
        $image = './imgs/' . $_FILES["Image"]["name"];

        $sql = "UPDATE users SET `First Name` = :firstName , `Last Name` = :lastName , Email = :email , phone = :phone , address = :address , image = :image WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':firstName' => $firstName, ':lastName' => $lastName, ':email' => $email, ':phone' => $phone, ':address' => $address, ':image' => $image, ':id' => $_SESSION['userId']]);
    }
    $sql = "SELECT * FROM `users` WHERE `id` = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $_SESSION['userId']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    setUserSession($user);
    print_r($_SESSION);
}

//
//     $sql = 'UPDATE cars SET name = :name , type = :type , capacity = :capacity , transmission = :transmission , price = :price WHERE id = :id';
//     $stmt = $conn->prepare($sql);
//     $stmt->execute(['id' => $id, ':name' => $name, ':type' => $type, ':capacity' => $capacity, ':transmission' => $transmission, ':price' => $price]);
// } else {
//     $sql = 'UPDATE cars SET name = :name , type = :type , capacity = :capacity , transmission = :transmission , price = :price , image = :image WHERE id = :id';
//     $stmt = $conn->prepare($sql);
//     $stmt->execute(['id' => $id, ':name' => $name, ':type' => $type, ':capacity' => $capacity, ':transmission' => $transmission, ':price' => $price, ':image' => $image]);
// }
