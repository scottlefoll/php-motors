<!-- Account PHP Motors Model -->
<?php
    if(!isset($_SESSION))
    {
        session_start();
    }

    function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId){
        // This function adds a vehicle to the database
        // Create a connection object using the phpmotors connection function
        $db = phpConnect();
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
        $rowsChanged = $stmt->execute();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function updateVehicle($invId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId){
        // This function updates a vehicle to the database
        // Create a connection object using the phpmotors connection function
        $db = phpConnect();
        $rowsChanged = 0;
        // The SQL statement
        $sql = 'UPDATE  inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, 
                        invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor,
                        classificationId = :classificationId WHERE invId = :invId';

        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        // The next lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function deleteVehicle($invId) {
        // This function deletes a vehicle from the database
        $db = phpConnect();
        $sql = 'DELETE FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
       }

    // Get vehicles by classificationId
    function getInventoryByClassification($classificationId){
        // This funtion returns an array of vehicles based on the classificationId
        $db = phpConnect();
        // $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId';
        $sql = "SELECT inv.*,
                    MAX(CASE WHEN img.imgPath LIKE '%-tn.%' THEN img.imgPath END) AS imgTnPath,
                    MAX(CASE WHEN img.imgPath NOT LIKE '%-tn.%' THEN img.imgPath END) AS imgFullPath
                FROM inventory as inv 
                LEFT JOIN (
                    SELECT *, ROW_NUMBER() OVER(PARTITION BY invId ORDER BY imgId) AS imgIndex
                        FROM images) AS img ON inv.invId = img.invId 
                    WHERE inv.classificationId = 3
                GROUP BY inv.invId;";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
        $stmt->execute();
        $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $inventory;
    }

    function getVehiclesByClassification($classificationName){
        $db = phpConnect();
        // $sql = 'SELECT * FROM inventory 
        //         WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';

        $sql = "SELECT inv.*,
                    MAX(CASE WHEN img.imgPath LIKE '%-tn.%' THEN img.imgPath END) AS imgTnPath,
                    MAX(CASE WHEN img.imgPath NOT LIKE '%-tn.%' THEN img.imgPath END) AS imgFullPath
                FROM inventory as inv
                LEFT JOIN ( SELECT *, ROW_NUMBER() OVER(PARTITION BY invId ORDER BY imgId) AS imgIndex
                            FROM images)
                AS img ON inv.invId = img.invId
                WHERE inv.classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)
                GROUP BY inv.invId";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $vehicles;
    }

   // Get vehicle information by invId
    function getInvItemInfo($invId){
        // This funtion returns an array of a specific vehicle based on the invId
        $db = phpConnect();
        // $sql = 'SELECT * FROM inventory WHERE invId = :invId';

        $sql = "SELECT inv.*,
                    MAX(CASE WHEN img.imgPath LIKE '%-tn.%' THEN img.imgPath END) AS imgTnPath,
                    MAX(CASE WHEN img.imgPath NOT LIKE '%-tn.%' THEN img.imgPath END) AS imgFullPath
                FROM inventory as inv
                LEFT JOIN ( SELECT *, ROW_NUMBER() OVER(PARTITION BY invId ORDER BY imgId) AS imgIndex
                    FROM images)
                AS img ON inv.invId = img.invId
                WHERE inv.invId = :invId";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
    }

    function addClass($classificationName){
        // This funtion adds a classification to the database
        $db = phpConnect();
        $rowsChanged = 0;
        $sql = 'INSERT INTO carClassification (classificationName) VALUES (:classificationName)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        $rowsChanged = $stmt->execute();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function getVehicles($vehicle = ""){
        // This funtion returns a list of all vehicle classificationIds and names
        $db = phpConnect();
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

    function getImgVehicles(){
        // Get a information for all vehicles to build a select list
        $db = phpConnect();
        $sql = 'SELECT invId, invMake, invModel FROM inventory ORDER BY invMake, invModel ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
    }
?>

