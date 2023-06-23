<?php
require 'db.php';
require 'utilities.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $action = $_POST['action'];

    if ($action === 'save') {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        move_uploaded_image();
        try {
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
        } catch (PDOException $e) {
            echo "email already exists";
        }
        $sql = "SELECT * FROM `users` WHERE `id` = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $_SESSION['userId']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        setUserSession($user);
    } elseif ($action === 'changePassword') {
        $sql = 'SELECT password FROM users WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $_SESSION['userId']]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $currentPassword = $_POST['currentPassword'];
        // Check if the current password is correct
        if (!password_verify($currentPassword, $res['password'])) {
            echo "wrong password";
            exit;
        }
        // Check if the new password is the same as the current password
        $newPassword = $_POST['newPassword'];
        if ($newPassword === $currentPassword) {
            echo "passwords are the same";
            exit;
        }
        // Check if the new password and the confirm password are the same
        $confirmPassword = $_POST['confirmPassword'];
        if ($newPassword !== $confirmPassword) {
            echo "passwords don't match";
            exit;
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = 'UPDATE users SET password = :password WHERE id = :id';
        $stmt = $conn->prepare($sql);
        $stmt->execute([':password' => $hashedPassword, ':id' => $_SESSION['userId']]);

        $_SESSION['password_changed'] = true;
    }
}
