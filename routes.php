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
$route["students"] = "WebSignup/open/student"; //Index
$route["signup/student"] = "WebSignup/valid/student"; //Index

// Signup
$route["companies"] = "WebSignup/open/company"; //Index
$route["signup/company"] = "WebSignup/valid/company"; //Index

// Signin
$route["login"] = "WebSignin/open/signin"; //Index
$route["login/valid"] = "WebSignin/valid/signin"; //Index
$route["logout"] = "WebSignin/valid/logout"; //Index

/**
 * PORTAL STUDENTS
 */

//Dashboard
$route["portal/student"] = "PortalStudentsIntership/index"; //"PortalStudents/index"; //Index

// Profile
$route["portal/student/profile"] = "PortalStudentsProfile/index"; //Index
$route["portal/student/profile/update"] = "PortalStudentsProfile/valid/update"; //Index

// Profile
$route["portal/student/cv"] = "PortalStudentsCv/index"; //Index
$route["portal/student/cv/update"] = "PortalStudentsCv/valid/update"; //Index

// Intership
$route["portal/student/intership"] = "PortalStudentsIntership/index"; //Index
$route["portal/student/intership/apply"] = "PortalStudentsIntership/valid/apply"; //Index
$route["portal/student/intership/submit"] = "PortalStudentsIntership/valid/save"; //Index

// Application
$route["portal/student/application"] = "PortalStudentsApplication/index"; //Index
$route["portal/student/application/edit"] = "PortalStudentsApplication/edit/edit"; //Edit
$route["portal/student/application/update"] = "PortalStudentsApplication/valid/update"; //Update
$route["portal/student/application/delete"] = "PortalStudentsApplication/valid/delete"; //Delete
$route["portal/student/application/view"] = "PortalStudentsApplication/valid/view"; //View

// Rating
$route["portal/student/rating"] = "PortalStudentsRating/index"; //Index
$route["portal/student/rating/view"] = "PortalStudentsRating/edit/edit"; //Edit

/**
 * PORTAL COMPANIES
 */

//Dashboard
$route["portal/company"] = "PortalCompaniesProfile/index"; //"PortalCompanies/index"; //Index

// Profile
$route["portal/company/profile"] = "PortalCompaniesProfile/index"; //Index
$route["portal/company/profile/update"] = "PortalCompaniesProfile/valid/update"; //Index

// Intership
$route["portal/company/intership"] = "PortalCompaniesIntership/index"; //Index
$route["portal/company/intership/add"] = "PortalCompaniesIntership/open/add"; //Add New
$route["portal/company/intership/save"] = "PortalCompaniesIntership/valid/save"; //Update
$route["portal/company/intership/edit/(:num)"] = "PortalCompaniesIntership/edit/edit/id/#1"; //Edit
$route["portal/company/intership/update"] = "PortalCompaniesIntership/valid/update"; //Update
$route["portal/company/intership/delete"] = "PortalCompaniesIntership/valid/delete"; //Delete

// Application
$route["portal/company/application"] = "PortalCompaniesApplication/index"; //Index
$route["portal/company/application/view"] = "PortalCompaniesApplication/edit/edit"; //Edit
$route["portal/company/application/approve"] = "PortalCompaniesApplication/valid/approve"; //Update
$route["portal/company/application/reject"] = "PortalCompaniesApplication/valid/reject"; //Update
$route["portal/company/application/completed"] = "PortalCompaniesApplication/valid/completed"; //Update

// Rating
$route["portal/company/rating"] = "PortalCompaniesRating/index"; //Index
$route["portal/company/rating/view"] = "PortalCompaniesRating/edit/edit"; //Edit
$route["portal/company/rating/rate"] = "PortalCompaniesRating/valid/rate"; //Update
