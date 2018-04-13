let dishes = null;

$(document).ready(function() {
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

    $('#course_detail').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);                    // Button that triggered the modal
        let id = button.data('id');                             // Extract info from data-* attributes

        let thisDish = null;
        for (let dish of dishes) {
            if(dish['id'] === id.toString()) {
                thisDish = dish;
                break;
            }
        }

        $('#dish-name').text(thisDish['name']);
        $('#dish-img').attr("src",thisDish['photo']);
        $('#dish-description').text(thisDish['description']);
        $('#dish-price').text(thisDish['price']);

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

function showDishCard() {
    console.log(dishes);
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