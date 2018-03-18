<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 3/12/18
 * Time: 21:39
 */

?>

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Restaurant</title>
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

        <?php include 'cart.php' ?>
    </div>
</div>

</body>
</html>
