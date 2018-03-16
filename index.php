<?php
    include 'search.php';
    session_start();
?>

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

            <!-- Image -->
            <div id="homepage-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="assets/img/1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="assets/img/2.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="assets/img/3.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#homepage-carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#homepage-carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <!-- Search -->
            <form class='form-inline'>
                <div class='input-group'>
                    <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>

            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>

            <?php include 'footer.php' ?>
        </div>

        <?php include 'cart.php' ?>
    </div>
</div>

</body>
</html>