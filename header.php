<?php
/**
 * This file contain navigation bar logic.
 * Including menu, search, filter, user sign in and sign up.
 * Created by PhpStorm.
 * User: henry
 * Date: 3/9/18
 * Time: 16:45
 */

include 'user.php';

function showHeader() {
    echo "
    <nav class='navbar navbar-expand-md navbar-dark bg-dark justify-content-between fixed-top'>
    <div class='container'>
        <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
		    <span class=\"navbar-toggler-icon\"></span>
	    </button>
	    <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
	    	<ul class=\"navbar-nav\">
	    		<li class=\"nav-item active\">
	    			<a class=\"nav-link\" href=\"#\">Home <span class=\"sr-only\">(current)</span></a>
	    		</li>
	    		<li class=\"nav-item\">
	    			<a class=\"nav-link\" href=\"#\">Features</a>
	    		</li>
	    		<li class=\"nav-item\">
	    			<a class=\"nav-link\" href=\"#\">Pricing</a>
	    		</li>
	    	</ul>
	    </div>
  
        <!-- User -->
        <div class='inline'>
            ",insertUserButton(),"
        </div>
    </div>
    </nav>
    ";

    insertLoginModal();

}