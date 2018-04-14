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
    $id = $_SESSION['user_id'];
    $query1 = "SELECT * FROM restaurant.order WHERE user_id = '$id'";
    $result1 = mysqli_query($con,$query1);
    $order_id = [];
    while($row = mysqli_fetch_assoc($result1)){
        array_push($order_id, $row);
    }
    return $order_id;
    /**$query2 = "SELECT * FROM order WHERE  user_id = '$id'";
    $result2 = mysqli_query($con,$query2);
    $order_detail = [];
    while($row = mysqli_fetch_assoc($result1)){
        array_push($order_detail, $row);
    }**/
}