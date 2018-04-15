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
            "       <h1>Order Number: "+order['order_id']+"</h1>\n" +
            "       <h1>Built Time: "+order['built_time']+"</h1>\n" +
            "       <h2>Message: "+order['user_message']+"</h2>\n" +
            "       <h2>Tip: "+order['tip']+"</h2>\n" +
            "       <h2>Order Status: "+s+"</h2>\n" +
            "       <h2>Subtotal: "+order['subtotal']+"</h2>\n" +
            "       <h2>Delivery Fee: "+order['delivery_fee']+"</h2>\n" +
            "    </div>" +
            "</div>"
        );
        for (let dish of dishes) {
            if(dish['order_id'] == order['order_id']){
                $("#order"+order['order_id']).append(
                    "<div>\n" +
                    "    <h4>Dish Name: "+dish['name']+"</h4>\n" +
                    "    <h4>Dish Quantity: "+dish['dish_quantity']+"</h4>\n" +
                    "</div>"
                );
            }
        }
    }
}