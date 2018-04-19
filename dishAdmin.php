<?php
/**
 * Created by PhpStorm.
 * User: yygatech
 * Date: 4/18/18
 * Time: 2:14 PM
 */
?>

<!-- Dish Details Modal (Admin View) -->
<div class="modal fade" role="dialog" id="dish-detail-admin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body detail-body">
                <div>
                    <div class="container detail-top">
                        <div class="row border justify-content-center">
                            <img class="detail-img" src="#" alt="food picture" id="dish-img-admin">
                            <input class='form-control' id="dish-img-upload-admin" type="file">
                        </div>
                    </div>

                    <div class="container detail-middle">

                        <div class="row form-group">
                            <label for="">Item</label>
                            <input class="form-control" id="dish-name-admin" type="text" placeholder="name...">
                        </div>

                        <div class="row form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" id="dish-description-admin" name="" rows="2" placeholder="description..."></textarea>
                        </div>

                        <div class="row form-group">
                            <label for="">Category</label>
                            <input class="form-control" id="dish-cat-admin" type="text" placeholder="category...">
                        </div>

                        <div class="row form-group">
                            <label for="">Price ($)</label>
                            <input type="text" id="dish-price-admin" class="form-control" placeholder="price...">
                        </div>

                        <div class="row form-group">
                            <label for="">Calorie</label>
                            <input type="text" id="dish-cal-admin" class="form-control" placeholder="calorie...">
                        </div>

                        <div class="row form-group">
                            <label for="">Vegetarian</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optradio" id="veg-yes">Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optradio" id="veg-no">No
                                </label>
                            </div>

                        </div>

                        <div class="row form-group">
                            <label for="">Inventory</label>
                            <input class="form-control" id="dish-inventory-admin" type="text" placeholder="inventory...">
                        </div>

                        <div class="row form-group">
                            <label for="">Availability</label>
                            <input class="form-control" id="dish-avail-admin" type="text" placeholder="availability...">
                        </div>
                    </div>

                    <hr class="detail-divider"/>

                    <div class="container detail-bottom">

                        <div class="row detail-buttons">

                            <div class="col-3">
                                <div class="row btn-left">
                                    <button class="btn btn-block cancel" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>

                            <div class="col-9">
                                <div class="row btn-right">
                                    <button id="update" class="btn btn-primary btn-block">Update</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>