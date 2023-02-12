<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    $_SESSION["status"] = "home";
    $_SESSION["login"] = "false";
    $_SESSION["email"] = "";

    // require __DIR__."/vendor/autoload.php"; // This tells PHP where to find the autoload file so that PHP can load the installed packages

    // // setup the Logger instance
    // use Monolog\Logger; // The Logger instance
    // use Monolog\Handler\StreamHandler; // The StreamHandler sends log messages to a file on your disk
    // $logger = new Logger("daily");
    // $stream_handler = new StreamHandler("php://stdout");
    // $logger->pushHandler($stream_handler);
    // // send test log messages
    // $logger->debug("This file has been executed.");

    // This is the main controller for the site
    // Get the database connection file
    // require_once 'library/connections.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    // Get the PHP Motors model for use as needed
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

    // Get the array of classifications
	$classifications = getClassifications();
    // var_dump($classifications);
	// exit;

    // Build a navigation bar using the $classifications array
    $navList = "<ul class='nav-ul' id='main-nav'>";
    $navList .= "<li class='nav-li'><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li class='nav-li' ><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    
    // echo $navList;
    // exit;

    // This is the main controller for the site

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    echo "<script>alert('Main Controller: Action = $action');</script>";

    // if ($action == 'loginClient'){
    //     $action = 'home';
    //     // echo "<script>alert('Main Controller: Action Delta = $action');</script>";
    // }

    switch ($action){
        case 'home':
            $_SESSION["status"] = "home";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
            break;

        case '500':
            $_SESSION["status"] = "500";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/500.php';
            break;   
        case 'add_class':
                $_SESSION["status"] = "add_class";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicle/index.php';
                break;
        case 'add_vehicle':
                $_SESSION["status"] = "add_vehicle";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicle/index.php';
                break;
        case 'vehicle_man':
                $_SESSION["status"] = "vehicle_man";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
                break;
        case 'login':
            $_SESSION["status"] = "login";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            break;
        case 'register':
            $_SESSION["status"] = "register";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
            break;
        default:
            $_SESSION["status"] = "home";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
            break;
    }

?>