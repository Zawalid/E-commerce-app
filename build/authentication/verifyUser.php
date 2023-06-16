<?php
require '../db.php';
require '../utilities.php';
session_start();

if (rememberedUser($conn)) {
    $_SESSION['userName'] = rememberedUser($conn)[1];
    $_SESSION['userId'] = rememberedUser($conn)[0];
    header("Location: ../main.php");
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rememberMe = $_POST["rememberMe"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        showError("Invalid Email: Retry with a valid email.", "login.php");
    } else {
        $sql = "SELECT * FROM `users` WHERE `email` = :email AND `password` = :password";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':email' => $email, ':password' => $password]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count == 1) {
            foreach ($data as $key) {
                $_SESSION['userName'] = ($key['First Name']);
                $_SESSION['userId'] = ($key['id']);
                $_SESSION['isAdmin'] = ($key['is_admin']);
                $sql = 'UPDATE users SET Token = :token WHERE id = :id';
                $stmt = $conn->prepare($sql);
                $token = bin2hex(random_bytes(32));
                $stmt->execute([':token' => $token, ':id' => $key['id']]);
            }
            if (isset($rememberMe)) {
                setcookie('remember_token', $token, time() + 86400 * 7, '/', '', true, true);
            }
            header("Location: ../main.php");
        } else {
            $_SESSION['email'] = $email;

            showError("Invalid Email or Password: Try again.", "login.php");
        }
    }
}

// CLose the connection
$conn = null;
