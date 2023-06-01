<?php
require 'db.php';


$email = $_POST['email'];
$password = $_POST['password'];

session_start();

$sql = "SELECT * FROM `users` WHERE `email` = :email AND `password` = :password";
$stmt = $conn->prepare($sql);
$stmt->execute([':email' => $email, ':password' => $password]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
if ($count == 1) {
    foreach ($data as $key) {
        $_SESSION['userName'] = ($key['First Name']);
    }
    header("Location: index.php");
} else {
    $_SESSION['email'] = $email;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        showError("Invalid email address", "login.php");
    } else {
        showError("Invalid email or password", "login.php");
    }
}
