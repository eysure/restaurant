<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Dalao Hotpot - My orders</title>
    <script src="order.js"></script>
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
                        <?php include 'OrderList.php'?>
                    </div>
                    <div class="row">
                        <?php include 'footer.php' ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'cart.php' ?>
    </div>
</body>
</html>