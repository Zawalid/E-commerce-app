<?php
require 'db.php';
require 'utilities.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Name'];
    $type = $_POST['Type'];
    $capacity = $_POST['Capacity'];
    $transmission = $_POST['Transmission'];
    $price = $_POST['Price'];
    $image = './imgs/' . basename($_FILES["Image"]["name"]);
    $action = $_POST['action'];

    if (!empty($_FILES['Image']['name'])) {
        // Check if the file is an image
        $allowedTypes = ['image/jpeg', 'image/png', 'image/svg+xml']; // Specify the allowed MIME types
        $fileType = $_FILES["Image"]["type"];

        if (!in_array($fileType, $allowedTypes)) {
            echo "Invalid file type. Only JPEG, PNG, and SVG images are allowed.";
            exit;
        }
        // Move the uploaded image to the imgs directory
        move_uploaded_file($_FILES["Image"]["tmp_name"], $image);
    }
    if ($action == 'add') {
        // Add the car 
        $sql = 'INSERT INTO CARS (name,type,capacity,transmission,price,image) VALUES(:name,:type,:capacity,:transmission,:price,:image)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([':name' => $name, ':type' => $type, ':capacity' => $capacity, ':transmission' => $transmission, ':price' => $price, ':image' => $image]);
    } elseif ($action === 'edit') {
        // Edit the car
        $id = getCarId($conn, $_POST['carName']);
        if (empty($_FILES['Image']['name'])) {
            $sql = 'UPDATE cars SET name = :name , type = :type , capacity = :capacity , transmission = :transmission , price = :price WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->execute(['id' => $id, ':name' => $name, ':type' => $type, ':capacity' => $capacity, ':transmission' => $transmission, ':price' => $price]);
        } else {
            $sql = 'UPDATE cars SET name = :name , type = :type , capacity = :capacity , transmission = :transmission , price = :price , image = :image WHERE id = :id';
            $stmt = $conn->prepare($sql);
            $stmt->execute(['id' => $id, ':name' => $name, ':type' => $type, ':capacity' => $capacity, ':transmission' => $transmission, ':price' => $price, ':image' => $image]);
        }
    }
    // Send the response
    showAllCars();
}
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    $id = getCarId($conn, $data['carName']);
    $selectSql = 'SELECT image FROM cars WHERE id = :id';
    $deleteSql = 'DELETE FROM cars WHERE id = :id';
    foreach ([$selectSql, $deleteSql] as $sql) {
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        if ($sql === $selectSql) {
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            // Delete the image
            if (file_exists($res['image'])) {
                unlink($res['image']);
            }
        }
    }
    // Send the response
    showAllCars();
}
