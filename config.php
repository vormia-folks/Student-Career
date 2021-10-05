<?php

/**
 * 
 * This file holds main configurations of the project
 * 
 * We set-up the base URL database configuration and more from this file.
 */

//  BASE URL
$config['base_url'] = "http://localhost:8888/External/StudentCareer";

// Database Config
$config['db_name'] = "external_studentcareer";
$config['db_host'] = "localhost";
$config['db_user'] = "root";
$config['db_password'] = "root";

// Database Config Plus
$config['db_prefix'] = "";

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

// Generate Route
function fetchRouteController($urlToken)
{
    // Change to String
    $url_string = strtolower(implode('/', $urlToken));
    $get_request = null;

    // Chec Get Request
    if (strpos($url_string, '?')) {

        /**
         * Check Get Request
         */
        $get_request_checker = end($urlToken);
        $get_request = (count($get_request_checker) > 0) ? explode('?', $get_request_checker) : null;
        $get_request = (!is_null($get_request)) ? $get_request[1] : null;

        // URL String
        $url_string = substr($url_string, 0, strpos($url_string, "?"));
    }

    // Include Route File
    require_once 'routes.php';

    // Find Route
    if (array_key_exists("$url_string", $route)) {
        // Return the Controller
        $controllerFound = addExtName($route["$url_string"]);
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
            }
        }
    }

    // Controller Route
    $fullRoute = (!is_null($get_request)) ? $controllerFound . "?$get_request" : $controllerFound;

    // Return Value
    return $fullRoute;
}
