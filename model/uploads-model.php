<?php

    // Add image information to the database table
    function storeImages($imgPath, $invId, $imgName) {
        $db = phpConnect();
        $sql = 'INSERT INTO images (invId, imgPath, imgName) VALUES (:invId, :imgPath, :imgName)';
        $stmt = $db->prepare($sql);
        // Store the full size image information
        $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
        $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
        $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
        // $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
        $stmt->execute();

        // Make and store the thumbnail image information
        // Change name in path
        $imgPath = makeThumbnailName($imgPath);
        // Change name in file name
        $imgName = makeThumbnailName($imgName);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
        $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
        $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
        // $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
        $stmt->execute();

        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }
    // Get Image Information from images table
    function getImages() {
        $db = phpConnect();
        $sql = 'SELECT imgId, imgPath, imgName, imgDate, inventory.invId, invMake, invModel FROM images JOIN inventory ON images.invId = inventory.invId';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $imageArray;
    }
    // Delete image information from the images table
    function deleteImage($imgId) {
        $db = phpConnect();
        $sql = 'DELETE FROM images WHERE imgId = :imgId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':imgId', $imgId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        return $result;
   }
// Check for an existing image
    function checkExistingImage($imgName){
        $db = phpConnect();
        $sql = "SELECT imgName FROM images WHERE imgName = :name";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $imgName, PDO::PARAM_STR);
        $stmt->execute();
        $imageMatch = $stmt->fetch();
        $stmt->closeCursor();
        return $imageMatch;
   }

   // Check for an existing image
//    function setImgPrimaryOff($invId){
//         // This function sets imgPrimary = 0 for all the images of a vehicle when a new set of primary images are uploaded
//         $db = phpConnect();
//         $rowsChanged = 0;
//         // The SQL statement
//         $sql = "UPDATE images SET imgPrimary = 0 WHERE invId = :id";
//         $stmt = $db->prepare($sql);
//         $stmt->bindValue(':id', $invId, PDO::PARAM_STR);
//         $stmt->execute();
//         $rowsChanged = $stmt->rowCount();
//         $stmt->closeCursor();
//         return;
//     }

    // function setPrimaryImage($invId, $imgName){
    //     // This function sets imgPrimary = 0 for all the images of a vehicle when a new set of primary images are uploaded
    //     //  call the function to set all the images to 0
    //     setImgPrimaryOff($invId);
    //     // Now turn on the new primary image
    //     $imgName2 = str_replace(".", '-tn.', $imgName);
    //     $db = phpConnect();
    //     $rowsChanged = 0;
    //     // The SQL statement
    //     $sql = "UPDATE images SET imgPrimary = 1 WHERE (imgName = :name OR imgName = :name2) AND invId = :id";
    //     $stmt = $db->prepare($sql);
    //     $stmt->bindValue(':name', $imgName, PDO::PARAM_STR);
    //     $stmt->bindValue(':name2', $imgName2, PDO::PARAM_STR);
    //     $stmt->bindValue(':id', $invId, PDO::PARAM_STR);
    //     $stmt->execute();
    //     $rowsChanged = $stmt->rowCount();
    //     $stmt->closeCursor();
    //     return;
    // }

?>