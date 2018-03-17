<?php
/**
 * Individual Search & Filter function
 * Created by PhpStorm.
 * User: henry
 * Date: 3/10/18
 * Time: 18:08
 */
?>
<div class="filter">
    <div>
        <form class='form-inline'>
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
        </br>
    </div>

    <div>
        <h1>Category</h1>
        <ul class="cleandot">
            <li>Category 1</li>
            <li>Category 2</li>
            <li>Category 3</li>
            <li>Category 4</li>
            <li>Category 5</li>
        </ul>
        </br>
    </div>

    <div>
        <h1>Price</h1>
        <ul class="cleandot">
            <li><input type="checkbox" name="five_down"> $5 ↓</li>
            <li><input type="checkbox" name="five_to_ten"> $5 - $10</li>
            <li><input type="checkbox" name="ten_to_twty"> $10 - $20</li>
            <li><input type="checkbox" name="twty_up"> $20 ↑</li>
        </ul>
        </br>
    </div>

    <div>
        <h1>Calories</h1>
        <ul class="cleandot">
            <li><input type="checkbox" name="fivehd_down"> 500 calories ↓</li>
            <li><input type="checkbox" name="fivehd_to_tenhd"> 500 - 1000 calories</li>
            <li><input type="checkbox" name="ten_to_twty"> 1000 calories ↑</li>
        </ul>
        </br>
    </div>

    <div>
        <h1>Vegetarian</h1>
        <ul class="cleandot">
            <li><input type="checkbox" name="vege_or_not"> Show vegetarian dishes</li>
        </ul>
        </br>
    </div>
</div>