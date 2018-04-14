
function checkCatStatus(){

    // count categories
    let categories = $('#category').find('.checkbox');

    // indicator of no-checked status
    let anyChecked = false;

    // include checked categories
    for (let category of categories) {
        let key = category.getAttribute('name').toLowerCase();
        let value = category.checked;
        if (value) {
            anyChecked = true;

            // include dishes of this category
            let dishesFiltered = dishes.filter(function(dish){
                return dish['category'].toLowerCase() === key;
            });
            console.log(dishesFiltered);

            // show dishes of this category
            showDishCard(dishesFiltered);
        }

    }

    // show all dishes if none is checked
    if (!anyChecked) showDishCard(dishes);
}


// Check filters
function checkFilters() {

    checkCatStatus();

}

function filter(box) {

    emptyDishCard();

    checkFilters();

}