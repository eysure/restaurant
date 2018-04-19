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
        case 'getDishes': echo json_encode((object)['action' => $_POST['action'], 'data' => getDishes()]); break;
        case 'getCart': echo json_encode((object)['action' => $_POST['action'], 'data' => getCart()]); break;
        case 'addToCart': addToCart($_POST['dish'],$_POST['quantity']); break;
        case 'addDish': addDish($_POST['dish']); break;
        case 'updateDish': updateDish($_POST['dish']); break;
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

function getDishes() {
    if(isset($_SESSION['role'])) {
        switch ($_SESSION['role']) {
            case 1: return getDishesDB();
            case 1024: return getDishesDB();
            default: return getDishesDB("WHERE availability=1");   // As normal user
        }
    }
    // Not login
    else return getDishesDB("WHERE availability=1");
}

function getCart() {
    if(!isset($_SESSION['username'])){
        return null;
    }
    else {
        return getCartDB($_SESSION['user_id']);
    }
}

function addDish($dish) {
    if(!isset($_SESSION['username'])) {
        echo json_encode((object)['action' => 'addDish', 'result' => false, 'error'=>1]);
    }
    else if(!isset($_SESSION['role']) || $_SESSION['role']!=1) {
        echo json_encode((object)['action' => 'addDish', 'result'=>false, 'error'=>2]);
    }
    else {
        $error = addDishDB($dish);
        echo json_encode((object)['action' => 'addDish', 'result'=>true, 'mysql_error'=>$error]);
    }
}

function updateDish($dish) {
    if(!isset($_SESSION['username'])) {
        echo json_encode((object)['action' => 'updateDish', 'result'=>false, 'error'=>1]);
    }
    else if(!isset($_SESSION['role']) || $_SESSION['role']!=1) {
        echo json_encode((object)['action' => 'updateDish', 'result'=>false, 'error'=>2]);
    }
    else {
        $error = updateDishDB($dish);
        echo json_encode((object)['action' => 'updateDish', 'result'=>true, 'mysql_error'=>$error]);
    }
}