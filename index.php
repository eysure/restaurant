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
            <?php include 'search.php'; ?>

            <?php include 'course.php' ?>

            <h1>some contents</h1>
            <h1>some contents</h1>
            <h1>some contents</h1>

            <!-- PAGINATION -->
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                </ul>
            </nav>

            <?php include 'footer.php' ?>
        </div>

        <?php include 'cart.php' ?>
    </div>
</div>

</body>
</html>