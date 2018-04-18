<?php
/**
 * Created by PhpStorm.
 * User: yygatech
 * Date: 3/17/18
 * Time: 1:18 PM
 */
?>

<div id="dish-list"></div>

<!-- Dish Details Modal (User View) -->
<div class="modal fade" role="dialog" id="dish-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="detail-body">

                <div class="container " id="detail-top">
                    <div class="row border justify-content-center">
                        <img src="#" alt="food picture" id="dish-img">
                    </div>
                </div>

                <div class="container" id="detail-middle">

                    <div class="row" id="detail-name">
                        <h5 class="modal-title" id="dish-name"></h5>
                    </div>

                    <div class="row" id="detail-description">
                        <p id="dish-description"></p>
                    </div>

                    <div class="row" id="detail-price-qty">
                        <div class="col-6">
                            <div class="row" id="detail-price">
                                <strong>$</strong>
                                <strong id="dish-price"></strong>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6" id="detail-qty-col">
                            <div class="row justify-content-end" id="detail-qty-row">
                                <div class="input-group p-0" id="detail-qty">
                                    <span class="input-group-btn input-group-prepend">
                                        <button class="btn btn-danger btn-number btn-number-left" type="button" data-type="minus" data-field="quant[2]">
                                            <h4>-</h4>
                                        </button>
                                    </span>
                                    <input id="dish-quantity" type="text" name="quant[2]" class="form-control input-number text-center" value="1" min="1" max="10">
                                    <span class="input-group-btn input-group-append">
                                        <button class="btn btn-success btn-number btn-number-right" type="button" data-type="plus" data-field="quant[2]">
                                            <h4>+</h4>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr id="detail-divider"/>

                <div class="container" id="detail-bottom">

                    <div class="row" id="detail-buttons">

                        <div class="col-3">
                            <div class="row btn-left">
                                <button id="cancel" class="btn btn-block" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>

                        <div class="col-9">
                            <div class="row btn-right">
                                <button id="add-to-cart" class="btn btn-block">
                                    <span>Add to cart</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="detail-admin">

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


<script src="javascript/quantity.js"></script>
<script src="javascript/admin.js"></script>

<!-- PAGINATION -->
<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
    </ul>
</nav>