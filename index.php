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
$controllerRoute = fetchRouteController($uri_array); // Full Controller Path
$controllerPassed = explode('/', $controllerRoute); // Controller File Name
$controllerClass = getClassName($controllerRoute); // COntroller Class Name

// Check Parameters
$para_key = array_search("#1", $controllerPassed);
if ($para_key > 0) {
    while ($para_key < count($uri_array)) {
        $controllerPassed[$para_key] = $uri_array[$para_key];
        $para_key++;
    }
}

/**
 * @var string|array
 * 
 * Check Get Request
 */
$get_request_checker = end($uri_array);
$get_request = (count($get_request_checker) > 0) ? explode('?', $get_request_checker) : null;
$get_request = (!is_null($get_request)) ? $get_request[1] : null;

// Require The Controller
$controllerName = $controllerPassed[0];
require_once("controllers/" . $controllerName);
$controller = new $controllerClass;

// Call Controller Method
$method = (array_key_exists(1, $controllerPassed)) ? $controllerPassed[1] : 'index';
if (count($controllerPassed) > 2) {
    // Paraneters - skip key 0 and 1, strat from key 2
    for ($i = 2; $i < count($controllerPassed); $i++) {
        $param[$i] = $controllerPassed[$i];
    }
    // Parameters
    $arguments = array_values($param);

    // Access Method
    call_user_func_array(array($controller, $method), $arguments);
} else {
    // Access Method
    $controller->{$method}();
}
