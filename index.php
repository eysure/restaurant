<?php
    include 'header.php';
    include 'search.php';
    include 'footer.php';
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
<?php showHeader() ?>

<!-- Homepage Content -->
<div class="container">
    <!-- Products list -->
    <div class="jumbotron">
        <h1 class="display-4">Product list is in construction</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
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

</div>

<!-- Footer -->
<?php showFooter() ?>

</body>
</html>