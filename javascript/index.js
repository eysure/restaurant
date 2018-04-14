let dishes = null;
let cart = null;

$(document).ready(function() {

    // Cart view initialize
    $("#cart-view").mCustomScrollbar({
        theme: "minimal"
    });
    $('#cart-btn').on('click', function () {
        controlCartView();
    });

    // Course detail ON/OFF
    let course_detail = $('#course_detail');
    course_detail.on('show.bs.modal', function (event) {
        let card = $(event.relatedTarget);                    // Button that triggered the modal
        let id = card.data('id');                             // Extract info from data-* attributes

        let thisDish = getDishByID(id);

        // Inflate the modal
        // TODO: Add the admin mode there
        $('#dish-name').text(thisDish['name']);
        $('#dish-img').attr("src",thisDish['photo']);
        $('#dish-description').text(thisDish['description']);
        $('#dish-price').text(thisDish['price']);

        let counter = $('#dish-quantity');
        counter.val(1);                                         // Reset the quantity counter

        // Add to cart
        $('#add-to-cart').on('click', function () {
            addToCart(thisDish,counter.val());
            course_detail.modal('hide');                        // Close the modal
            controlCartView(1);                                 // Open the cart view
        });

    });
    course_detail.on('hide.bs.modal', function () {
        $('#add-to-cart').off('click');
    });

    // Require all dishes
    $.ajax({
        type: 'POST',
        data: {
            'action': 'getDishes'
        },
        url: 'dishCtrl.php',
        success: function(res) {
            receive(res);
        },
        timeout: 5000
    });
});

function receive(res) {
    try {
        res = JSON.parse(res);
    } catch(err) {
        alert(err);
        alert(res);
    }
    switch (res['action']) {
        case 'getDishes': {
            dishes = res['data'];
            showDishCard(dishes);
            break;
        }
        case 'getCart': {
            cart = res['data'];
            if(cart!==null) updateCart();
            break;
        }
        case 'addToCart': addToCart_res(res); break;
        default: break;
    }
}

function emptyDishCard() {
    $("#dish-list").empty();
}

/**
 * Show all cards of dishes to the dish list
 * TODO: Need to be changed to pagination
 * TODO: Need to merge search
 */
function showDishCard(dishes) {
    for (let dish of dishes) {
        $("#dish-list").append(
            "        <div class='card dish-card' data-toggle='modal' data-target='#course_detail' data-id='"+dish['id']+"'>\n" +
            "            <img class='card-img-top' src='"+dish['photo']+"' alt='food picture'>\n" +
            "            <div class='card-body'>\n" +
            "                <h4 class='card-title'>"+dish['name']+"</h4>\n" +
            "                        <strong>$</strong>\n" +
            "                        <strong>"+dish['price']+"</strong>\n" +
            "            </div>\n" +
            "        </div>");
    }

    // Request Cart
    $.ajax({
        type: 'POST',
        data: {
            'action': 'getCart'
        },
        url: 'dishCtrl.php',
        success: function(res) {
            receive(res);
        },
        timeout: 5000
    });
}

/**
 * Switch of cart view
 * @param mode: 0-close / 1-open / 2-toggle
 */
function controlCartView(mode=2) {
    let ctl = $('#cart-view, #index-view');
    switch (mode) {
        case 0: ctl.addClass('active'); break;
        case 1: ctl.removeClass('active'); break;
        default:
        case 2: ctl.toggleClass('active'); break;
    }
}

function addToCart(dish, quantity) {
    // Get the quantity already in cart, add them together
    if(cart) {
        let dishOldQuantity = cart[dish['id']];
        if(dishOldQuantity) quantity = parseInt(quantity) + parseInt(dishOldQuantity);
    }

    $.ajax({
        type: 'POST',
        data: {
            'action': 'addToCart',
            'dish': dish['id'],
            'quantity': quantity
        },
        url: 'dishCtrl.php',
        success: function(res) {
            receive(res);
        },
        timeout: 5000
    });
}

function addToCart_res(res) {
    if(!res['result']) {
        switch (res['reason']) {
            case 1: alert("Sorry, you need to login before order."); break;
            default: alert("Sorry, add failed. And we don't know why."); break;
        }
    }
    else {
        cart = res["cart"];
        updateCart();
    }
}

function updateCart() {
    let cartList = $('div#cart-list');
    cartList.empty();
    if(Object.keys(cart).length===0)
        cartList.append("<div class='cart-warning'><i class='material-icons'>warning</i><br>No items in your cart</div>");
    else {
        $.each(cart,function(dish_id ,quantity) {
            let thisDish = getDishByID(dish_id);
            cartList.append(
                "<div class='cart-item'>" +
                "   <div class='row' style='align-items: center'>" +
                "       <div class='col-3'>" +
                "           <img class='ci-img' src='"+thisDish['photo']+"'>" +
                "       </div>" +
                "       <div class='col'>" +
                "           <div class='ci-first-line d-flex justify-content-between'>" +
                "               <strong>"+thisDish['name']+" </strong>"+
                "           </div>" +
                "           <div class='ci-second-line d-flex justify-content-between'>" +
                "               <div id='ci-price'>$ "+thisDish['price']+"</div>"+
                "               <div>" +
                "                   <div data-id='"+thisDish['id']+"' class='ci-counter input-group input-group-sm'>"+
                "                       <div class='input-group-prepend'>" +
                "                           <button class='btn btn-outline-secondary ci-btn btn-dec' style='line-height: 0'>-</button>" +
                "                       </div>" +
                "                       <input class='ci-counter-input input-group-text' value='"+quantity+"' type='text'>" +
                "                       <div class='input-group-append'>" +
                "                           <button class='btn btn-outline-secondary ci-btn btn-add' style='line-height: 0'>+</button>" +
                "                       </div>" +
                "                   </div>" +
                "               </div>" +
                "           </div>" +
                "       </div>" +
                "   </div>" +
                "</div>"
            );
        });

        $('div.ci-counter').each(function() {
            let ctrlPanel = $(this);
            let decBtn = ctrlPanel.find("button.btn-dec");
            let counter = ctrlPanel.find("input");
            let addBtn = ctrlPanel.find("button.btn-add");
            let dishID = ctrlPanel.data("id");
            let thisDish = getDishByID(dishID);

            if(counter.val()==='1') decBtn.addClass("ci-btn-delete").html('&times;');
            else decBtn.css("background","transparent").html("-");

            counter.on("change", function() {
                if(isNaN(parseInt(counter.val()))) {
                    alert("Please input number");
                    updateCart();
                } else {
                    console.log(thisDish['name']+" change to "+parseInt(counter.val()));
                    cartItemQuantityChange(dishID, counter.val());
                }
            });
            decBtn.on("click", function () {
                console.log(thisDish['name']+" change to "+counter.val());
                cartItemQuantityChange(dishID, parseInt(counter.val())-1);
            });
            addBtn.on("click", function () {
                console.log(thisDish['name']+" change to "+counter.val());
                cartItemQuantityChange(dishID, parseInt(counter.val())+1);
            });
        });
    }
}

function cartItemQuantityChange(dishID, quantity) {
    $.ajax({
        type: 'POST',
        data: {
            'action': 'addToCart',
            'dish': dishID,
            'quantity': quantity
        },
        url: 'dishCtrl.php',
        success: function(res) {
            receive(res);
        },
        timeout: 5000
    });
}

function getDishByID(dishID) {
    for (let dish of dishes) {
        if(dish['id'] === dishID.toString()) return dish;
    }
    return null;
}