<?php
session_start();
$GLOBALS["dishes"] = [];
/**
 * Get dishes from database and convert to object array
 */
function getDishes() {
    include 'Dish.php';
    $criStr = 'true';
    $con = getConnection();
    $query = "SELECT * FROM dish WHERE $criStr";
    $result = mysqli_query($con,$query);
    $dish_arr = mysqli_fetch_all($result,MYSQLI_ASSOC);

    # Establish dishes data
    foreach ($dish_arr as $dish) {
        $dish_of_class = new Dish();
        $dish_of_class -> init_from_arr($dish);
        array_push($GLOBALS["dishes"], $dish_of_class);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Restaurant</title>
</head>
<body>
<!-- Header(Navigation bar) -->
<?php include 'header.php' ?>

<!-- Homepage Content -->
<div class="container-fluid">

    <div class="row">
        <div id="index-view" class="col active">
            <div class="container-fluid">
                <div class="row">
                    <!-- Image -->
                    <?php include 'homepageCarousel.php' ?>
                </div>
                <div class="row">
                    <div id="search-bar-container" class="col-2">
                        <?php include 'search.php'; ?>
                    </div>
                    <div id="dish-list-container" class="col">
                        <?php
                        getDishes();
                        include 'courseList.php';
                        ?>
                    </div>
                </div>
                <div class="row">
                    <?php include 'footer.php' ?>
                </div>
            </div>
        </div>

        <?php include 'cart.php' ?>
    </div>
</div>

</body>
</html>