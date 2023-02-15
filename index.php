<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    $_SESSION["status"] = "main";
    $_SESSION["login"] = "false";
    $_SESSION["email"] = "";

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

    // echo "<script>alert('Main Controller: Action = $action');</script>";

    switch ($action){
        case 'home':
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
            break;
        case '500':
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/500.php';
            break;   
        case 'template':
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php';
            break;       
        default:
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
            break;
    }

?>