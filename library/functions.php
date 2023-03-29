<?php
    if(!isset($_SESSION)) 
    {
        session_start(); 
    }
    function checkEmail($clientEmail){
        $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
        return $valEmail;
    }

    function checkPrice($invPrice){
        $value = filter_var($invPrice, FILTER_VALIDATE_INT, array("options" => array("min_range"=>100, "max_range"=>2000000)));
        return $value;
    }

    function checkClassificationId($classificationId){
        $value = filter_var($classificationId, FILTER_VALIDATE_INT, array("options" => array("min_range"=>1, "max_range"=>99)));
        return $value;
    }

    // function checkStock($invStock){
    //     $value = filter_var($invStock, FILTER_VALIDATE_INT, array("options" => array("min_range"=>1, "max_range"=>99)));
    //     return $value;
    // }

    function checkImageFilename($ImageFilename){
        $pattern = "^([0-9a-zA-Z\\.\/:_-]+.(png|PNG|gif|GIF|jp[e]?g|JP[E]?G))$^";
        if (preg_match($pattern, $ImageFilename)){
            if (substr($ImageFilename, 0, 8) != "/images/"){
                $ImageFilename = "/images/" . $ImageFilename;
            }
            return $ImageFilename;
        } else {
            return "";
        }
    }

    // Build the classifications select list
    function buildClassificationList($classifications){
        $classificationList = '<select name="classificationId" id="classificationList">';
        $classificationList .= "<option>Choose a Classification</option>";
        foreach ($classifications as $classification) {
            $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
        }
        $classificationList .= '</select>';
        return $classificationList;
   }

    function checkName($name, $num){
        $pattern = '/[A-Za-z -.,]{1,30}/';
        if (preg_match($pattern, $name)){
            return $name;
        } else {
            return "";
        }
    }

    function checkDescription($Description, $num){
        $pattern='/^[A-Za-z0-9_ ?!\@#$%&*<>.,";:+=]{1,255}$/';
        return preg_match($pattern, $Description);
    }

    // Check the password for a minimum of 8 characters,
    // at least one 1 capital letter, at least 1 number and
    // at least 1 special character
    function checkPassword($clientPassword){
        $pattern = '/^(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/';
        if (preg_match($pattern, $clientPassword)){
            return $clientPassword;
        } else {
            return "";
        }
    }

    function getNavList($classifications){
        // Build a navigation bar using the $classifications array
        $navList = "<ul class='nav-ul' id='main-nav'>";
        $navList .= "<li class='nav-li'><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
        foreach ($classifications as $classification) {
            $navList .= "<li class='nav-li' ><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."'
                        title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
        }
        $navList .= '</ul>';
        return $navList;
    }

    function buildVehiclesDisplay($vehicles){
        $dv = "<div>";
        $dv .= '<ul id="inv-display">';
        foreach ($vehicles as $vehicle) {
            $dv .= '<li>';
            if ($vehicle['imgTnPath'] == null){
                $dv .= "<a href='/phpmotors/vehicles?action=view_vehicle&invId={$vehicle['invId']}'><img src='..$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
            } else {
                $dv .= "<a href='/phpmotors/vehicles?action=view_vehicle&invId={$vehicle['invId']}'><img src='../..$vehicle[imgTnPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
            }
            // $dv .= "<a href='/phpmotors/vehicles?action=view_vehicle&invId={$vehicle['invId']}'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
            $dv .= '<hr>';
            $dv .= "<a href='/phpmotors/vehicles?action=view_vehicle&invId={$vehicle['invId']}'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
            $usd = "$" . number_format($vehicle['invPrice'], 0, ".", ",");
            $dv .= "<span>$usd</span>";
            $dv .= '</li>';
        }
        $dv .= '</ul>';
        $dv .= '</div>';
        return $dv;
    }

    function buildInvItemDisplay($invInfo, $invImages){
        setlocale(LC_MONETARY,"en_US");
        $dv = "<div id='inv-detail-box'>";
        $dv .= "<div id='inv-fieldset-div'>";
        $dv .= "<fieldset id='inv-fieldset'><legend>Vehicle Information</legend>";
        $dv .= "<label class='top-detail' for='invMake'>Make <input type='text' name='invMake' id='invMake' value='$invInfo[invMake]'></label><br>";
        $dv .= "<label class='top-detail' for='invModel'>Model <input type='text' name='invModel' id='invModel' value='$invInfo[invModel]'></label><br>";
        $dv .= "<label class='top-detail' for='invPrice'>Price <input type='text' name='invPrice' id='invPrice' value='$invInfo[invPrice]'></label><br>";
        // $dv .= "<label class='top' for='invPrice'>Price <input type='text' name='invPrice' id='invPrice' value='cho money_format(%i, $invInfo[invPrice])'></label><br>";
        // $dv .= "<label class='top-detail' for='invStock'>Stock <input type='text' name='invStock' id='invStock' value='$invInfo[invStock]'></label><br>";
        $dv .= "<label class='top-detail' for='invColor'>Color <input type='text' name='invColor' id='invColor' value='$invInfo[invColor]'></label><br>";
        $dv .= "<label class='top-detail' for='invDescription'>Description </label><textarea name='invDescription' id='inv-textarea' rows='5' cols='40'
                disabled>$invInfo[invDescription]</textarea><br>";
        $dv .= "</fieldset></div>";

        if ($_SESSION["invImages"] = "" || $_SESSION["invImages"] = null){
            $dv .= "<div id='inv-img-div'><img id='inv-img' src='..$invInfo[invImage]' alt='Image of $invInfo[invMake] $invInfo[invModel] on phpmotors.com'></div>";
        } else {
            $dv .= "<div id='inv-img-div'><img id='inv-img' src='../..$invInfo[imgPath]' alt='Image of $invInfo[invMake] $invInfo[invModel] on phpmotors.com'></div>";
        }
        $dv .= "<div id='inv-thumbs-div'>";
        foreach ($invImages as $invImage){
            $dv .= "<img class='inv-thumb-img' src='../..$invImage[imgPath]' title='Click to view larger image.' alt='Image of $invInfo[invMake] $invInfo[invModel] on phpmotors.com'>";
        }
        $dv .= "</div></div>";
        return $dv;
    }


    // * * ********************************
    // *  Functions for working with images
    // * ********************************* *
    // Adds "-tn" designation to file name
    function makeThumbnailName($image) {
        $i = strrpos($image, '.');
        $image_name = substr($image, 0, $i);
        $ext = substr($image, $i);
        $image = $image_name . '-tn' . $ext;
        return $image;
   }

    // Build images display for image management view
    function buildImageDisplay($imageArray) {
        $id = '<div id="image-display-div">';
        $id .= '<ul id="image-display-ul">';
        foreach ($imageArray as $image) {
            $id .= '<li class="image-display-li">';
            $id .= "<img class='image-display-img' src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com'
                    alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
            $id .= "<a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]'
                    title='Delete the image' class='img-delete-label'>Delete $image[imgName]</a>";

            if (strpos($image['imgName'], "-tn.") == false) {
                $id .= '<label class="img-primary-label">Primary</label>';
            }
            $id .= '</li>';
        }
        $id .= '</ul>';
        $id .= '</div>';
        return $id;
    }

    // Build the vehicles select list
    function buildVehiclesSelect($vehicles) {
        $prodList = '<select name="invId" id="invId">';
        $prodList .= "<option>Choose a Vehicle</option>";
        foreach ($vehicles as $vehicle) {
            $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
        }
        $prodList .= '</select>';
        return $prodList;
    }


    // Handles the file upload process and returns the path
    // The file path is stored into the database
    function uploadFile($name) {
        // Gets the paths, full and local directory
        global $image_dir, $image_dir_path;
        if (isset($_FILES[$name])) {
            // Gets the actual file name
            $filename = $_FILES[$name]['name'];
            if (empty($filename)) {
                return;
            }
            // Get the file from the temp folder on the server
            $source = $_FILES[$name]['tmp_name'];
            // Sets the new path - images folder in this directory
            $target = $image_dir_path . '/' . $filename;
            // Moves the file to the target folder
            move_uploaded_file($source, $target);
            // Send file for further processing
            processImage($image_dir_path, $filename);
            // Sets the path for the image for Database storage
            $filepath = $image_dir . '/' . $filename;
            // Returns the path where the file is stored
            return $filepath;
        }
   }

   // Processes images by getting paths and
    // creating smaller versions of the image
    function processImage($dir, $filename) {
        // Set up the variables
        $dir = $dir . '/';
        // Set up the image path
        $image_path = $dir . $filename;
        // Set up the thumbnail image path
        $image_path_tn = $dir.makeThumbnailName($filename);
        // Create a thumbnail image that's a maximum of 200 pixels square
        resizeImage($image_path, $image_path_tn, 200, 200);
        // Resize original to a maximum of 500 pixels square
        resizeImage($image_path, $image_path, 500, 500);
   }

   // Checks and Resizes image
    function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
        // Get image type
        $image_info = getimagesize($old_image_path);
        $image_type = $image_info[2];
        // Set up the function names
        switch ($image_type) {
            case IMAGETYPE_JPEG:
                $image_from_file = 'imagecreatefromjpeg';
                $image_to_file = 'imagejpeg';
                break;
            case IMAGETYPE_GIF:
                $image_from_file = 'imagecreatefromgif';
                $image_to_file = 'imagegif';
                break;
            case IMAGETYPE_PNG:
                $image_from_file = 'imagecreatefrompng';
                $image_to_file = 'imagepng';
                break;
            default:
                return;
        } // ends the switch

        // Get the old image and its height and width
        $old_image = $image_from_file($old_image_path);
        $old_width = imagesx($old_image);
        $old_height = imagesy($old_image);
        // Calculate height and width ratios
        $width_ratio = $old_width / $max_width;
        $height_ratio = $old_height / $max_height;
        // If image is larger than specified ratio, create the new image
        if ($width_ratio > 1 || $height_ratio > 1) {
            // Calculate height and width for the new image
            $ratio = max($width_ratio, $height_ratio);
            $new_height = round($old_height / $ratio);
            $new_width = round($old_width / $ratio);
            // Create the new image
            $new_image = imagecreatetruecolor($new_width, $new_height);
            // Set transparency according to image type
            if ($image_type == IMAGETYPE_GIF) {
                $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
                imagecolortransparent($new_image, $alpha);
            }

            if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
                imagealphablending($new_image, false);
                imagesavealpha($new_image, true);
            }
            // Copy old image to new image - this resizes the image
            $new_x = 0;
            $new_y = 0;
            $old_x = 0;
            $old_y = 0;
            imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
            // Write the new image to a new file
            $image_to_file($new_image, $new_image_path);
            // Free any memory associated with the new image
            imagedestroy($new_image);
        } else {
            // Write the old image to a new file
            $image_to_file($old_image, $new_image_path);
        }
        // Free any memory associated with the old image
        imagedestroy($old_image);
   } // ends resizeImage function

?>