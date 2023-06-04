<form method="post" enctype="multipart/form-data">
    <input type="file" name="img">
    <input type="submit" value="upload">
</form>

<?php

if (isset($_FILES['img'])) {
    // Access file details
    $file = $_FILES['img'];
    $fileName = $file['name'];
    $fileTmpPath = $file['tmp_name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $uniqueFileName = uniqid() . '.' . $fileExtension;
    $uploadDirectory = './imgs/';
    $destination =  $uploadDirectory . $uniqueFileName;
    move_uploaded_file($fileTmpPath, $destination);
    require 'db.php';
    $stmt = $conn->prepare("INSERT INTO products (image,name) VALUES (:image,:name)");
    $stmt->execute([':image' => $destination, ':name' => $uniqueFileName]);
}
// $sql = "SELECT image FROM products";
// $stmt = $conn->prepare($sql);
// $stmt->execute();
// $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
// foreach ($data as $key) {
//     $imageData = $key['image'];
//     echo "<img src=' $imageData' alt='Image'>";
// }