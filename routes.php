<?php

/**
 * This is a basic Route file
 */

$route["/"] = "WebHome"; // Main First-Page /   Controller
$route["default_error"] = "ErrorPage"; // Default System Error
$route["404"] = "ErrorPage/index"; // Error Controller
$route["not-allowed"] = "ErrorPage/open/notallowed"; // Error Controller

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
$route["portal/student"] = "PortalStudents/index"; //Index

// Profile
$route["portal/student/profile"] = "PortalStudentsProfile/index"; //Index
$route["portal/student/profile/update"] = "PortalStudentsProfile/valid/update"; //Index
