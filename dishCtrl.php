<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 4/13/18
 * Time: 9:59 AM
 */

include 'database.php';

// Answer User call
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    switch ($_POST['action']) {
        case 'getDishes':
            echo json_encode((object)['action' => $_POST['action'], 'data' => getDishes()]); break;
        default: break;
    }
}
else header("Location: index.php");

/**
 * Get dishes from database and convert to object array
 */
function getDishes() {
    $con = getConnection();
    $query = "SELECT * FROM dish";
    $result = mysqli_query($con,$query);

    $dish_arr = [];
    while($row=mysqli_fetch_assoc($result)){
        array_push($dish_arr, $row);
    }
    return $dish_arr;
}