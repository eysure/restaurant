<?php
/**
 * Created by PhpStorm.
 * User: yygatech
 * Date: 3/17/18
 * Time: 1:06 PM
 */
?>

<div class="card" data-toggle="modal" data-target="#course">
    <div class="card-body">
        <h4 class="card-title">Card Title</h4>
        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo, quas.</p>
    </div>
</div>

<!-- MODAL -->
<div class="modal" id="course">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Food name</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col">
                            <img src="assets/img/course/generaltsoschicken.jpeg" alt="food picture">
                        </div>

                        <div class="col">
                            <div class="row mb-2">
                                Today's special!
                            </div>

                            <div class="row mb-4">
                                <strong>$</strong>
                                <strong id="price">10.95</strong>
                            </div>

                            <div class="row">
                                <div class="input-group col-9 m-auto">
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

