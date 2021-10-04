<?php

/**
 * This will be our main file, every page will be routed from here.
 * Eg: Home.php will be responsible to access our home page. so we will route the file as /index.php/Home/php
 * 
 * -> We are following a MVC development model were, M- Modal (CRUD staff), V- View (HTML), C -Controller (Logic)
 * 
 */

//  Step 1 Include config
require_once "config.php";

//Step 2 is to access the URI
$uri_token = rtrim($_SERVER['REQUEST_URI'], '/'); //Removes whitespace or other predefined char

// Remove Base URL
$base_url = $config['base_url'];

echo "<pre>";
print_r($uri_token);
echo "<br />";
print($base_url);

echo "<br />";
echo "<br />";


$str = '/External/StudentCareer/index.php/Home.php/about';
$pattern = '/external\/studentcareer/i';
echo preg_replace($pattern, '', $str);
