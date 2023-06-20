<?php

$username = "root";
$password = "";
$server = "localhost";
$db = "project";

try {
    $conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
