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

    // Display the alert box 
    // echo "<script>alert('Accounts: index.php');</script>";

    // Get the array of classifications
	$classifications = getClassifications();
    // var_dump($classifications);
	// exit;

    // Build a navigation bar using the $classifications array
    $navList = "<ul class='nav-ul' id='main-nav'>";
    $navList .= "<li class='nav-li'><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li class='nav-li' ><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."'title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    
    // echo $navList;
    // exit;

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
            $clientEmail = strtolower(trim(filter_input(INPUT_POST, 'clientEmail')));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword'));

            // Check for missing data
            if(empty($clientEmail) || empty($clientPassword)){
                // echo "<script>alert('Accounts Controller: clientEmail = $clientEmail , clientPassword = $clientPassword');</script>";
                $message = '<p>Please provide information for all empty form fields.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
                exit; 
            }

            // Send the data to the model
            $logOutcome = logClient($clientEmail, $clientPassword);            
            // echo "<script>alert('Accounts Controller: login outcome = $logOutcome');</script>";

            // Check and report the result
            if($logOutcome === 1){
                $_SESSION["login"] = "true";
                $_SESSION["email"] = $clientEmail;
                $message = "<p>Thank you. You are now logged in as $clientEmail.</p>";
                # PROBLEM - shouldn't this be going through the controller?
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
            $clientFirstname = ucwords(trim(filter_input(INPUT_POST, 'clientFirstname')));
            $clientLastname = ucwords(trim(filter_input(INPUT_POST, 'clientLastname')));
            $clientEmail = strtolower(ucwords(trim(filter_input(INPUT_POST, 'clientEmail'))));
            $clientPassword = filter_input(INPUT_POST, 'clientPassword');

            // Check for missing data
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
                $message = '<p>Please provide information for all empty form fields.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
                exit; 
            }

            // Display the data 
            // echo "<script>alert('Vehicle Controller data: $invMake, $invModel, $invDescription, $invImage, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId');</script>";

            // Send the data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);            
            
            // Check and report the result
            if($regOutcome === 1){
                $message = "<p>Thank you for registering, $clientFirstname. Please use your email and password to login.</p>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
                exit;
            } else {
                // if(strpos($message, "Duplicate entry") !== false)
                $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
                exit;
            }
        // case 'logout':
        //     // Check and report the result
        //     if($logOutcome === 1){
        //         $_SESSION["login"] = "false";
        //         $message = "<p>Thank you. You are now loggout out.</p>";
        //         include '../view/home.php';
        //         exit;
        //     } else {
        //         $message = "<p>You are already logged out.</p>";
        //         include '../view/home.php';
        //         exit;
        //     }
        default:
            // Display the login view by default
            // echo "<script>alert('Accounts Controller: login view');</script>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
    }


?>





