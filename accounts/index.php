<?php
    // This is the accounts controller

    // Get the database connection file
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

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = 'login';
    }

    switch ($action){
        case 'login':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
        case 'register':
            if ($action != 'login'){
                require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/register.php';
            }
        default:
            break;
    }

?>





