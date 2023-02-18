<?php
    function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
    }

    function checkPrice($invPrice){
        $value = filter_var($invPrice, FILTER_VALIDATE_INT, array("options" => array("min_range"=>100, "max_range"=>2000000)));
        return $value;
        }

    function checkclassificationId($classificationId){
        $value = filter_var($classificationId, FILTER_VALIDATE_INT, array("options" => array("min_range"=>1, "max_range"=>99)));
        return $value;
        }

    function checkStock($invStock){
        $value = filter_var($invStock, FILTER_VALIDATE_INT, array("options" => array("min_range"=>1, "max_range"=>99)));
        return $value;
        }

    function checkImageFilename($ImageFilename){
        $pattern = '/^(?:[\w]\:|\\)(\\[a-z_\-\s0-9\.]+)+\.(gif|jpg|jpeg|png|gif|bmp){6, 50}$/';
        if (!preg_match($pattern, $ImageFilename));
            $ImageFilename ="";
        return $ImageFilename;
        }

    function checkName($Name, $num){
        $pattern = '/^[A-Za-z -,.]{1, $num}$/';
        if (!preg_match($pattern, $Name));
            $Name ="";
        return $Name;
        }

    function checkDescription($Description, $num){
        $pattern='/^[A-Za-z0-9_ ?!\@#$%&*<>,.";:+=]{1,255}$/';
        return preg_match($pattern, $Description);
        }
        
    // Check the password for a minimum of 8 characters,
    // at least one 1 capital letter, at least 1 number and
    // at least 1 special character
    function checkPassword($clientPassword){
        $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
        return preg_match($pattern, $clientPassword);
   }

?>


