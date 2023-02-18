<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    $_SESSION["status"] = "account";
    // This is the accounts controller
    // Get the database connection file
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    // Get the PHP Motors model for use as needed
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
    // Get the accounts model
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts-model.php';
    // Get the functions library
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

    // Display the alert box 
    // echo "<script>alert('Accounts: index.php');</script>";

    // Get the array of classifications
    $classifications = getClassifications();
    $navList = getNavList($classifications);

    // Get the value from the action name - value pair
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    // echo "<script>alert('Accounts Controller: action = $action');</script>";

    // $action = $_SESSION['status'];
    
    switch ($action){
        case 'login_view':
            // Case to display the login view
            // Display the alert box 
            // echo "<script>alert('Account Controller: login view case');</script>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
            
        case 'login':
            # this is the login page view
            // echo "<script>alert('Accounts Controller: case = login');</script>";

            // Filter and store the data
            $clientEmail = strtolower(trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL)));
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);
            
            // Check for missing data
            if (empty($clientEmail) || empty($checkPassword)) {
                // echo "<script>alert('Accounts Controller: clientEmail = $clientEmail , clientPassword = $clientPassword');</script>";
                $message = '<p>Please provide information for all empty form fields.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
                exit; 
            }

            // Send the data to the model
            // echo "<script>alert('Accounts Controller: loginClient clientEmail = $clientEmail, hashPassword = $hashedPassword ');</script>";
            $logOutcome = logClient($clientEmail, $clientPassword);
            // echo "<script>alert('Accounts Controller: login outcome = $logOutcome');</script>";

            // Check and report the result
            if($logOutcome === TRUE){
                $_SESSION["login"] = "true";
                $_SESSION["email"] = $clientEmail;
                $message = "<p>Thank you. You are now logged in as $clientEmail.</p>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/index.php';
                exit;
            } else {
                $message = "<p>Sorry $clientEmail, but the login failed. Please try again.</p>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
                exit;
            }

        case 'reg_view':
            // Case to display the register view
            // Display the alert box 
            // echo "<script>alert('Account Controller: register view case');</script>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
            exit;

        case 'register':
            # this is the register page view
            // echo "<script>alert('Accounts Controller: case = register');</script>";

            // Filter and store the data
            $clientFirstname = ucwords(trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $clientLastname = ucwords(trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $clientEmail = strtolower(trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL)));
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $clientFirstname = checkName($clientFirstname, 15);
            $clientLastname = checkName($clientLastname, 25);
            $checkPassword = checkPassword($clientPassword);
            
            // Check for missing data
            if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
                exit; 
            }

            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

            // Display the data 
            // echo "<script>alert('Vehicle Controller: register data: $clientFirstname, $clientLastname, $clientEmail, $clientPassword');</script>";

            // Send the data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);            
            // echo "<script>alert('Accounts Controller: register regOutcome = $regOutcome');</script>";

            // Check and report the result
            if($regOutcome === TRUE){
                $message = "<p>Thank you for registering, $clientFirstname. Please use your email and password to login.</p>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
                exit;
            } else {
                // if(strpos($message, "Duplicate entry") !== false)
                $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
                exit;
            }
        default:
            // Display the login view by default
            // echo "<script>alert('Accounts Controller: login view');</script>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
    }
?>