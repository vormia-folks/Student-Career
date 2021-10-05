<?php

/**
 * This is a basic Route file
 */

$route["/"] = "Welcome"; //Welcome Controller
$route["default_error"] = "Error"; //Default System Error
$route["404"] = "Error/404"; //Error Controller

// Custom Routes
$route["student/signup"] = "Signup/students";
