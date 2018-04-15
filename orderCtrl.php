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

    $query =
        "
            SELECT tmp.order_id, tmp.dish_id, tmp.dish_quantity, tmp.name, o.built_time, o.user_message, o.tip, o.processed_status, o.subtotal, o.delivery_fee
            FROM restaurant.order AS o
            RIGHT JOIN
                (
                    SELECT * 
                    FROM restaurant.dish AS d 
                    RIGHT JOIN restaurant.ordered_dish_qty AS odq
                    ON d.id = odq.dish_id
                ) AS tmp
            ON tmp.order_id = o.order_id
            WHERE o.user_id = $u_id
        ";
    $result = mysqli_query($con,$query);
    while($row = mysqli_fetch_assoc($result)){
        array_push($all_info, $row);
    }
    return $all_info;

    /**
    //Query for order details
    $query1 = "SELECT * FROM restaurant.order WHERE user_id=$u_id";
    $result1 = mysqli_query($con,$query1);
    $order_detail = []; //Combine
    $order_id = [];
    while($row = mysqli_fetch_assoc($result1)){
        array_push($order_detail, $row);
        array_push($order_id, $row['order_id']);
    }

    //Get dish_id + dish_quantity
    $dish_qty = []; //Combine
    $dish_id = [];
    foreach($order_id as $o_id){
        $query2 = "SELECT order_id, dish_id, dish_quantity FROM restaurant.ordered_dish_qty WHERE order_id = $o_id";
        $result2 = mysqli_query($con,$query2);
        while($row = mysqli_fetch_assoc($result2)){
            array_push($dish_qty, $row);
            array_push($dish_id, $row['dish_id']);
        }
    }
    //Get dish name & price
    $dish_detail = []; //Combine
    foreach($dish_id as $d_id){
        $query3 = "SELECT dish.id, dish.name, dish.price FROM restaurant.dish WHERE dish.id = $d_id";
        $result3 = mysqli_query($con,$query3);
        while($row = mysqli_fetch_assoc($result3)){
            array_push($dish_detail, $row);
        }
    }
    //Merge $order_detail, $dish_qty, $dish_detail
    **/

}