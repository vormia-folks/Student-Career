<?php

/**
 * 
 * This file holds main configurations of the project
 * 
 * We set-up the base URL database configuration and more from this file.
 */

//  BASE URL
// $config['base_url'] = "External/StudentCareer";
// $config['assets_url'] = "public/";
// $config['view_url'] = "views/";

// // Database Config
// $config['db_name'] = "external_studentcareer";
// $config['db_host'] = "localhost";
// $config['db_user'] = "root";
// $config['db_password'] = "root";

// // Database Config Plus
// $config['db_prefix'] = "";

require('libraries/config.php');

// Connection

// Add PHP extension from Controller Name
function addExtName($controllerName)
{
    // Get Array    
    $controller_route = explode('/', trim($controllerName));
    $controller_route[0] = trim(ucwords($controller_route[0])) . ".php";

    // Get Path
    return implode('/', $controller_route);
}

// Get Controller Class Name
function getClassName($controller)
{
    // Look for . [we are searching for .php]
    if (strpos($controller, '.')) {
        $controller = strtok($controller, '/');
        $controller = explode(".php", $controller);
        $controller = $controller[0];
    }

    // Return Found Data
    return $controller;
}

//Fetch Controller Routes
function findControllerRoute($url_string, $route)
{
    // Check
    if (array_key_exists("$url_string", $route)) {
        // Return the Controller
        return $url_string;
    } else {

        //  Remove (:val) && (:num) from String
        $search_route_url = str_replace("/(:val)", '', $url_string);
        $search_route_url = str_replace("/(:num)", '', $search_route_url);

        // Explode
        $routeArray = explode("/", $search_route_url);

        if (count($routeArray) > 1) {

            $val = end($routeArray);
            $type_set = (is_numeric($val)) ? "(:num)" : "(:val)";
            $search_route = str_replace($val, $type_set, $url_string);

            // Find Route
            return findControllerRoute($search_route, $route);
        } else {
            return false;
        }
    }
}

// Generate Route
function fetchRouteController($urlToken)
{
    // Change to String
    $url_string = strtolower(implode('/', $urlToken));

    // URL String
    $url_string = (strpos($url_string, '?')) ? substr($url_string, 0, strpos($url_string, "?")) : $url_string;

    // Include Route File
    require_once 'routes.php';

    // Find Route
    $foundRoute = findControllerRoute($url_string, $route);

    // Check Route
    if ($foundRoute) {
        // Return the Controller
        $controllerFound = addExtName($route["$foundRoute"]);
    } else {
        // Check If Controller Exist
        $controller = (count($urlToken) > 0) ? $urlToken[0] : null;

        // Home Page
        if (is_null($controller)) {
            $controllerFound = addExtName($route["/"]);
        } else {
            // Check If Controller File is found
            $filename = "controllers/" . ucfirst($controller) . ".php";
            if (file_exists($filename)) {
                $controllerFound = addExtName($url_string);
            } else {
                $controllerFound = addExtName($route["default_error"]);
                $controllerFound = explode('/', $controllerFound);
                array_push($controllerFound, 'controller');
                $controllerFound = implode('/', $controllerFound);
            }
        }
    }

    // Return Value
    return $controllerFound;
}
