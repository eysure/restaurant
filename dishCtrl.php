<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 4/13/18
 * Time: 9:59 AM
 */

include 'database.php';
session_start();

// Answer User call
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    switch ($_POST['action']) {
        case 'getDishes': echo json_encode((object)['action' => $_POST['action'], 'data' => getDishesDB()]); break;
        case 'getCart': echo json_encode((object)['action' => $_POST['action'], 'data' => getCart()]); break;
        case 'addToCart': addToCart($_POST['dish'],$_POST['quantity']); break;
        default: break;
    }
}
else header("Location: index.php");

function addToCart($dish_id, $quantity) {
    if(!isset($_SESSION['username'])){
        echo json_encode((object)[
            'action' => 'addToCart',
            'result'=> false,
            'reason' => 1
        ]); exit(0);
    }
    else {
        $cart = addToCartDB($dish_id, $quantity, $_SESSION['user_id']);
        echo json_encode((object)[
            'action' => 'addToCart',
            'result' => true,
            'cart' => $cart
        ]); exit(0);
    }
}

function getCart() {
    if(!isset($_SESSION['username'])){
        return null;
    }
    else {
        return getCartDB($_SESSION['user_id']);
    }
}