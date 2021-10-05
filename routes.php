<?php

/**
 * This is a basic Route file
 */

$route["/"] = "Welcome"; //Welcome Controller
$route["default_error"] = "Error"; //Default System Error
$route["404"] = "Error/404"; //Error Controller

// Custom Routes
$route["student/signup"] = "Signup/students";
$route["signup"] = "Signup/passed";

$route['student/name/(:val)'] = "Signup/students/#1";
$route['student/passed'] = "Signup/passed";
$route['student/check/(:val)/(:num)'] = "Signup/students/#1/#2";
