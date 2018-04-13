<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 4/13/18
 * Time: 9:59 AM
 */

include 'Database.php';

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
    $criStr = 'true';
    $con = getConnection();
    $query = "SELECT * FROM dish WHERE $criStr";
    $result = mysqli_query($con,$query);
    return mysqli_fetch_all($result,MYSQLI_ASSOC);
}