/**
 * This file contain client login form process
 * Created by PhpStorm.
 * User: henry
 * Date: 3/12/18
 * Time: 19:30
 */

if (typeof(signUpValidation) === "undefined")signUpValidation = {
    email: false,
    pwd_s: false,
    username_s: false,
    first_name: false,
    last_name: false,
    mobile: false,
    email_server: false,
    username_server: false,
    mobile_server: false
};

$(document).ready(function() {
    // AUTO FOCUS
    $('#loginModal')
        .on('shown.bs.modal', function () {
            $('#username').trigger('focus');
        });
    $('#signUpModal')
        .on('shown.bs.modal', function () {
            $('#username_s').trigger('focus');
        });

    // SIGN UP VALIDATION HOOKS
    $('div.sign-up-div').each(function() {
        let div = $(this);
        div.find('input').each(function(){
            $(this)
                .on('input',function(e){signUpFieldLocalValidation($(this),div);})
                .on('blur',function(e){signUpFieldServerValidation($(this),div);});
        });
    })
});

// ---------------------------------------------------------------------------------------------------------------------    AJAX

/**
 * Send universal ajax to user.php
 * @param action: 'signUpTest' / 'signUp' / 'login' / 'logout'
 * @param data
 * @returns object
 */
function sendAjax(action,data=null) {
    $.ajax({
        type: 'POST',
        data: {
            action: action,
            data: data
        },
        url: 'user.php',
        success: function(res) {
            receiveAjaxResponse(res);
        }
    });
}

/**
 * Receive AJAX response from server
 * @param res
 */
function receiveAjaxResponse(res) {
    res = JSON.parse(res);
    switch(res['action']) {
        case 'login': loginResponse(res);break;
        case 'logout': window.location.reload();break;
        default: console.log("UNKNOWN RESPONSE: ",res);
    }
}

// ---------------------------------------------------------------------------------------------------------------------    LOGIN (REQ/RES)

/**
 * Deal with login ajax logic.
 */
function loginAjax() {
    let username = $('input#username').val();
    let pwd = $('input#pwd').val();
    if(username==="" || pwd==="") {
        loginResponse({status:-1});
        return false;
    }
    sendAjax('login',{
        'username': username,
        'password': sha256(pwd)
    });
    return false;   // Prevent auto refresh
}

/**
 * login php response, process the client side
 * @param resJSON login status response by server side php (user.php)
 */
function loginResponse(resJSON) {
    let loginBadge = $('#login-badge');
    switch(resJSON['status']){
        case -1: changeBadge(loginBadge,'Oops, please fill in both fields.','error');break;
        case 0: {
            changeBadge(loginBadge,'Login succeed. Welcome back!','succeed');
            window.location.reload(false);break;
        }
        case 1: changeBadge(loginBadge,'Oops, wrong password or account is not exist, try again?','error');break;
        case 2: changeBadge(loginBadge,'Sorry, your account is locked. Please refer to Customer Service.','error');break;
        default: changeBadge(loginBadge,'Unknown status, Login failed. Please refer to Customer Service.','error');break;
    }
}

// ---------------------------------------------------------------------------------------------------------------------    SIGN UP VALIDATION

/**
 * Sign Up field local validation
 * @param input
 * @param signUpDiv
 * @return boolean
 */
function signUpFieldLocalValidation(input, signUpDiv) {
    let regex=/^.*$/,errorMsg="Unknown error";
    switch(input.attr("id")) {
        case "email": {
            regex = /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;
            errorMsg = "Please input valid email address: name@example.com";
            break;
        }
        case "pwd_s": {
            regex = /^(?=.*[A-Za-z]).{8,}$/;
            errorMsg = "Password is too weak, it's insecure.";
            break;
        }
        case "username_s": {
            regex = /^[A-Za-z_][A-Za-z_\-0-9]{4,}$/;
            errorMsg = "Make your username more than 5 characters.";
            break;
        }
        case "first_name": {
            regex = /^[A-Za-z]+$/;
            errorMsg = "Please input your first name.";
            break;
        }
        case "last_name": {
            regex = /^[A-Za-z]+$/;
            errorMsg = "Please input your last name.";
            break;
        }
        case "mobile": {
            regex = /^\d{10}$/;
            errorMsg = "Please input valid 10 digits phone number.";
            break;
        }
        default: break;
    }

    if(regex.exec(input.val())) {
        inputDivStatusChange(signUpDiv,"","succeed");
        signUpValidation[input.attr('id')]=true;
        signUpButtonValidation();
    }
    else {
        inputDivStatusChange(signUpDiv,errorMsg,"error");
        signUpValidation[input.attr('id')]=false;
        signUpButtonValidation();
    }
}

function signUpFieldServerValidation(input, signUpDiv) {
    switch(input.attr("id")) {
        case "email": sendAjax("signUpTest",{testField:"email",value:input.val()});break;
        case "username_s": sendAjax("signUpTest",{testField:"username",value:input.val()});break;
        case "mobile": sendAjax("signUpTest",{testField:"mobile",value:input.val()});break;
        default: break;
    }
}

function signUpButtonValidation() {
    let result = false;
    for(let key in signUpValidation) {
        if(!signUpValidation[key]){
            result = false;
            break;
        }
        else result = true;
    }
    $("#sign-up-btn").attr("disabled",!result);
}

// ---------------------------------------------------------------------------------------------------------------------    UI

/**
 * Change input status both input and badge
 * @param inputDiv
 * @param msg
 * @param status
 */
function inputDivStatusChange(inputDiv, msg, status){
    let input = inputDiv.find('input');
    let badge = inputDiv.find('small');
    changeBadge(badge,msg,status);
    changeInput(input,status);
}

/**
 * Show badge with specific badge-id, msg and type
 * @param badge: badge need to change
 * @param msg: message want to be shown
 * @param type: 'error'->red / 'succeed'->green
 */
function changeBadge(badge, msg, type='badge-secondary') {
    if(msg==='' || msg===null) badge.fadeOut(300);
    else {
        badge
            .removeClass()
            .addClass('badge')
            .addClass(type)
            .text(msg);
        if(badge.css('display')==='none') badge.fadeIn(300);
    }
}

/**
 * Change input line color
 * @param input
 * @param type
 */
function changeInput(input,type='') {
    input
        .removeClass()
        .addClass('form-control')
        .addClass('lined')
        .addClass(type);
}

/**
 * Switch login modal with Signup modal
 */
function loginSignUpModalToggle(bool) {
    if(bool){
        $('#signUpModal')
            .on('shown.bs.modal', function () {
                $('#email').trigger('focus');
            })
            .modal('show');
        $('#loginModal').modal('hide');
    }
    else {
        $('#loginModal')
            .on('shown.bs.modal', function () {
                $('#username').trigger('focus');
            })
            .modal('show');
        $('#signUpModal').modal('hide');
    }
}