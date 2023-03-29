<!-- Account PHP Motors Model -->
<?php
    if(!isset($_SESSION))
    {
        session_start();
    }

    function addVehicle($invMake, $invModel, $invDescription, $invPrice, $invColor, $classificationId){
        // This function adds a vehicle to the database
        // Create a connection object using the phpmotors connection function
        $invImage = '/images/vehicles/no-image.png';
        $invThumbnail = '/images/vehicles/no-image.png';
        $db = phpConnect();
        $rowsChanged = 0;
        // The SQL statement
        $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invColor, classificationId)
                VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invColor, :classificationId)';
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
        // $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
        $rowsChanged = $stmt->execute();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function updateVehicle($invId, $invMake, $invModel, $invDescription, $invPrice, $invColor, $classificationId){
        // This function updates a vehicle to the database
        // Create a connection object using the phpmotors connection function
        $db = phpConnect();
        $rowsChanged = 0;
        // The SQL statement
        $sql = 'UPDATE  inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription,
                        invPrice = :invPrice, invColor = :invColor,
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
        // $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        // $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        // $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
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
        $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
       }

    // Get vehicles by classificationId
    function getInventoryByClassification($classificationId){
        // This funtion returns an array of vehicles based on the classificationId for the list
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
        # this function returns a list of vehicles in a certain category for the classification page view
        $db = phpConnect();
        // $sql = 'SELECT * FROM inventory 
        //         WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';

        // $sql = "SELECT inv.*,
        //             MAX(CASE WHEN img.imgPath LIKE '%-tn.%' THEN img.imgPath END) AS imgTnPath,
        //             MAX(CASE WHEN img.imgPath NOT LIKE '%-tn.%' THEN img.imgPath END) AS imgFullPath
        //         FROM inventory as inv
        //         LEFT JOIN ( SELECT *, ROW_NUMBER() OVER(PARTITION BY invId ORDER BY imgId) AS imgIndex
        //                     FROM images WHERE imgPrimary = 1)
        //         AS img ON inv.invId = img.invId
        //         WHERE inv.classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)
        //         GROUP BY inv.invId";

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
        // This funtion returns an array of a specific vehicle based on the invId, for the detail view
        $db = phpConnect();
        // $sql = "SELECT * FROM inventory WHERE invId = :invId";
        // $sql = "SELECT inv.*, i.imgPath, i.imgPrimary FROM inventory AS inv
        //         LEFT JOIN images AS i ON inv.invId = i.InvId AND i.imgPrimary = 1
        //         WHERE inv.invId = :invId AND i.imgPath NOT LIKE '%-tn.%'";

        $sql = "SELECT inv.*, i.imgPath FROM inventory AS inv
        LEFT JOIN images AS i ON inv.invId = i.InvId
        WHERE inv.invId = :invId AND i.imgPath NOT LIKE '%-tn.%'";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
        $stmt->execute();
        $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() == 0) {
            $sql = "SELECT inv.* FROM inventory AS inv
                    WHERE inv.invId = :invId";

            $stmt = $db->prepare($sql);
            $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
            $stmt->execute();
            $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
            $invInfo["imgPath"] = '/phpmotors/images/vehicles/no-image.png';
            // $invInfo["imgPrimary"] = 1;
        }
        $stmt->closeCursor();
        return $invInfo;
    }

   function getInvItemImages($invId){
    // This function returns an array of thumbnail images for the detail view for a specific vehicle
    $db = phpConnect();
    // $sql = "SELECT imgId, imgPath, imgName FROM images
    //         WHERE invId = :invId AND imgPath LIKE '%-tn.%' ORDER BY imgPrimary DESC";

    $sql = "SELECT imgId, imgPath, imgName FROM images
    WHERE invId = :invId AND imgPath LIKE '%-tn.%'";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->execute();
    $invImages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() == 0) {
        $invImages = array(
            array(
                "imgId" => 1,
                "imgPath" => "/phpmotors/images/vehicles/no-image.png",
                "imgName" => "no-image.jpg"
            )
        );
    }
    $stmt->closeCursor();
    return $invImages;
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

