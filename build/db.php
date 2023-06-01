<?php

$username = "root";
$password = "";
$server = "localhost";
$db = "auth";

try {
    $conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Just to include this function in all files
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
  