<?php
require 'db.php';
require 'utilities.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    $carTypes = $data['type'];
    $carCapacity = $data['capacity'];
    $carTransmission = $data['transmission'];
    $carPrice = $data['price'];
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
    // If there is transmission filter
    if (!empty($carTransmission) && count($carTransmission) === 1) {
        $carTransmission[0] === "Manual" ?
            $sql .= " AND transmission = 'Manual' " :
            $sql .= " AND transmission = 'Automatic' ";
    }
    // If there is price filter
    $priceConditions = [];
    foreach ($carPrice as $option) {
        switch ($option) {
            case "20k - 40k":
                $priceConditions[] = "price >= 20000 AND price <= 40000";
                break;
            case "45k - 65k":
                $priceConditions[] = "price >= 45000 AND price <= 65000";
                break;
            case "150k - 500k":
                $priceConditions[] = "price >= 150000 AND price <= 500000";
                break;
        }
    }
    if (!empty($carPrice)) {
        if (count($priceConditions) === 1) {
            $sql .= " AND " . $priceConditions[0];
        } else {
            $sql .= " AND (" . implode(" OR ", $priceConditions) . ")";
        }
    }
    // If there is custom recommendation  filter
    $cusRecConditions = [];
    foreach ($customRecommendation as $option) {
        switch ($option) {
            case "70 - 100%":
                $cusRecConditions[] = "customRecommendation >= 70";
                break;
            case "40 - 69%":
                $cusRecConditions[] = "customRecommendation >= 40 AND customRecommendation <= 69";
                break;
            case "0 - 39%":
                $cusRecConditions[] = "customRecommendation <= 39";
                break;
        }
    }
    if (!empty($customRecommendation)) {
        if (count($cusRecConditions) === 1) {
            $sql .= " AND " . $cusRecConditions[0];
        } else {
            $sql .= " AND (" . implode(" OR ", $cusRecConditions) . ")";
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
            <div class='group rounded-xl bg-white p-5 shadow-shadow-1 relative  overflow-hidden'>
            <div class='group-hover:opacity-100 absolute w-full h-full backdrop-blur-[2px] grid place-content-center inset-0 opacity-0 transition-opacity duration-500 show'>
            <i class='fa-solid fa-eye cursor-pointer text-3xl text-white drop-shadow-[0px_0px_4px_#0005]' id='show_car_view'></i>
            </div>
                    <div class='mb-3 flex items-center justify-between'>
                    <h4 class='font-bold text-grey-900 carName'>$car->name</h4>
                    <div class='grid place-content-center w-8 h-8 rounded-full bg-grey-500 p1 transition-colors duration-500 relative'>
                    <i class='fa-solid fa-cart-plus cursor-pointer text-lg text-white' id='addToCart'></i>
                    </div>
                </div>
                <p class='font-semibold text-grey-500 carType'>$car->type</p>
                <img src='$car->image' alt='' class='mx-auto my-3 h-28 object-contain' />
                <div class='flex items-center justify-between gap-3 mb-4'>
                    
                        <span class='font-semibold text-grey-500 carCapacity'>
                            <i class='fa-solid fa-user mr-2 text-primary-500'></i>
                            $car->capacity
                        </span>
                        <div class='flex items-center'>
                            <img src='imgs/icons8-gear-stick-50.png' alt='' class='mr-1 h-5 w-5' />
                            <span class='font-semibold text-grey-500 carTransmission'>$car->transmission</span>
                        </div>
                        </div>
                        <div class='flex items-center justify-between'>
                        <span class='font-bold text-grey-900 carPrice'>$$car->price</span>
                        <span class='font-bold text-grey-600 carRec'><i class='fa-solid fa-thumbs-up me-2 text-primary-500'></i> $car->customRecommendation </span>
                        </div>
            </div>";
        }
    } else {
        echo "<div class='flex flex-col justify-center items-center h-[830px] max-md:h-[640px]'>
            <img src='./imgs/no result search icon.png' alt='' class='w-64 h-64'>
            <h2 class='text-grey-900 font-bold mb-3 text-lg'>No Result Found</h2>
            <h3 class=' font-bold text-grey-500'>
              We couldn't find any car matching your search
              </h1>
          </div>";
    }
}
// CLose the connection
$conn = null;
