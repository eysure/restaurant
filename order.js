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
                s = "Processing ............";
                break;
            case '1':
                s = "Delivered.";
                break;
            default:
                break;
        }

        $("#order-list").append(
            "<div id='order"+order['order_id']+"'>\n"+
            "    <div>\n"+
            "       <ul class=\"list-group\">"+
            "           <li class=\"list-group-item d-flex justify-content-between align-items-center\">Order Built-Time: "+order['built_time']+"</li>"+
            "           <li class=\"list-group-item d-flex justify-content-between align-items-center\">Message: "+order['user_message']+"</li>"+
            "           <li class=\"list-group-item d-flex justify-content-between align-items-center\">Order Status: "+s+"</li>"+
            "       </ul>"+
            "    </div>"+
            "</div>"
        );
        var subtotal = 0;
        for (let dish of dishes) {
            if(dish['order_id'] == order['order_id']){
                subtotal = subtotal + dish['dish_quantity']*dish['dish_price_that_time'];
                $("#order"+order['order_id']).append(
                    "<div>"+
                    "   <ul class=\"list-group\">"+
                    "       <li class=\"list-group-item d-flex justify-content-between align-items-center\">Dish: "+dish['name']+" ("+Number(dish['dish_price_that_time']).toLocaleString('en-US', {style: 'currency',currency: 'USD'})+"/serving)"+
                    "           <span class=\"badge badge-primary badge-pill\">*"+dish['dish_quantity']+"</span>"+
                    "       </li>"+
                    "   </ul>"+
                    "</div>"
                );
            }
        }
        var total = subtotal + Number(order['tip']) + Number(order['delivery_fee']);
        $("#order"+order['order_id']).append(
            "<div id='order"+order['order_id']+"'>\n"+
            "    <div>"+
            "       <ul class=\"list-group\">"+
            "           <li class=\"list-group-item d-flex justify-content-between align-items-center\">Subtotal"+
            "               <span class=\"badge badge-primary badge-pill\">"+subtotal.toLocaleString('en-US', {style: 'currency',currency: 'USD'})+"</span>"+
            "           </li>"+
            "           <li class=\"list-group-item d-flex justify-content-between align-items-center\">Tip"+
            "               <span class=\"badge badge-primary badge-pill\">"+Number(order['tip']).toLocaleString('en-US', {style: 'currency',currency: 'USD'})+"</span>"+
            "           </li>"+
            "           <li class=\"list-group-item d-flex justify-content-between align-items-center\">Delivery Fee"+
            "               <span class=\"badge badge-primary badge-pill\">"+Number(order['delivery_fee']).toLocaleString('en-US', {style: 'currency',currency: 'USD'})+"</span>"+
            "           </li>"+
            "           <li class=\"list-group-item d-flex justify-content-between align-items-center\">Total"+
            "               <span class=\"badge badge-primary badge-pill\">"+total.toLocaleString('en-US', {style: 'currency',currency: 'USD'})+"</span>"+
            "           </li>"+
            "       </ul>"+
            "    </div>"+
            "</div>"
        );
    }
}