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

    if ($action == "Add Classification") {
        $action = "add_class_view";
    } elseif ($action == "Add Vehicle") {
        $action = "add_vehicle_view";
    }
    
    // echo "<script>alert('Vehicle Controller: action = $action');</script>";

    // $action = $_SESSION['status'];

    switch ($action){
        case 'add_class_view':
            // Case to display the add class view
            // Display the alert box 
            // echo "<script>alert('Vehicle Controller: add class view case');</script>";

            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-class.php';
            exit;
        case 'add_class':
            // Display the alert box 
            // echo "<script>alert('Vehicle Controller: add class case');</script>";

            // Filter and store the data
            $classificationName = ucwords(trim(filter_input(INPUT_POST, 'classificationName')));
            // Check for missing data
            if(empty($classificationName)){
                $message = '<p>Please provide information for all empty form fields.</p>';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-class.php';
                exit; 
            }
            // Display the data 
            // echo "<script>alert('Vehicle Controller data: $classificationName);</script>";

            // Send the data to the model
            $addOutcome = addClass($classificationName);

            // Check and report the result
            if($addOutcome === TRUE){

                $contentFileName = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/' . $classificationName . '_content.php';
                $contentfile = fopen($contentFileName, "w");
                $contentStr = "<p>Trucks  Page Content</p>";
                fwrite($contentfile, $contentStr);
                fclose($contentfile);

                // Create the actual connection object and assign it to a variable
                try {
                    $contentfile = fopen($contentFileName, "w");
                    $contentStr = "<p>Trucks  Page Content</p>";
                    fwrite($contentfile, $contentStr);
                    fclose($contentfile);
                    // $message = "<p>The new $classificationName class was added to the database, and the content.php file created.</p>";
                    $message = "";
                    // Redirect the browser
                    header('Location: http://localhost/phpmotors/vehicles/index.php');
                    exit;                    

                } catch (Exception $e) {
                    $message = "<p>The $classificationName class was added to the database, but there was an error creating the content.php file.</p>";
                    // Redirect the browser
                    header('Location: http://localhost/phpmotors/vehicles/index.php');
                    exit;
                } 
            } else {
                $message = "<p>Sorry, but the attempt to add the $classificationName class to the database failed.</p>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
                exit;    
            }
        case 'add_vehicle_view':
            // Case to display the add vehicle view
            // Display the alert box 
            // echo "<script>alert('Vehicle Controller: add vehicle view case');</script>";

            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
            exit;
        case 'add_vehicle':
            // Display the alert box 
            // echo "<script>alert('Vehicle Controller: add vehicle Case');</script>";

            // Filter and store the data
            $invMake = ucwords(trim(filter_input(INPUT_POST, 'invMake')));
            $invModel = ucwords(trim(filter_input(INPUT_POST, 'invModel')));
            $invDescription = ucfirst(trim(filter_input(INPUT_POST, 'invDescription')));
            $invImage = strtolower(trim(filter_input(INPUT_POST, 'invImage')));
            $invThumbnail = strtolower(trim(trim(filter_input(INPUT_POST, 'invThumbnail'))));
            $invPrice = filter_input(INPUT_POST, 'invPrice');
            $invStock = filter_input(INPUT_POST, 'invStock');
            $invColor = ucwords(trim(filter_input(INPUT_POST, 'invColor')));
            $classificationId = filter_input(INPUT_POST, 'classificationId');

            // echo "<script>alert('Vehicle Controller: local data')</script>";

            // Send the data to the model
            $addOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, 
                            $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

            // Check and report the result
            if($addOutcome === TRUE){
                // echo "<script>alert('Vehicle Controller: addOutcome = $addOutcome ');</script>";
                // $message = "<p>Success - $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId added.</p>";
                $message = "<p>Success - $invMake $invModel has been added to inventory.</p>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
                exit; 
            } else {
                $message = "<p>The attempt to add the $invMake $invModel to inventory has failed.</p>";
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
                exit;
            }   
        default:
            # vehicle_man view:
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
            exit;
}

?>