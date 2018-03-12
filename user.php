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

// Session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Judge which action is requested by user
    if($_POST['action']=='login') login($_POST['username'],$_POST['pwd']);
    elseif($_POST['action']=='signUp') signUp($_POST['username_s'],$_POST['pwd1_s'],$_POST['pwd2_s']);
}

/**
 * Insert a User Button
 * @return null
 */
function insertUserButton() {
    if (!isset($_SESSION['username'])) {
        // User is not login
        echo "
        <button class='user-btn btn btn-outline-light' id='user-btn' data-toggle='modal' data-target='#loginModal'><i class='material-icons'>play_for_work</i></button>
        ";
    }
    else {
        // User is login
        echo "
        <button class='user-btn btn btn-outline-light' id='user-btn'><i class='material-icons'>account_circle</i></button>
        ";
    }
    echo "
        <style>
        button.user-btn {
            display: flex;
            display: -webkit-flex;
            align-items: center;
            line-height: 0;
            border: 0;
            padding: 2px;
        }
        button.user-btn i {
            font-size: 2em;
        }
        </style>
    ";
    return null;
}

/**
 * Insert a login modal on the top of the page
 */
function insertLoginModal() {
    echo "
        <script src='sha256.js'></script>
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
                                <div style='display: none;' id='login-status' class='badge badge-danger'>
                                    Wrong password or account doesn't exist.
                                </div>
                                <small id='createAccountHelper' class='form-text text-muted'>
                                    First come? <a href='#' onclick='switchToSignUp()'>Create Account</a>
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
        function loginAjax() {
             var data = {
                 'action': 'login',
                 'username': $('input#username').val(),
                 'pwd': sha256($('input#pwd').val())
             };
             
             $.ajax({
                 type: 'POST',
                 data: data,
                 url: 'user.php',
                 success: function (d) {
                     console.log('ajax: succeed!');
                     console.log(d);
                 },
                 timeout: 2000
             });
             
             return false;
        }
        
        function switchToSignUp() {
            $('#loginModal').modal('hide');
            $('#signUpModal')
                .on('shown.bs.modal', function () {
                    $('#username_s').trigger('focus');
                })
                .modal('show');
        }
        </script>
    ";
    insertSignUpModal();
}

/**
 * Insert a Sign Up modal
 */
function insertSignUpModal() {
    echo "
        <script src='sha256.js'></script>
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
                                <small id='switchToLoginHelpBlock' class='form-text text-muted'>
                                    Already have an account? <a href='#' onclick='switchToLogin()'>Login</a>
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
        function signUpAjax() {
            console.log('Sorry, SignUp function is in construction. Please come later.');
            alert('Sorry, SignUp function is in construction. Please come later.');
            return false;
        }
        
        function switchToLogin() {
            $('#signUpModal').modal('hide');
            $('#loginModal')
                .on('shown.bs.modal', function () {
                    $('#username').trigger('focus');
                })
                .modal('show');
        }
        </script>
    ";
}

/**
 * Deal with login request
 * @param $input_username: User input username
 * @param $input_pwd: user input password
 */
function login($input_username, $input_pwd) {
    $username = htmlspecialchars(strtolower($input_username));
    $pwd = hash('sha256',$input_pwd);

    $user = loginDB($username,$pwd);

    if($user) {
        echo "php: connection ok.";
    }
    else echo "php: connection not ok!";

    if($user) {
        echo "php: succeed!";
    }
    else echo "php failed!";

}

/**
 * Deal with sign up request
 * @param $input_username
 * @param $input_pwd1
 * @param $input_pwd2
 */
function signUp($input_username,$input_pwd1,$input_pwd2) {

}
