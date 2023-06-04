<?php
require 'db.php';
require 'utilities.php';

function noResults()
{
    echo "<div class='flex flex-col justify-center items-center h-[530px]'>
    <img src='./imgs/no result search icon.png' alt='' class='w-64 h-64'>
    <h2 class='text-grey-900 font-bold mb-3 text-lg'>No Result Found</h2>
    <h3 class=' font-bold text-grey-500'>
      We couldn't find any item matching your search
      </h1>
  </div>";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    $types = $data['type'];
    $capacity = $data['capacity'];
    $searchQuery = $data['query'];

    if (!empty($searchQuery)) {
        count($types) > 0 ?
            $sql = "SELECT * FROM `cars` WHERE `name` LIKE :name AND `type` = :type " :
            $sql = "SELECT * FROM `cars` WHERE `name` LIKE :name ";
        echo $sql;
        $stmt = $conn->prepare($sql);
        $searchQuery .= '%';
        if (count($types) > 0) {
            ($stmt->bindParam(':name', $searchQuery));
            ($stmt->bindParam(':type', $types[0]));
        } else {
            $stmt->bindParam(':name', $searchQuery);
        }
        // $stmt->bindParam(':name', $searchName);
        $stmt->execute();
        $cars = $stmt->fetchAll(PDO::FETCH_OBJ);
        $count = $stmt->rowCount();
        if ($count > 0) {
            foreach ($cars as $car) {
                echo " 
<div class='rounded-xl bg-white p-5 shadow-shadow-1'>
        <div class='mb-3 flex items-center justify-between'>
        <h4 class='font-bold text-grey-900'>$car->name</h4>
        <i class='fa-regular fa-heart cursor-pointer text-lg text-grey-600' id='addToFav'></i>
    </div>
    <p class='font-semibold text-grey-500'>$car->type</p>
    <img src='$car->image' alt='' class='mx-auto my-3 h-28' />
    <div class='flex items-center justify-between'>
        <div class='flex gap-3'>
            <span class='font-semibold text-grey-500'>
                <i class='fa-solid fa-user mr-2 text-primary-500'></i>
                $car->capacity
            </span>
            <div class='flex items-center'>
                <img src='imgs/icons8-gearshift-50.png' alt='' class='mr-1 h-5 w-5' />
                <span class='font-semibold text-grey-500'>$car->gearShift</span>
            </div>
        </div>
        <span class='font-bold text-grey-900'>$$car->price <span class='text-grey-500'>/d</span></span>
    </div>
</div>";
            }
        } else {
            noResults();
        }
    } else {
        showAllProducts();
    }
}
