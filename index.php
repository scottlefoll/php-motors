<?php
<<<<<<< HEAD
=======
    // This is the main controller for the site
>>>>>>> bb8d81e22b93458e733066709e615d8868b0a729

    // Get the database connection file
    // require_once 'library/connections.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    // Get the PHP Motors model for use as needed
    // require_once 'model/main-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

    // Get the array of classifications
	$classifications = getClassifications();
<<<<<<< HEAD
    var_dump($classifications);
	exit;
=======
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
>>>>>>> bb8d81e22b93458e733066709e615d8868b0a729

    // This is the main controller for the site

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
<<<<<<< HEAD
        case 'something':
            break;
        default:
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
=======
        case 'template':
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php';
        default:
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
            // include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php';
>>>>>>> bb8d81e22b93458e733066709e615d8868b0a729
    }

?>