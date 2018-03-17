<script type="text/javascript">
    $(document).ready(function () {
        $("#cart-view").mCustomScrollbar({
            theme: "minimal"
        });

        $('#cart-btn').on('click', function () {
            $(this).toggleClass('active');
            $('#cart-view, #index-view').toggleClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });
</script>

<div id="cart-view" class="col active">
    <div class="navbar-placeholder"></div>

    <div id="cart-container" class="container">
        <div>
            <h1>My Cart</h1>
        </div>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
        <h2>Cart item</h2>
    </div>

    <div id="checkout-container">

    </div>
</div>