<?php
/* 
    Accounts controller.
 */

// Create or access a Session
session_start();

// Get the databaes connection file
require_once '../library/connections.php';
//Get the functions library
require_once '../library/functions.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar
$navList = navigationBar($classifications);

// Get the value from the action name - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}
switch ($action) {
    case 'login':
        include '../view/login.php';
        break;
    case 'registration':
        include '../view/registration.php';
        break;
    case 'Login':
        // Trim, filter and store two data inputs from login page
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($clientEmail) || empty($checkPassword)) {
            $message =
            '<p class="error">Please provide information for all empty form fields.</p>';
            include '../view/login.php';
            exit;
        }
          
        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
        $message = '<p class="notice">Please check your password and try again.</p>';
        include '../view/login.php';
        exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        include '../view/admin.php';
        exit;
        break;

    case 'Logout':
        unset($_SESSION['loggedin']);
        session_destroy();
        header('Location: /phpmotors/');
        break;

    case 'register':
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Check for an existing email address
        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the table
        if ($existingEmail){
            $message = 
            '<p class="notice">That email address already exists.</p>';
            include '../view/client-update.php';
            exit;
        }

        // Check for missing data
        if (empty($clientFirstname) 
            || empty($clientLastname) 
            || empty($clientEmail) 
            || empty($checkPassword)) {
            $message =
            '<p class="error">Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if ($regOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'update-client':
        $clientInfo = $_SESSION['clientData'];
        include '../view/client-update.php';
        break;
    case 'updateClient':
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        $clientEmail = checkEmail($clientEmail);

        if (!$clientEmail===$_SESSION['clientData']['clientEmail']){
            // Check for an existing email address
            $clientEmail = checkExistingEmail($clientEmail);
            exit;
        }

        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $message = "<p class='error'>Please complete all information for the updated item!</p>";
            include '../view/client-update.php';
            exit;   
        }
        $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
        if (isset($updateResult)) {
            $message = "<p class='success'>Congratulations, the information of $clientFirstname $clientLastname was successfully updated.</p>";
            $_SESSION['message'] = $message;
            // Query the client data based on the client id
            $clientData = getClientById($clientId);
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            // Send them to the admin view
            include '../view/admin.php';
            exit;
        } else {
            $message = "<p class='error'>Error. The account information was not updated.</p>";
            $_SESSION['message'] = $message;
            include '../view/admin.php';
            exit;
        }
        break;
    case 'updatePassword':
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($checkPassword)){
            $message =
            '<p class="error">Please make sure your password matches the desired pattern.</p>';
            $_SESSION['message'] = $message;
            include '../view/client-update.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $updateResult = updatePassword($hashedPassword, $clientId);
        if ($updateResult) {
            $message = "<p class='success'>Congratulations, your password was successfully updated.</p>";
            $_SESSION['message'] = $message;
            include '../view/admin.php';
            exit;
        } else {
            $message = "<p class='error'>Error. The password was not updated.</p>";
            $_SESSION['message'] = $message;
            include '../view/admin.php';
            exit;
        }
        break;
    default:
        include '../view/admin.php';
        break;
}
?>
