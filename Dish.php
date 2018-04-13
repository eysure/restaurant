<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 3/17/18
 * Time: 14:11
 */

class Dish {
    public $name;
    public $price;
    public $description;
    public $img;
    public $category;
    public $calorie;
    public $vegetarian;
    public $inventory;
    public $availability;

    /**
     * Dish init.
     * @param $name
     * @param $price
     * @param $description
     * @param $img
     * @param $category
     * @param $calorie
     * @param $vegetarian
     * @param $inventory
     * @param $availability
     */
    public function init($name, $price, $description, $img, $category, $calorie, $vegetarian, $inventory, $availability) {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->img = $img;
        $this->category = $category;
        $this->calorie = $calorie;
        $this->vegetarian = $vegetarian;
        $this->inventory = $inventory;
        $this->availability = $availability;
    }

    /**
     * init a dish by dish array type (mostly from database)
     * @param $db_single
     */
    public function init_from_arr($db_single) {
        $this->init(
            $db_single['name'],
            $db_single['price'],
            $db_single['description'],
            $db_single['photo'],
            $db_single['category'],
            $db_single['calorie'],
            $db_single['vegetarian'],
            $db_single['inventory'],
            $db_single['availability']
        );
    }

}