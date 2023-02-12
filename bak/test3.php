<?php 
    session_start(); 


    // Get the accounts and vehicles models
    require_once 'model/accounts-model.php';
    require_once 'model/vehicles-model.php';

    $query_string_get = filter_input(INPUT_GET, "action", FILTER_DEFAULT);
    $query_string_post = filter_input(INPUT_POST, "action", FILTER_DEFAULT);
    if ($query_string_get == '' and $query_string_post == '') 
    { 
        $main_content = 'home';
    }
    else
    { 
        if ($query_string_get != '') { 
            $main_content = $query_string_get;    
        } 
        else 
        {
            $main_content = $query_string_post;
        }
        $classId = array_search($main_content, array_map('strtolower', array_column($classifications, 'classificationName')));
        if($classId != '')        
        {
            $classificationId = $classifications[$classId]['classificationId'];
            $vehicle_class = $main_content;
            $main_content = 'vehicle_list';
        }
    }
    $message_string = filter_input(INPUT_GET, "message", FILTER_DEFAULT);
    if ($message_string != '') {
        echo $message_string;
    }
?>

<?php 
function getVehiclesFromClass($classId){
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect(); 
    // The SQL statement to be used with the database 
    $sql = 'SELECT * FROM inventory i WHERE classificationId = :classId'; 

    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':classId', $classId, PDO::PARAM_STR);
    // The next line runs the prepared statement 
    $stmt->execute(); 

    // The next line gets the data from the database and 
    // stores it as an array in the $classifications variable 
    $vehicles = $stmt->fetchAll(); 
    // The next line closes the interaction with the database 
    $stmt->closeCursor(); 
    // The next line sends the array of data back to where the function 
    // was called (this should be the controller) 
    return $vehicles;
   }
   

?>