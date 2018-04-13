let dishes = null;

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

        let thisDish = null;
        for (let dish of dishes) {
            if(dish['id'] === id.toString()) {
                thisDish = dish;
                break;
            }
        }

        // Inflate the modal
        // TODO: Add the admin mode there
        $('#dish-name').text(thisDish['name']);
        $('#dish-img').attr("src",thisDish['photo']);
        $('#dish-description').text(thisDish['description']);
        $('#dish-price').text(thisDish['price']);

        // Add to cart
        $('#add-to-cart').on('click', function () {
            let counter = $('#dish-quantity');
            addToCart(thisDish,counter.val());
            counter.val(1);                                     // Reset the quantity counter
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
            showDishCard();
            break;
        }
    }
}

/**
 * Show all cards of dishes to the dish list
 * TODO: Need to be changed to pagination
 * TODO: Need to merge search
 */
function showDishCard() {
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
    // Debug
    console.log(quantity+" "+dish['name']+" add to cart!");
    $('div#cart-list').append(
        "<div class='cart-item'>"+dish['name']+" x "+quantity+"</div>"
    );
}