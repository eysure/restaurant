/**
 * This file contain client login form process
 * Created by PhpStorm.
 * User: henry
 * Date: 3/12/18
 * Time: 19:30
 */

/**
 * Deal with login ajax logic.
 * @returns {boolean}
 */
function loginAjax() {
    let data = {
        'action': 'login',
        'username': $('input#username').val(),
        'pwd': sha256($('input#pwd').val())
    };

    $.ajax({
        type: 'POST',
        data: data,
        url: 'user.php',
        success: function (res) {
            let resJSON = JSON.parse(res);
            loginResponse(resJSON);
        },
        timeout: 2000
    });

    return false;
}

/**
 * login php response, process the client side
 * @param resJSON login status response by server side php (user.php)
 */
function loginResponse(resJSON) {

    switch(resJSON['status']){
        case 0: {
            loginShowBadge('Login succeed. Welcome back!','success');
            window.location.reload(false);
            break;
        }
        case 1: {
            loginShowBadge('Wrong password or account is not exist','danger');
            break;
        }
        case 2: {
            loginShowBadge('Sorry, your account is locked. Please refer to Customer Service.','danger');
            break;
        }
        default: {
            loginShowBadge('Unknown status, Login failed. Please refer to Customer Service.','danger');
            break;
        }
    }
}

/**
 * Show login badge with specific msg and type
 * @param msg
 * @param type
 */
function loginShowBadge(msg,type='secondary') {
    $('#login-badge')
        .removeClass()
        .addClass('badge')
        .addClass('badge-'+type)
        .text(msg)
        .show();
}

/**
 * Deal with sign up ajax logic.
 * @returns {boolean}
 */
function signUpAjax() {
    console.log('Sorry, SignUp function is in construction. Please come later.');
    alert('Sorry, SignUp function is in construction. Please come later.');
    return false;
}

/**
 * Deal with logout logic.
 */
function logoutAjax() {
    let data = {
        'action': 'logout'
    };

    $.ajax({
        type: 'POST',
        data: data,
        url: 'user.php',
        success: function(res) {
            location.reload(false);
        }
    });

    return false;
}

/**
 * Switch login modal with Signup modal
 */
function loginSignUpModalToggle(bool) {
    if(bool){
        $('#loginModal').modal('hide');
        $('#signUpModal')
            .on('shown.bs.modal', function () {
                $('#username_s').trigger('focus');
            })
            .modal('show');
    }
    else {
        $('#signUpModal').modal('hide');
        $('#loginModal')
            .on('shown.bs.modal', function () {
                $('#username').trigger('focus');
            })
            .modal('show');
    }
}