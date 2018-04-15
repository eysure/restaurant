<div id="cart-view" class="col active">
    <div class="navbar-placeholder"></div>
    <div id="cart-list" class="container">
        <div class="cart-warning"><i class="material-icons">warning</i><br>No items in your cart</div>
    </div>
    <div id="checkout-container">
        <div id="tip" class="cart-item">
            <div id="tip-container" class="d-flex justify-content-between">
                <Strong>Tip</Strong>
                <div>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <button id='cb-tip-1' data-tip='1' class="btn btn-outline-secondary form-control tip-opt">$1</button>
                            <button id='cb-tip-2' data-tip='2' class="btn btn-outline-secondary form-control tip-opt active">$2</button>
                            <button id='cb-tip-3' data-tip='3' class="btn btn-outline-secondary form-control tip-opt">$3</button>
                        </div>
                        <input id="cb-tip-x" class="tip-opt form-control" type="number">
                    </div>
                </div>
            </div>
        </div>
        <div id="checkout-bill-container" class="flex-column">
            <div class="d-flex justify-content-between">
                <span>Subtotal</span>
                <span id="cb-subtotal">0.00</span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Deliver Fee</span>
                <span id="cb-deliver-fee">0.00</span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Tax</span>
                <span id="cb-tax">0.00</span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Tip</span>
                <span id="cb-tip">0.00</span>
            </div>
            <div class="d-flex justify-content-between cb-total-row">
                <span>Total</span>
                <strong id="cb-total">0.00</strong>
            </div>
        </div>
        <div id="checkout-btn"><i class="material-icons">gavel</i> Check Out</div>
    </div>
</div>