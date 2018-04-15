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
        case 'getOrders': showOrderCard(res['data']); break;
        default: break;
    }
}

function showOrderCard(orders){
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
        //tmp.order_id, tmp.dish_id, tmp.dish_quantity, tmp.name, o.user_id, o.built_time, o.user_message, o.tip, o.processed_status, o.subtotal, o.delivery_fee
        $("#order-list").append(
            "<div class='card dish-card'>\n" +
            "    <h1>Order Number: "+order['order_id']+"</h1>\n" +
            //"    <h1>Dish ID: "+order['dish_id']+"</h1>\n" +
            //"    <h1>Dish Quantity: "+order['dish_quantity']+"</h1>\n" +
            //"    <h1>Dish Name: "+order['name']+"</h1>\n" +
            "    <h1>Built Time: "+order['built_time']+"</h1>\n" +
            "    <h1>Message: "+order['user_message']+"</h1>\n" +
            "    <h1>Tip: "+order['tip']+"</h1>\n" +
            "    <h1>Order Status: "+s+"</h1>\n" +
            "    <h1>Subtotal: "+order['subtotal']+"</h1>\n" +
            "    <h1>Delivery Fee: "+order['delivery_fee']+"</h1>\n" +
            "</div>"
        );
    }
}