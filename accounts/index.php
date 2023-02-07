<?php
    // This is the accounts controller

    // Get the database connection file
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    // Get the PHP Motors model for use as needed
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

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
        $navList .= "<li class='nav-li' ><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    
    // echo $navList;
    // exit;

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }
     
    // if (isset($_GET["action"])) {
        // $action = filter_input(INPUT_GET, "action");
        // Display the alert box 
        // echo "<script type='text/javascript'>alert('{$action}');</script>";    
    // }
 

    switch ($action){
        case 'login':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
                // Display the alert box 
                // echo "<script>alert('Load Login page');</script>";
            break;
        case 'register':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/register.php';
                // Display the alert box 
                // echo "<script>alert('Load Register page');</script>";
            break;
        default:
            break;
    }


?>





