<?php
/**
 * This File use to test and show all Session Variables
 * Created by PhpStorm.
 * User: henry
 * Date: 3/10/18
 * Time: 22:50
 */

function out($var) {
    echo "
    <script>
    console.log('$var');
    </script>
    ";
}

function alert($var) {
    echo "
    <script>
    alert('$var');
    </script>
    ";
}