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

    function checkStock($invStock){
        $value = filter_var($invStock, FILTER_VALIDATE_INT, array("options" => array("min_range"=>1, "max_range"=>99)));
        return $value;
    }

    function checkImageFilename($ImageFilename){
        $pattern = "^([0-9a-zA-Z\\.\/:_-]+.(png|PNG|gif|GIF|jp[e]?g|JP[E]?G))$^";
        if (preg_match($pattern, $ImageFilename)){
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

    function getVehiclesByClassification($classificationName){
        $db = phpConnect();
        $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $vehicles;
       }

    function buildVehiclesDisplay($vehicles){
        $dv = '<div>';
        $dv .= '<ul id="inv-display">';
        foreach ($vehicles as $vehicle) {
            $dv .= '<li>';
            $dv .= "<a href='/phpmotors/vehicles?action=view_vehicle&invId={$vehicle['invId']}'><img src='/phpmotors/images/vehicles/$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
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

    function buildInvItemDisplay($invInfo){
        $dv = "<div id='inv-detail-box'>";
        $dv .= "<div id='inv-fieldset-div'>";
        $dv .= "<fieldset id='inv-fieldset'><legend>Vehicle Information</legend>";
        $lbltype = "text";
        $pattern = "";
        $DescriptionKey = "";
        $DescriptionValue = "";
        $ImageKey = "";
        $ImageValue = "";
        $invMake = "";
        $invModel = "";
        foreach($invInfo as $key => $value) {
            if ($key != "invId" && $key != "classificationId" && $key != "invThumbnail"){
                $key_str = str_replace('inv', '', $key);
                switch($key_str){
                    case "Description":
                        $DescriptionKey = $key_str;
                        $DescriptionValue = $value;
                        continue 2;
                    case "Image":
                        $ImageKey = $key_str;
                        $ImageValue = $value;
                        continue 2;
                    case "Price":
                        $lbltype = "text";
                        $value = "$" . number_format($value, 0, ".", ",");
                        break;
                    case "Stock":
                        $lbltype = "number";
                        break;
                    case "Make":
                        $invMake = $value;
                        break;
                    case "Model":
                        $invModel = $value;
                        break;
                }
                $dv .= "<label class='top' for=$key_str>$key_str</label><input type=$lbltype name='invMake' id=$key_str value=$value disabled><br>";
                $lbltype = "text";
                $pattern = "";
            }
        }
        $dv .= "<label class='top' for=$DescriptionKey>$DescriptionKey</label><textarea name='invDescription' id=$DescriptionKey rows='4' cols='50' disabled>$DescriptionValue</textarea><br>";
        $dv .= "</fieldset></div>";
        $imageString = "<img id='inv-img' src='/phpmotors/images/vehicles/$ImageValue' alt='Image of $invMake $invModel on phpmotors.com'>";
        $dv .= "<div id='inv-img-div'>$imageString</div>";
        $dv .= "</div>";
        return $dv;
    }
?>