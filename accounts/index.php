<?php
    // This is the accounts controller
<<<<<<< HEAD
    $action = filter_input(INPUT_POST, 'action');
        if ($action == NULL){
            $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        case 'something':
            break;
        default:
            include $_SERVER['DOCUMENT_ROOT'] . '/library/connections.php';
            include $_SERVER['DOCUMENT_ROOT'] . '/model/main-model.php';
=======

    // Get the database connection file
    // require_once 'library/connections.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    // Get the PHP Motors model for use as needed
    // require_once 'model/main-model.php';
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

    switch ($action){
        case '':
            break;
        default:
            break;
            // include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php';
>>>>>>> bb8d81e22b93458e733066709e615d8868b0a729
    }

?>