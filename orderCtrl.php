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
    echo json_encode((object)['action' => $_POST['action'], 'error' => 1]);
    exit(0);
}
else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        switch ($_POST['action']) {
            case 'getOrders':
                echo json_encode((object)['action' => $_POST['action'], 'error' => 0, 'data' => getOrders()]);
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
    $u_id = $_SESSION['user_id'];

    //Query for order details
    $query1 = "SELECT * FROM restaurant.order WHERE user_id=$u_id";
    $result1 = mysqli_query($con,$query1);

    $order_detail = [];
    $order_id = [];
    while($row = mysqli_fetch_assoc($result1)){
        array_push($order_detail, $row);
        array_push($order_id, $row['order_id']);
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