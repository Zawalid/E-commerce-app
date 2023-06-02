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
