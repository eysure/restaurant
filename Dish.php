<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 3/17/18
 * Time: 14:11
 */

class Dish {
    private $name;
    private $price;
    private $description;
    private $img;
    private $category;
    private $calorie;
    private $vegetarian;

    /**
     * Dish constructor.
     * @param $name
     * @param $price
     * @param $description
     * @param $img
     * @param $category
     * @param $calorie
     * @param $vegetarian
     */
    public function __construct($name, $price, $description, $img, $category, $calorie, $vegetarian)
    {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->img = $img;
        $this->category = $category;
        $this->calorie = $calorie;
        $this->vegetarian = $vegetarian;
    }
}