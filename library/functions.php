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
        $pattern = "/([0-9a-zA-Z\._-]+.(png|PNG|gif|GIF|jp[e]?g|JP[E]?G))/";
        if (preg_match($pattern, $ImageFilename)){
            return $ImageFilename;
        } else {
            return "";
        }
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
            $navList .= "<li class='nav-li' ><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' 
                        title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
        }
        $navList .= '</ul>';
        return $navList;
    }
?>