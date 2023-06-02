<?php
require '../db.php';
require '../utilities.php';
session_start();

if (rememberedUser()) {
    $_SESSION['userName'] = rememberedUser();
    header("Location: ../index.php");
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rememberMe = $_POST["rememberMe"];

    $sql = "SELECT * FROM `users` WHERE `email` = :email AND `password` = :password";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':email' => $email, ':password' => $password]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();

    if ($count == 1) {
        foreach ($data as $key) {
            $_SESSION['userName'] = ($key['First Name']);
            $sql = 'UPDATE users SET Token = :token WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $token = bin2hex(random_bytes(32));
            $stmt->execute([':token' => $token, ':id' => $key['id']]);
        }
        if (isset($rememberMe)) {
            setcookie('remember_token', $token, time() + 86400 * 7, '/', '', true, true);
        }
        header("Location: ../index.php");
    } else {
        $_SESSION['email'] = $email;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            showError("Invalid email address", "login.php");
        } else {
            showError("Invalid email or password", "login.php");
        }
    }
}
