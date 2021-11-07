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

// Signup
$route["signup/company"] = "WebSignup/valid/company"; //Index

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

// Profile
$route["portal/student/cv"] = "PortalStudentsCv/index"; //Index
$route["portal/student/cv/update"] = "PortalStudentsCv/valid/update"; //Index

/**
 * PORTAL COMPANIES
 */

//Dashboard
$route["portal/company"] = "PortalCompanies/index"; //Index

// Profile
$route["portal/company/profile"] = "PortalCompaniesProfile/index"; //Index
$route["portal/company/profile/update"] = "PortalCompaniesProfile/valid/update"; //Index

// Intership
$route["portal/company/intership"] = "PortalCompaniesIntership/index"; //Index
$route["portal/company/intership/add"] = "PortalCompaniesIntership/open/add"; //Add New

$route["portal/company/intership/edit"] = "PortalCompaniesIntership/edit/edit"; //Edit
$route["portal/company/intership/update"] = "PortalCompaniesIntership/valid/update"; //Update
$route["portal/company/intership/delete"] = "PortalCompaniesIntership/valid/delete"; //Delete
