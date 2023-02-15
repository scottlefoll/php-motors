<!-- Account PHP Motors Model -->
<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId){
        // Create a connection object using the phpmotors connection function
        $db = phConnect();
        $rowsChanged = 0;
        // The SQL statement
        $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
                VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);

        try {
            // $stmt_str = print_r($stmt);
            // echo "<script>alert('Vehicle Model: addVehicle Execute: stmt = $stmt_str ')</script>";
            // Insert the data
            $addOutcome = $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }

        // Close the database interaction
        $stmt->closeCursor();
        return $addOutcome;
        exit;
    }

    function addClass($classificationName){
        // Create a connection object using the phpmotors connection function
        $db = phConnect();
        $rowsChanged = 0;

        // The SQL statement to be used with the database 
        $sql = 'SELECT classificationId, classificationName FROM carclassification ORDER BY classificationName ASC'; 

        // The SQL statement
        $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
            VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';

        // The SQL statement
        $sql = 'INSERT INTO carClassification (classificationName)
            VALUES (:classificationName)';
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);

        try {
            // $stmt_str = print_r($stmt);
            // echo "<script>alert('Vehicle Model: addVehicle Execute: stmt = $stmt_str ')</script>";
            // Insert the data
            $addOutcome = $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    
        // Close the database interaction
        $stmt->closeCursor();
        return $addOutcome;
        exit;
    }

    function getVehicles($vehicle = ""){
        // Create a connection object from the phpmotors connection function
        $db = phConnect(); 
        // The SQL statement to be used with the database 
        $sql = 'SELECT classificationId, classificationName FROM carclassification ORDER BY classificationName ASC'; 
        // The next line creates the prepared statement using the phpmotors connection      
        $stmt = $db->prepare($sql);
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

