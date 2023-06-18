<?php
require '../db.php';
require '../utilities.php';
session_start();

$_SESSION['firstName'] = $firstName = $_POST['firstName'];
$_SESSION['lastName'] = $lastName = $_POST['lastName'];
$_SESSION['email'] = $email = $_POST['email'];
$password = $_POST['password'];
$repeatPassword = $_POST['repeatPassword'];



$validationSql = "SELECT * FROM `users` WHERE `email` = :email";
$validationStmt = $conn->prepare($validationSql);
$validationStmt->execute([':email' => $email]);
$validationCount = $validationStmt->rowCount();


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    showError("Invalid Email: Retry with a valid email", "signUp.php");
} else if ($validationCount > 0) {
    showError("Email already exists", "signUp.php");
} else if (checkPassword($password) != 'valid') {
    showError(checkPassword($password), "signUp.php");
} else {
    if ($password == $repeatPassword) {
        $sql = "INSERT INTO `users` (`First Name`, `Last Name`, `Email`,`Password`) VALUES (:firstName, :lastName, :email , :password)";
        $stmt = $conn->prepare($sql);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([':firstName' => $firstName, ':lastName' => $lastName, ':email' => $email, ':password' => $password]);
        $count = $stmt->rowCount();
        header("Location: login.php");
    } else {
        showError("Passwords Do Not Match: Please re-enter your password correctly.", "signUp.php");
    }
}

// CLose the connection
$conn = null;
