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
    if(orders.length == 0){
        window.alert("You don't have any order record!");
        window.location.replace("index.php");
    }
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
            "<div class='w-50 container-fluid'>"+
            "    <div>"+
            "       <ul class=\"list-group list-unstyled\" id='outer_listed_dish"+order['order_id']+"'>"+
            "           <li class=\"bg-light list-group-item d-flex justify-content-between align-items-center\"><b>Order Built-Time</b>"+order['built_time']+"</li>"+
            "           <li class=\"bg-light list-group-item d-flex justify-content-between align-items-center\"><b>Message</b>"+order['user_message']+"</li>"+
            "           <li class=\"bg-light list-group-item d-flex justify-content-between align-items-center\"><b>Order Status</b>"+s+"</li>"+
            "           <li class=\"bg-light list-group-item d-flex justify-content-between flex-row\">"+
            "               <div><b>Ordered Dishes</b></div>"+
            "               <div id='listed_dish"+order['order_id']+"'></div>"+
            "           </li>"+
            "       </ul>"+
            "    </div>"+
            "</div>"
        );
        var subtotal = 0;
        for (let dish of dishes) {
            if(dish['order_id'] == order['order_id']){
                subtotal = subtotal + dish['dish_quantity']*dish['dish_price_that_time'];
                $("#listed_dish"+order['order_id']).append(
                    "<li class='text-right'>"+dish['name']+" ("+Number(dish['dish_price_that_time']).toLocaleString('en-US', {style: 'currency',currency: 'USD'})+"/serving)"+
                    "    <span class=\"badge badge-warning\">*"+dish['dish_quantity']+"</span>"+
                    "</li>"
                );
            }
        }
        var total = subtotal + Number(order['tip']) + Number(order['delivery_fee']);
        $("#outer_listed_dish"+order['order_id']).append(
            "   <li class=\"bg-light list-group-item d-flex justify-content-between align-items-center\"><b>Subtotal</b>"+
            "       <span class=\"badge badge-primary\">"+subtotal.toLocaleString('en-US', {style: 'currency',currency: 'USD'})+"</span>"+
            "   </li>"+
            "   <li class=\"bg-light list-group-item d-flex justify-content-between align-items-center\"><b>Tip</b>"+
            "       <span class=\"badge badge-primary\">"+Number(order['tip']).toLocaleString('en-US', {style: 'currency',currency: 'USD'})+"</span>"+
            "   </li>"+
            "   <li class=\"bg-light list-group-item d-flex justify-content-between align-items-center\"><b>Delivery Fee</b>"+
            "       <span class=\"badge badge-primary\">"+Number(order['delivery_fee']).toLocaleString('en-US', {style: 'currency',currency: 'USD'})+"</span>"+
            "   </li>"+
            "   <li class=\"bg-light list-group-item d-flex justify-content-between align-items-center\"><b>Total</b>"+
            "       <span class=\"badge badge-primary\">"+total.toLocaleString('en-US', {style: 'currency',currency: 'USD'})+"</span>"+
            "   </li>"+
            "</br>"+
            "</br>"
        );
    }
}