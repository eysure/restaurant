
$('#edit').click(function(){
    console.log('edit button clicked');
});

$('#add-to-cart').on('click', function(){
    console.log('add to cart button clicked');
});

$('#add-to-cart').click(edit);

function edit() {
    console.log($('#edit'));
}