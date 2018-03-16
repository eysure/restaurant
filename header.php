<?php
/**
 * This file contain navigation bar logic.
 * Including menu, search, filter, user sign in and sign up.
 * Created by PhpStorm.
 * User: henry
 * Date: 3/9/18
 * Time: 16:45
 */
include "user.php";
?>

<nav class="navbar navbar-expand-md navbar-dark justify-content-between fixed-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarNav">
	    	<ul class="navbar-nav">
	    		<li class="nav-item active">
	    			<a class="nav-link" href="#">Restaurant Name<span class="sr-only">(current)</span></a>
	    		</li>
	    		<li class="nav-item">
	    			<a class="nav-link" href="#">Menu</a>
	    		</li>
	    		<li class="nav-item">
	    			<a class="nav-link" href="#">Location and Hours</a>
	    		</li>
	    		<li class="nav-item">
	    			<a class="nav-link" href="#">About</a>
	    		</li>
	    		<li class="nav-item">
	    			<a class="nav-link" href="#">Contact</a>
	    		</li>
	    	</ul>
	    </div>

        <!-- User & Cart-->
        <div class="inline">
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <?php insertUserButton(); ?>
            <div class="btn-group mr-3" role="group">
                <button class="user-btn btn btn-outline-light no-border" id="cart-btn"><i class="material-icons">shopping_cart</i></button>
            </div>
        </div>
        </div>
    </div>
</nav>
<?php insertLoginModal(); ?>