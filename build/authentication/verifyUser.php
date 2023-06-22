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
    echo $password;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        showError("Invalid Email: Retry with a valid email.", "login.php");
    } else {
        $sql = "SELECT * FROM `users` WHERE `email` = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['userId'] = $user['id'];
            setUserSession($user);
            $sql = 'UPDATE users SET Token = :token WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $token = bin2hex(random_bytes(32));
            $stmt->execute([':token' => $token, ':id' => $user['id']]);
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
