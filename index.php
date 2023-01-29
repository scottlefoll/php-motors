<?php

    // Get the database connection file
    // require_once 'library/connections.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    // Get the PHP Motors model for use as needed
    // require_once 'model/main-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

    // Get the array of classifications
	$classifications = getClassifications();
    var_dump($classifications);
	exit;

    // This is the main controller for the site

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        case 'something':
            break;
        default:
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
    }

?>