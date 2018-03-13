<?php
/**
 * This file deal with user logic, including sign in and sign up
 * Created by PhpStorm.
 * User: henry
 * Date: 3/10/18
 * Time: 17:55
 */

include 'database.php';
include 'test.php';

session_start();
answerRequest();

/**
 * Insert a User Button
 */
function insertUserButton() {
    if (!isset($_SESSION['username'])) {
        // User is not login
        echo "
        <button class='user-btn btn btn-outline-light' id='user-btn' data-toggle='modal' data-target='#loginModal'><i class='material-icons'>play_for_work</i><span>Login</span></button>
        ";
    }
    else {
        // User is login
        echo "
        <div class='dropdown'>
        <button class='user-btn btn btn-outline-light dropdown-toggle' id='user-btn' data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"><i class='material-icons'>account_circle</i><span>".$_SESSION['username']."</span></button>
        <div class=\"dropdown-menu\" aria-labelledby=\"user-btn\">
            <a class=\"dropdown-item\" href='order.php'><i class='material-icons'>description</i>My orders</a>
            <a class=\"dropdown-item\" href='cart.php'><i class='material-icons'>shopping_cart</i>My Cart</a>
            <div class=\"dropdown-divider\"></div>
            <a class='dropdown-item' href='#' onclick='return logoutAjax()'><i class='material-icons'>exit_to_app</i>Logout</a>
            <script src='user.js'></script>
        </div>
        </div>
        ";
    }
}

/**
 * Insert a login modal on the top of the page
 */
function insertLoginModal() {
    echo "
        <script src='sha256.js'></script>
        <script src='user.js'></script>
        <div class='modal fade' id='loginModal' tabindex='-1' role='dialog' aria-labelledby='loginModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-sm' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h4 style='margin: 0;'>Login</h4>
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <form class='form-group' id='login-form' onsubmit='return loginAjax()' method='post'>
                            <div class='form-group'>
                                <label for='pwd'>Username</label>
                                <input class='form-control' type='text' id='username' name='username' placeholder='Username'>
                            </div>
                            <div class='form-group'>
                                <label for='pwd'>Password</label>
                                <input class='form-control' type='password' id='pwd' name='pwd' placeholder='Password'>
                            </div>
                            <div class='form-group'>
                                <input class='form-control btn btn-primary' type='submit' value='Login'>
                                <div style='display: none;' id='login-badge' class='badge'>
                                    Login message.
                                </div>
                                <small id='createAccountHelper' class='form-text text-muted'>
                                    First come? <a href='#' onclick='loginSignUpModalToggle(true)'>Create Account</a>
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    ";
    insertSignUpModal();
}

/**
 * Insert a Sign Up modal
 */
function insertSignUpModal() {
    echo "
        <script src='sha256.js'></script>
        <script src='user.js'></script>
        <div class='modal fade' id='signUpModal' tabindex='-1' role='dialog' aria-labelledby='signUpModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-sm' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h4 style='margin: 0;'>SignUp</h4>
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <form class='form-group' id='sign-up-form' onsubmit='return signUpAjax()' method='post'>
                            <div class='form-group'>
                                <label for='username'>Username</label>
                                <input class='form-control' type='text' id='username_s' name='username_s' placeholder='Username'>
                            </div>
                            <div class='form-group'>
                                <label for='pwd'>Password</label>
                                <input class='form-control' type='password' id='pwd1_s' name='pwd1_s' placeholder='Password'>
                                <input class='form-control' type='password' id='pwd2_s' name='pwd2_s' placeholder='Re-type Password'>
                                <small id='passwordHelpBlock' class='form-text text-muted'>
                                    Password should at least 6 digits, including at least 1 letter.
                                </small>
                            </div>
                            <div class='form-group'>
                                <input type='hidden' name='action' value='signUp'/>
                                <input class='form-control btn btn-primary' type='submit' value='Sign Up'>
                                <div style='display: none;' id='sign-up-badge' class='badge'>
                                    Sign Up message.
                                </div>
                                <small id='switchToLoginHelpBlock' class='form-text text-muted'>
                                    Already have an account? <a href='#' onclick='loginSignUpModalToggle(false)'>Login</a>
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    ";
}

// -----------SERVER SIDE-----------

/**
 * Response the user HTTP request
 * Judge which action is requested by user
 */
function answerRequest() {
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        switch ($_POST['action']) {
            case 'login': login($_POST['username'],$_POST['pwd']);break;
            case 'signUp ': signUp($_POST['username_s'],$_POST['pwd1_s'],$_POST['pwd2_s']);break;
            case 'logout': logout();break;
            default: break;
        }
    }
}

/**
 * Deal with login request
 * @param $input_username: User input username
 * @param $input_pwd: user input password
 */
function login($input_username, $input_pwd) {
    $username = htmlspecialchars(strtolower($input_username));
    $pwd = htmlspecialchars($input_pwd);
    $result = loginDB($username,$pwd);

    if(!$result) {
        // Wrong password or no account
        $res = (object) [
            'status' => 1
        ];
    }
    else if($result['status']==0) {
        // Account is disabled
        $res = (object) [
            'status' => 2
        ];
    }
    else {
        // Login successful
        $res = (object) [
            'status' => 0
        ];

        // Write session
        session_regenerate_id();
        $_SESSION['login_time'] = time();
        $_SESSION['username'] = $username;
        session_write_close();
    };
    echo json_encode($res);
    exit(0);
}

/**
 * Deal with sign up request
 * @param $input_username
 * @param $input_pwd1
 * @param $input_pwd2
 */
function signUp($input_username,$input_pwd1,$input_pwd2) {
    exit(0);
}

/**
 * Let user logout
 */
function logout() {
    session_start();
    session_destroy();
    header("Location: index.php");
    exit(0);
}