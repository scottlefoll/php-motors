<?php
    if(!isset($_SESSION)) 
    {
        session_start(); 
    }
    // echo "<script>alert('Vehicle Controller 1');</script>";

    // This is the vehicles controller
    // Get the database connection file
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    // Get the PHP Motors model for use as needed
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
    // Get the PHP vehicles model for use as needed
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
    // Get the functions library
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

    // Get the array of classifications
    $classifications = getClassifications();
    $navList = getNavList($classifications);

    // Get the value from the action name - value pair
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    // echo "<script>alert('Vehicle Controller 5: action = $action');</script>";

    if ($action == "Add Classification") {
        $action = "add_class_view";
    } elseif ($action == "Add Vehicle") {
        $action = "add_vehicle_view";
    } elseif ($action == "Vehicle Management") {
        $action = "";
    }

    // echo "<script>alert('Vehicle Controller 5: action = $action');</script>";

    switch ($action){
        case 'add_class_view':
            // Case to display the add class view
            // Display the alert box
            // echo "<script>alert('Vehicle Controller: add class view case');</script>";
            $_SESSION['message'] = "";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-class.php';
            exit;
        case 'add_class':
            // Display the alert box
            // echo "<script>alert('Vehicle Controller: add class case');</script>";

            // Filter and store the data
            $classificationName = ucwords(trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $classificationName = checkName($classificationName, 30);
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
            // echo "<script>alert('Vehicle Controller: add class addOutcome = $addOutcome');</script>";

            // Check and report the result
            if($addOutcome === TRUE){
                $contentFilename = strtolower(str_replace(" ", "_", $classificationName));
                $contentFilename = $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/' . $contentFilename . '_content.php';
                try {
                    $content_file_obj = fopen($contentFilename, "w");
                    $content_str = str_replace('_', ' ', $classificationName);
                    $content_str = "<p>$content_str Page Content</p>"; 
                    fwrite($content_file_obj, $content_str);
                    fclose($content_file_obj);

                    $message = "";
                    // The new new class was added to the database, and the content.php file created
                    // Redirect the browser
                    header("Location: //localhost/phpmotors/vehicles/index.php");
                    exit;
                } catch (Exception $e) {
                    $message = "<p>The $classificationName class was added to the database, but there was an error creating the content.php file.</p>";
                }
            } else {
                $message = "<p>Sorry, but the attempt to add the $classificationName class to the database failed.</p>";
            }
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-class.php';
            exit;
        case 'add_vehicle_view':
            // Case to display the add vehicle view
            // Display the alert box
            // echo "<script>alert('Vehicle Controller: add vehicle view case');</script>";
            $_SESSION['message'] = "";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
            exit;
        case 'add_vehicle':
            // Display the alert box 
            // echo "<script>alert('Vehicle Controller: add vehicle Case 1');</script>";
            // Filter and store the data
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invYear = filter_input(INPUT_POST, 'invYear', FILTER_SANITIZE_NUMBER_INT);
            $invMake = ucwords(trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $invModel = ucwords(trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $invDescription = ucfirst(trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invMiles = filter_input(INPUT_POST, 'invMiles', FILTER_SANITIZE_NUMBER_INT);
            $invColor = ucwords(trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);

            $invId = checkInvId($invId);
            $invYear = checkYear($invYear);
            $invMake = checkName($invMake, 30);
            $invModel = checkName($invModel, 30);
            $DescriptionCheck = checkDescription($invDescription, 255);
            $invPrice = checkPrice($invPrice);
            $invMiles = checkMiles($invMiles);
            $invColor = checkName($invColor, 20);
            $classificationId = checkClassificationId($classificationId);

            // Check for missing data
            if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) 
               || empty($invPrice) || empty($invId) || empty($invColor || empty($invYear) || empty($invMiles))) {
                $message = '<p>Please provide valid information for all empty form fields.</p>';
                $_SESSION['message'] = $message;
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
                exit;
            }

            // echo "<script>alert('Vehicle Controller: local data')</script>";
            // Send the data to the model
            // $addOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage,
            //                 $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

            $addOutcome = addVehicle($invId, $invYear, $invMake, $invModel, $invDescription, $invPrice, $invMiles, $invColor, $classificationId);

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
        case 'getInventoryItems':
            // Get vehicles by classificationId 
            // Used for starting Update & Delete process 
            // echo "<script>alert('Vehicle Controller: getInventoryItems case');</script>";
            // Get the classificationId 
            $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
            // Fetch the vehicles by classificationId from the DB 
            $inventoryArray = getInventoryByClassification($classificationId); 
            echo ("<!-- json -->");
            echo json_encode($inventoryArray);
            exit;
        case 'mod':
            // Vehicle update view
            // echo "<script>alert('Vehicle Controller: mod case - Update View');</script>";
            $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING);
            $invInfo = getInvItemInfo($invId);
            if(count($invInfo)<1){
                $message = 'Sorry, no vehicle information could be found.';
            }
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/update-vehicle.php';
            exit;
        case 'update_vehicle':
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invYear = filter_input(INPUT_POST, 'invYear', FILTER_SANITIZE_NUMBER_INT);
            $invMake = ucwords(trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $invModel = ucwords(trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $invDescription = ucfirst(trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invMiles = filter_input(INPUT_POST, 'invMiles', FILTER_SANITIZE_NUMBER_INT);
            $invColor = ucwords(trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
            $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);

            $invYear = checkYear($invYear);
            $invMake = checkName($invMake, 30);
            $invModel = checkName($invModel, 30);
            $DescriptionCheck = checkDescription($invDescription, 255);
            $invPrice = checkPrice($invPrice);
            $invMiles = checkMiles($invMiles);
            $invColor = checkName($invColor, 20);
            $classificationId = checkClassificationId($classificationId);

            if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) 
                || empty($invPrice) || empty($invColor || empty($invYear) || empty($invMiles))) {
                $message = '<p>Please complete all information for updating the item! Double check the classification of the item.</p>';
                $_SESSION['message'] = $message;
                include '../view/update-vehicle.php';
                exit;
            }
            $updateResult = updateVehicle($invId, $invYear, $invMake, $invModel, $invDescription, $invPrice, $invMiles, $invColor, $classificationId);
            if ($updateResult) {
                $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                // include '../view/update-vehicle.php';
                exit;
            } else {
                $message = "<p class='notice'>Error. the $invMake $invModel was not updated.</p>";
                $_SESSION['message'] = $message;
                include '../view/update-vehicle.php';
                exit;
            }
        case 'del':
            // echo "<script>alert('Vehicle Controller: del case');</script>";
            $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING);
            $invInfo = getInvItemInfo($invId);
            if(count($invInfo)<1){
                $message = 'Sorry, no vehicle information could be found.';
            }
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/delete-vehicle.php';
            exit;
        case 'delete_vehicle':
            // $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $deleteResult = deleteVehicle($invId);
            if ($deleteResult) {
                $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            } else {
                $message = "<p class='notice'>Error: the $invMake $invModel was not deleted.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            }
        case 'view_vehicle':
            # this is the view for the vehicle detail page
            $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING);
            // print("<script>alert('PHP: Vehicles Controller, invId = $invId ');</script>");
            $invInfo = getInvItemInfo($invId);
            $invImages = getInvItemImages($invId);
            // print("<script>alert('PHP: invInfo: " . json_encode($invInfo) . "');</script>");
            // print("<script>alert('PHP: invImages: " . json_encode($invImages) . "');</script>");
            if(count($invInfo)<1){
                $message = "";
                $_SESSION['message'] = "Sorry, information for vehicle ID # $invId could not be found.";
                include '../view/classification.php';
                exit;
            } else {
                $_SESSION["invInfo"] = $invInfo;
                // print("<script>alert('PHP: invInfo: " . json_encode($invInfo) . "');</script>");
                if (count($invImages) > 0) {
                    // print("<script>alert('PHP: invImages: " . json_encode($invImages) . "');</script>");
                } else {
                    $_SESSION["invImages"] = "";
                }
                $invItemDisplay = buildInvItemDisplay($invInfo, $invImages);
                $_SESSION["invItemDisplay"] = $invItemDisplay;

                include '../view/vehicle-detail.php';
                exit;
            }
        case 'vehicle_man':
            $classificationList = buildClassificationList($classifications);
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
            exit;
        case 'classification':
            # this is the view for the vehicle classification page
            // print("<script>alert('Vehicles Controller: Classification Case');</script>");
            $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // print("<script>alert('Vehicles Controller: classification, classificationName = $classificationName');</script>");
            $vehicles = getVehiclesByClassification($classificationName);
            // print("<script>alert('Vehicles Controller: classification, vehicles = $vehicles');</script>");
            // print("<script>alert('Vehicles Controller: classification, Vehicles = " . print_r($vehicles, true) . "');</script>");
            // print("<script>alert('Vehicles Controller: classification, Vehicles = " . json_encode($vehicles) . "');</script>");
            // print("<script>alert('Vehicles Controller: classification, Vehicles = " . var_export($vehicles, true) . "');</script>");
            // print("<script>alert('Vehicles Controller: classification, Vehicles = " . var_dump($vehicles) . "');</script>");
            // print("<script>alert('Vehicles Controller: classification, Vehicles = " . implode(", ", $vehicles) . "');</script>");
            // echo '<pre>';
            //     var_dump($vehicles['0']['invId']);
            // echo '</pre>';
            // echo "<pre>";
            //     print_r($vehicles);
            // echo "</pre>";
                // echo "<script>alert('" . json_encode($vehicles) . "');</script>";
            // echo '<div></div>';

            if(!count($vehicles)){
                $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
            } else {
                $vehicleDisplay = buildVehiclesDisplay($vehicles);

            }
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/classification.php';
            exit;
        default:
            $classificationList = buildClassificationList($classifications);

            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
            exit;
}

?>