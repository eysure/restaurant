<script type="text/javascript">
    $(document).ready(function () {
        $("#cart-view").mCustomScrollbar({
            theme: "minimal"
        });

        $('#cart-btn').on('click', function () {
            $('#cart-view, #index-view').toggleClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });
</script>

<div id="cart-view" class="col active">
    <div class="navbar-placeholder"></div>

    <div class="cart-body">
        <h1>My Cart</h1>
    </div>

    <div id="checkout-container">

    </div>
</div>