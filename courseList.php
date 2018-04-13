<?php
/**
 * Created by PhpStorm.
 * User: yygatech
 * Date: 3/17/18
 * Time: 1:18 PM
 */
?>

<div id="dish-list">
    <?php
    include 'course.php';
    foreach($GLOBALS["dishes"] as $dish) {
        echo "
            <div class=\"card dish-card\" data-toggle=\"modal\" data-target=\"#course\">
            <img class=\"card-img-top\" src=\"".$dish->img."\" alt=\"food picture\">
            <div class=\"card-body\">
            <div class=\"row\">
            <div class=\"col-sm-8 my-auto\">
                <h4 class=\"card-title\">".$dish->name."</h4>
                <p class=\"card-text text-danger\">Today's special!</p>
                        <strong>$</strong>
                        <strong>".$dish->price."</strong>
                        <small>".$dish->img."</small>
                    </div>
                </div>
            </div>
        </div>
        ";
    }
    ?>
</div>

<!-- PAGINATION -->
<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
    </ul>
</nav>