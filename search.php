<?php
/**
 * Individual Search & Filter function
 * Created by PhpStorm.
 * User: henry
 * Date: 3/10/18
 * Time: 18:08
 */

?>
<div id="search-bar">
    <div id="searchForm">
        <form class="form-inline">
            <input id="searchInput" class="form-control" type="search" placeholder="Search..." aria-label="Search">
            <span id="searchButton"><i id="searchIcon" class="material-icons">search</i></span>
        </form>
        <br>
    </div>

    <div>
        <h1>Category</h1>
        <ul class="cleandot">
            <li><input class="box" type="checkbox" name="Combo"> Combo</li>
            <li><input class="box" type="checkbox" name="Meat"> Meat</li>
            <li><input class="box" type="checkbox" name="Seafood"> Seafood</li>
            <li><input class="box" type="checkbox" name="Vegetable"> Vegetable</li>
            <li><input class="box" type="checkbox" name="Soy"> Soy</li>
            <li><input class="box" type="checkbox" name="Mushroom"> Mushroom</li>
            <li><input class="box" type="checkbox" name="Wheat"> Wheat</li>
            <li><input class="box" type="checkbox" name="Base"> Base</li>
            <li><input class="box" type="checkbox" name="Sauce"> Sauce</li>
            <li><input class="box" type="checkbox" name="Drink"> Drink</li>
        </ul>
        <br>
    </div>

    <div>
        <h1>Price</h1>
        <ul class="cleandot">
            <li><input class="box" type="checkbox" name="five_down"> $5 ↓</li>
            <li><input class="box" type="checkbox" name="five_to_ten"> $5 - $10</li>
            <li><input class="box" type="checkbox" name="ten_to_twty"> $10 - $20</li>
            <li><input class="box" type="checkbox" name="twty_up"> $20 ↑</li>
        </ul>
        <br>
    </div>

    <div>
        <h1>Calories</h1>
        <ul class="cleandot">
            <li><input class="box" type="checkbox" name="fivehd_down"> 500 calories ↓</li>
            <li><input class="box" type="checkbox" name="fivehd_to_tenhd"> 500 - 1000 calories</li>
            <li><input class="box" type="checkbox" name="ten_to_twty"> 1000 calories ↑</li>
        </ul>
        <br>
    </div>

    <div>
        <h1>Vegetarian</h1>
        <ul class="cleandot">
            <li><input class="box" type="checkbox" name="vege_or_not"> Show vegetarian dishes</li>
        </ul>
        <br>
    </div>
</div>