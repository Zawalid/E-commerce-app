<?php
require 'db.php';
require 'utilities.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    $carTypes = $data['type'];
    $carCapacity = $data['capacity'];
    $customRecommendation =  $data['customRecommendation'];
    $searchQuery = ltrim($data['query']);
    // If there is no filter
    $sql = "SELECT * FROM cars WHERE name LIKE ?";
    // If there is type  filter
    if (!empty($carTypes)) {
        $sql .= " AND type IN (";
        $placeholders = str_repeat('?, ', count($carTypes) - 1) . '?';
        $sql .= $placeholders . ")";
    }
    // If there is capacity  filter
    if (!empty($carCapacity) && count($carCapacity) === 1) {
        $carCapacity[0] === "2 - 5" ?
            $sql .= " AND capacity >= 2 AND capacity <= 5" :
            $sql .= " AND capacity >= 6";
    }
    // If there is custom recommendation  filter
    $conditions = [];
    foreach ($customRecommendation as $option) {
        switch ($option) {
            case "70 - 100%":
                $conditions[] = "customRecommendation >= 70";
                break;
            case "40 - 69%":
                $conditions[] = "customRecommendation >= 40 AND customRecommendation <= 69";
                break;
            case "0 - 39%":
                $conditions[] = "customRecommendation <= 39";
                break;
        }
    }
    if (!empty($customRecommendation)) {
        if (count($conditions) === 1) {
            $sql .= " AND " . $conditions[0];
        } else {
            $sql .= " AND (" . implode(" OR ", $conditions) . ")";
        }
    }
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, '%' . $searchQuery . '%');
    if (!empty($carTypes)) {
        foreach ($carTypes as $index => $type) {
            $stmt->bindValue($index + 2, $type);
        }
    }
    $stmt->execute();
    $cars = $stmt->fetchAll(PDO::FETCH_OBJ);
    $count = $stmt->rowCount();
    if ($count > 0) {
        foreach ($cars as $car) {
            echo " 
 <div class='rounded-xl bg-white p-5 shadow-shadow-1 relative  overflow-hidden'>
        <div class='absolute w-full h-full backdrop-blur-[2px] grid place-content-center inset-0 opacity-0 transition-opacity duration-500 show' id='layer'>
        <i class='fa-solid fa-eye cursor-pointer text-3xl text-white ' id='show_car_view'></i>
        </div>
                <div class='mb-3 flex items-center justify-between'>
                <h4 class='font-bold text-grey-900 carName'>$car->name</h4>
                <div class='grid place-content-center w-8 h-8 rounded-full bg-grey-500 p1 transition-colors duration-500 relative'>
                <i class='fa-solid fa-cart-plus cursor-pointer text-lg text-white' id='addToCart'></i>
                </div>
            </div>
            <p class='font-semibold text-grey-500 carType'>$car->type</p>
            <img src='$car->image' alt='' class='mx-auto my-3 h-28' />
            <div class='flex items-center justify-between gap-3 mb-4'>
                
                    <span class='font-semibold text-grey-500 carCapacity'>
                        <i class='fa-solid fa-user mr-2 text-primary-500'></i>
                        $car->capacity
                    </span>
                    <div class='flex items-center'>
                        <img src='imgs/icons8-gear-stick-50.png' alt='' class='mr-1 h-5 w-5' />
                        <span class='font-semibold text-grey-500 carGearShift'>$car->gearShift</span>
                    </div>
                    </div>
                    <div class='flex items-center justify-between'>
                    <span class='font-bold text-grey-900 carPrice'>$$car->price</span>
                    <span class='font-bold text-grey-600 carRec'><i class='fa-solid fa-thumbs-up me-2 text-primary-500'></i> $car->customRecommendation </span>
                    </div>
        </div>";
        }
    } else {
        echo "<div class='flex flex-col justify-center items-center h-[530px]'>
            <img src='./imgs/no result search icon.png' alt='' class='w-64 h-64'>
            <h2 class='text-grey-900 font-bold mb-3 text-lg'>No Result Found</h2>
            <h3 class=' font-bold text-grey-500'>
              We couldn't find any car matching your search
              </h1>
          </div>";
    }
}
// CLose the connection
// $conn = null;
