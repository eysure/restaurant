<?php
/**
 * Created by PhpStorm.
 * User: hllla
 * Date: 4/13/2018
 * Time: 12:42 PM
 */
include 'database.php';
session_start();

if (!isset($_SESSION['username'])) {
    // User does not log in
    header("Location: index.php");
}
else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        switch ($_POST['action']) {
            case 'getOrders':
                echo json_encode((object)['action' => $_POST['action'], 'data' => getOrders()]);
                break;
            default:
                break;
        }
    }
    else header("Location: index.php");
}

function getOrders() {
    $con = getConnection();
    $all_info = [];
    //Query for order details
    $id = $_SESSION['user_id'];
    $query1 = "SELECT * FROM restaurant.order WHERE user_id = '$id'";
    $result1 = mysqli_query($con,$query1);
    $order_detail = [];
    while($row = mysqli_fetch_assoc($result1)){
        array_push($order_detail, $row);
    }

    //Query for dish quantity
    $query2_1 = "SELECT order_id FROM restaurant.order WHERE user_id = '$id'";
    $result2_1 = mysqli_query($con,$query2_1);
    $order_id = [];
    while($row = mysqli_fetch_assoc($result2_1)){
        array_push($order_id, $row);
    }
    $dish_qty = [];
    foreach($order_id as $oid){
        $query2_2 = "SELECT dish_id, dish_quantity FROM restaurant.ordered_dish_qty WHERE order_id = $oid";
        $result2_2 = mysqli_query($con,$query2_2);
        while($row = mysqli_fetch_assoc($result2_2)){
            array_push($dish_qty, $row);
        }
    }
    return $dish_qty;
    //Query for fees (subtotal & delivery fee)

}