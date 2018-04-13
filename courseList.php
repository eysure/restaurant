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
    foreach($GLOBALS["dishes"] as $dish) {
        echo "
        <div class=\"card dish-card\" data-toggle=\"modal\" data-target=\"#course_detail\" data-id=\"".$dish->id."\">
            <img class=\"card-img-top\" src=\"".$dish->img."\" alt=\"food picture\">
            <div class=\"card-body\">
                <h4 class=\"card-title\">".$dish->name."</h4>
                        <strong>$</strong>
                        <strong>".$dish->price."</strong>
            </div>
        </div>
        ";
    }
    ?>
</div>

<div class="modal" id="course_detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col">
                            <img id="dish-img" src="#" alt="food picture">
                        </div>

                        <div class="col">
                            <h5 id="dish-name" class="modal-title"></h5>
                            <p id="dish-description"></p>
                            <div class="row mb-4">
                                <strong>$</strong>
                                <strong id="dish-price"></strong>
                            </div>

                            <div class="row justify-content-start">
                                <div class="input-group p-0 col-9">
                                    <span class="input-group-btn">
                                        <button class="btn btn-danger btn-number" type="button" data-type="minus" data-field="quant[2]">
                                            <h4>-</h4>
                                        </button>
                                    </span>
                                    <input type="text" name="quant[2]" class="form-control input-number text-center" value="1" min="1" max="10">
                                    <span class="input-group-btn">
                                        <button class="btn btn-success btn-number" type="button" data-type="plus" data-field="quant[2]">
                                            <h4>+</h4>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-primary btn-block">Add to bag</button>
                        </div>

                        <div class="col">
                            <button class="btn btn-secondary btn-block" data-dismiss="modal">Cancel</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="quantity.js"></script>

<!-- PAGINATION -->
<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
    </ul>
</nav>