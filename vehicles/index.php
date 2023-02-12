<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    $_SESSION["status"] = "vehicle";
    // This is the vehicles controller 
    // Get the database connection file
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    // Get the PHP Motors model for use as needed
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
    // Get the PHP vehicles model for use as needed
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';

    // Display the alert box 
    // echo "<script>alert('Vehicle: index.php');</script>";

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
    
    // Get the value from the action name - value pair
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    echo "<script>alert('Vehicle Controller: action = $action');</script>";

    // $action = $_SESSION['status'];

    switch ($action){
        case 'add_class':
            // Display the alert box 
            echo "<script>alert('Vehicle Controller: add class case');</script>";

            // Filter and store the data
            $classificationName = filter_input(INPUT_POST, 'classificationName');

            // Check for missing data
            if(empty($classificationName)){
                $message = '<p>Please provide information for all empty form fields.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-class.php';
                exit; 
            }
            
            // Display the data 
            echo "<script>alert('Vehicle Controller data: $classificationName);</script>";

            // Send the data to the model
            $addOutcome = addClassification($classificationName);

            // Check and report the result
            if($addResult === TRUE){
                echo "<script>alert('Success - classification $classificationName is added.');</script>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
                exit;
            } else {
                echo "<script>alert('The attempt to add classification $classificationName to inventory failed.');</script>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-class.php';
                exit;
            } 
        case 'add_vehicle':
            // Display the alert box 
            echo "<script>alert('Vehicle Controller: add vehicle Case');</script>";

            // Filter and store the data
            $invMake = filter_input(INPUT_POST, 'invMake');
            $invModel = filter_input(INPUT_POST, 'invModel');
            $invDescription = filter_input(INPUT_POST, 'invDescription');
            $invImage = filter_input(INPUT_POST, 'invImage');
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
            $invPrice = filter_input(INPUT_POST, 'invPrice');
            $invStock = filter_input(INPUT_POST, 'invStock');
            $invColor = filter_input(INPUT_POST, 'invColor');
            $classificationId = filter_input(INPUT_POST, 'classificationId');

            // Check for missing data
            if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($indImage)
                || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)
                || empty($classificationId)){
                $message = '<p>Please provide information for all empty form fields.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
                exit; 
            }
            
            // Display the data 
            echo "<script>alert('Vehicle Controller data: $invMake, $invModel, $invDescription, 
                    $invImage, $invThumbnail, $invPrice, $invStock, $invColor, 
                    $classificationId');</script>";

            // Send the data to the model
            $addOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, 
                            $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

            // Check and report the result
            if($addResult === TRUE){
                echo "<script>alert('Success - $invMake $invModel is added to inventory.');</script>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
                exit;
            } else {
                echo "<script>alert('The attempt to add $invMake $invModel to inventory failed.');</script>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
                exit;
            }   
        default:
            exit;
}

?>