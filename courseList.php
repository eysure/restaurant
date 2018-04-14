<?php
/**
 * Created by PhpStorm.
 * User: yygatech
 * Date: 3/17/18
 * Time: 1:18 PM
 */
?>

<div id="dish-list"></div>

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
                                    <span class="input-group-btn input-group-prepend">
                                        <button class="btn btn-danger btn-number" type="button" data-type="minus" data-field="quant[2]">
                                            <h4>-</h4>
                                        </button>
                                    </span>
                                    <input id="dish-quantity" type="text" name="quant[2]" class="form-control input-number text-center" value="1" min="1" max="10">
                                    <span class="input-group-btn input-group-append">
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
                            <button id="add-to-cart" class="btn btn-primary btn-block">Add to bag</button>
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

<script src="javascript/quantity.js"></script>

<!-- PAGINATION -->
<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
    </ul>
</nav>