<?php

/**
 * This is a basic Route file
 */

$route["/"] = "WebHome"; // Main First-Page /   Controller
$route["default_error"] = "Error"; // Default System Error
$route["404"] = "Error/404"; // Error Controller

// Custom Routes
$route["student/signup"] = "Signup/students";
$route["signup"] = "Signup/passed";

$route['student/name/(:val)'] = "Signup/students/#1";
$route['student/passed'] = "Signup/passed";
$route['student/check/(:val)/(:num)'] = "Signup/students/#1/#2";

// WEBSITE
$route["home"] = "WebHome"; //Index

// Signup
$route["access"] = "WebSignup"; //Index
$route["signup/student"] = "WebSignup/valid/student"; //Index

// Signin
$route["login"] = "WebSignin/open/signin"; //Index
$route["login/valid"] = "WebSignin/valid/signin"; //Index
$route["logout"] = "WebSignin/valid/logout"; //Index

/**
 * PORTAL STUDENTS
 */

//Dashboard
$route["portal/students"] = "PortalStudents/index"; //Index
