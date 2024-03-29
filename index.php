<?php
/* 
    The main controller.
 */

// Create or access a Session
session_start();

// Get the databaes connection file
require_once 'library/connections.php';
//Get the functions library
require_once 'library/functions.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar
$navList = navigationBar($classifications);

// echo $navList;
// exit;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

/* if($_SESSION['loggedin']=TRUE){
    $sessionFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
} */

switch ($action) {
    case 'template':
        include 'view/template.php';
        break;
    default:
        include 'view/home.php';
        break;
}



?>