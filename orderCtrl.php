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
    $u_id = $_SESSION['user_id'];

    $all_info = [];
    $order_id = [];
    $dish_detail = [];
    $query1 = "SELECT * FROM restaurant.order WHERE user_id = $u_id";
    $result1 = mysqli_query($con,$query1);
    while($row = mysqli_fetch_assoc($result1)){
        array_push($all_info, $row);
        array_push($order_id, $row['order_id']);
    }
    foreach($order_id as $oid){
        $query2 =
            "SELECT o.order_id, d.name, o.dish_quantity
            FROM restaurant.dish AS d
            RIGHT JOIN restaurant.ordered_dish_qty AS o
            ON d.id = o.dish_id
            WHERE o.order_id = $oid";
        $result2 = mysqli_query($con,$query2);
        while($row = mysqli_fetch_assoc($result2)){
            array_push($dish_detail, $row);
        }
    }
    return ((object)['arr1' => $all_info, 'arr2' => $dish_detail]);
}