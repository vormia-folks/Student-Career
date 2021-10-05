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
$pattern = '/external\/studentcareer/i';
$route_url_token = preg_replace($pattern, '', $uri_token);
//Removes whitespace or other predefined char
$uri_token = explode('/', rtrim($route_url_token, '/'));
$uri_array = array_values(array_filter($uri_token, fn ($value) => !is_null($value) && $value !== ''));

// Find Controller Route
$controllerName = fetchRouteController($uri_array);

echo "<pre>";
//print_r($uri_array);

echo "<br />";
echo ($controllerName);
echo "<br />";
