<?php
/**
 * Deal with database logic
 * Created by PhpStorm.
 * User: henry
 * Date: 3/11/18
 * Time: 00:10
 */

/**
 * Get MySQL connection
 * @return mysqli MySQL Connection
 */
function getConnection() {
    return mysqli_connect("eys.red","restaurant","CS6314","restaurant");
}

/**
 * Database action: login
 * @param $username: username
 * @param $hashed_pwd: user input password SHA256 hashed
 * @return array: user info
 */
function loginDB($username, $hashed_pwd) {
    $con = getConnection();
    $username = mysqli_real_escape_string($con, $username);
    $hashed_pwd = mysqli_real_escape_string($con, $hashed_pwd);
    $query = "SELECT username,status,role FROM user WHERE username='$username' AND pwd='$hashed_pwd'";
    $result = mysqli_query($con,$query);
    return mysqli_fetch_array($result);
}

//function signUpDB($username, $hashed_pwd) {
//    $con = getConnection();
//    $username = mysqli_real_escape_string($con, $username);
//    $hashed_pwd = mysqli_real_escape_string($con, $hashed_pwd);
//    $query = "SELECT username FROM user WHERE username='$username' AND pwd='$hashed_pwd'";
//    $result = mysqli_query($con,$query);
//    if($result->num_rows ==0) return false;
//    else return true;
//}