<!-- Image uploads controller -->

<?php

    if(!isset($_SESSION)) 
    {
        session_start(); 
    }

    // Get the PHP Motors main model for use as needed
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
    // Get the vehicles model for use as needed
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
    // Get the vehicles uploads for use as needed
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/uploads-model.php';
    // Get the connections library
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
    //  Get the functions library
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

    // Get the array of classifications
	$classifications = getClassifications();
    $navList = getNavList($classifications);

    // * * ****************************************************
    // * Variables for use with the Image Upload Functionality
    // * **************************************************** *
    // directory name where uploaded images are stored
    // $image_dir = '/phpmotors/uploads/images';
    $image_dir = '/phpmotors/images/vehicles';
    // The path is the full path from the server root
    $image_dir_path = $_SERVER['DOCUMENT_ROOT'] . $image_dir;


    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    // echo "<script>alert('Uploads Controller: Action = $action');</script>";

    switch ($action) {
        case 'upload':
            // echo "<script>alert('Uploads Controller: Upload action');</script>";
            // Store the incoming vehicle id and primary picture indicator
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $imgPrimary = filter_input(INPUT_POST, 'imgPrimary', FILTER_VALIDATE_INT);

            // Store the name of the uploaded image
            $imgName = $_FILES['file1']['name'];
            $imageCheck = checkExistingImage($imgName);
            // echo "<script>alert('Uploads Controller: Upload: invId = $invId, imgName = $imgName');</script>";

            if($imageCheck){
                $message = '<p class="notice">An image by that name already exists.</p>';
            } elseif (empty($invId) || $invId == 0 || empty($imgName)) {
                $message = '<p class="notice">You must select a vehicle and image file for the vehicle.</p>';
            } else {
                // Upload the image, store the returned pat h to the file
                $imgPath = uploadFile('file1');
                if ($imgPrimary == 1){
                    // If the image is set as primary, set the all existing images for the vehicle to not primary
                    setImgPrimaryOff($invId);
                }
                // Insert the image information to the database, get the result
                $result = storeImages($imgPath, $invId, $imgName, $imgPrimary);

            // Set a message based on the insert result
            if ($result) {
                $message = '<p class="notice">The upload succeeded.</p>';
            } else {
                $message = '<p class="notice">Sorry, the upload failed.</p>';
            }
            }

            // Store message to session
            $_SESSION['message'] = $message;

            // Redirect to this controller for default action
            header('location: .');
            exit;
        case 'delete':
            // echo "<script>alert('Uploads Controller: delete action');</script>";
            // Get the image name and id
            $filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $imgId = filter_input(INPUT_GET, 'imgId', FILTER_VALIDATE_INT);

            // Build the full path to the image to be deleted
            $target = $image_dir_path . '/' . $filename;

            // Check that the file exists in that location
            if (file_exists($target)) {
            // Deletes the file in the folder
            $result = unlink($target); 
            }

            // Remove from database only if physical file deleted
            if ($result) {
            $remove = deleteImage($imgId);
            }
            // Set a message based on the delete result
            if ($remove) {
            $message = "<p class='notice'>$filename was successfully deleted.</p>";
            } else {
            $message = "<p class='notice'>$filename was NOT deleted.</p>";
            }

            // Store message to session
            $_SESSION['message'] = $message;
            // Redirect to this controller for default action
            header('location: .');
            exit;

        case 'make_primary':
            // echo "<script>alert('Uploads Controller: Swap Primary action');</script>";
            // Get the image name and id
            $imgName = filter_input(INPUT_GET, 'imgName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            // echo "<script>alert('filename = $imgName, InvId = $invId ');</script>";
            // Make primary image
            // call the model setPrimaryImage
            setPrimaryImage($invId, $imgName);
            // Store message to session
            $_SESSION['message'] = $message;
            // Redirect to this controller for default action
            header('location: .');
            exit;
        default:
            // echo "<script>alert('Uploads Controller: Default View');</script>";
            // This function builds the image display for the image admin view
            // Call the model to return image info from database
            $imageArray = getImages();

            // Build the image information into HTML for display
            if (count($imageArray)) {
                // call the function to build the image display
                $imageDisplay = buildImageDisplay($imageArray);
            } else {
                $imageDisplay = '<p class="notice">Sorry, no images could be found.</p>';
            }

            // Get vehicles information from database
            $vehicles = getImgVehicles();
            // Build a select list of vehicle information for the view
            $prodSelect = buildVehiclesSelect($vehicles);

            include '../view/image-admin.php';
            exit;
       }

?>