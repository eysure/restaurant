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
    } catch(err) {
        alert(err);
        alert(res);
    }
    switch (res['action']) {
        case 'getOrders': {
            orders = res['data'];
            showOrderCard(orders);
            break;
        }
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
        $("#order-list").append(
            "<div class='card dish-card'>\n" +
            "    <h1>Dish: "+order['dish_id']+"</h1>\n" +
            "    <h1>Quantity: "+order['dish_quantity']+"</h1>\n" +
            "</div>"
            /**"   <h1>Order Number: "+order['order_id']+"</h1>\n" +
            "   <h3>Built Time: "+order['built_time']+"</h3>\n" +
            "   <h3>Message: "+order['user_message']+"</h3>\n" +
            "   <h3>Tip: "+order['tip']+"</h3>\n" +
            "   <h3>Delivery: "+s+"</h3>\n" +
            "</div>"**/
        );
    }
}