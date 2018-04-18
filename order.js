let orders = null;

$(document).ready(function() {
    $.ajax({
        type: 'POST',
        data: {
            'action': 'getOrders'
        },
        url: 'orderCtrl.php',
        success: function(res) {
            order_receive(res);
        },
        timeout: 5000
    });
});

function order_receive(res) {
    try {
        res = JSON.parse(res);
        console.log(res);
    } catch(err) {
        console.error("JSON parse error");
        console.log(err);
        console.log(res);
    }

    // Checking if there is an error in server-side
    switch (res['error']) {
        case 1: {
            alert("Please login to see your order history.");
            window.location = "./index.php";
            return;
        }
        default: break;
    }

    // Show orders to front-end
    switch (res['action']) {
        case 'getOrders': showOrderCard(res['data']['arr1'],res['data']['arr2']); break;
        default: break;
    }
}

function showOrderCard(orders, dishes){
    for (let order of orders) {
        //Processing status
        var s = null;
        switch(order['processed_status']){
            case '0':
                s = "Processing...";
                break;
            case '1':
                s = "Delivered.";
                break;
            default:
                break;
        }

        $("#order-list").append(
            "<div class='card dish-card' id='order"+order['order_id']+"'>\n" +
            "    <div>\n" +
            "       <h3>Built Time: "+order['built_time']+"</h3>\n" +
            "       <h3>Message: "+order['user_message']+"</h3>\n" +
            "       <h3>Tip: "+order['tip']+"</h3>\n" +
            "       <h3>Order Status: "+s+"</h3>\n" +
            "       <h3>Delivery Fee: "+order['delivery_fee']+"</h3>\n" +
            "    </div>" +
            "</div>"
        );
        var subtotal = 0;
        for (let dish of dishes) {
            if(dish['order_id'] == order['order_id']){
                subtotal = subtotal + dish['dish_quantity']*dish['dish_price_that_time'];
                $("#order"+order['order_id']).append(
                    "<div>\n" +
                    "    <h3>Dish: "+dish['name']+"*"+dish['dish_quantity']+", Dish Per Price: "+dish['dish_price_that_time']+"</h3>\n" +
                    "</div>"
                );
            }
        }
        $("#order"+order['order_id']).append(
            "<div>\n" +
            "    <h3>Subtotal: "+subtotal+"</h3>\n" +
            "</div>"
        );
    }
}