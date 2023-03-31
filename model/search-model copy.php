<?php
  /* **********************************
   * Search Model
  ********************************** */


  function getSearchResults($search){
    // This function returns an array of vehicles matching the search parameters 
    $db = phpConnect();
    $invId = "";
    $sortSQL = "";

    print_r($search); 

    $sql = "SELECT inv.*, img.imgName, img.imgPath
            FROM inventory AS inv
            LEFT JOIN images AS img ON inv.invId = img.invId
            WHERE img.imgName LIKE '%-tn.%'";

    $bindings = array(':invId' => PDO::PARAM_STR);
    // loop through $search and for each key:value pair in the array
    // add to the $sql WHERE clause and add a PDO binding to the $bindings array

    foreach ($search as $key => $value) {
        if (!empty($value)) {
            switch ($key) {
                case 'invId':
                    $sql .= " AND inv.invId = :invId";
                    break;
                case 'invMinYear':
                    $sql .= " AND inv.invYear >= :invMinYear";
                    // $bindings[':invMinYear'] = PDO::PARAM_INT;
                    break;
                case 'invMaxYear':
                    $sql .= " AND inv.invYear <= :invMaxYear";
                    // $bindings[':invMaxYear'] = PDO::PARAM_INT;
                    break;
                case 'invMake':
                    $sql .= " AND inv.invMake = :invMake";
                    // $bindings[':invMake'] = PDO::PARAM_STR;
                    break;
                case 'invModel':
                    $sql .= " AND inv.invModel = :invModel";
                    // $bindings[':invModel'] = PDO::PARAM_STR;
                    break;
                case 'invDesc':
                    $sql .= " AND inv.invDescription LIKE :invDesc";
                    // $bindings[':invDesc'] = PDO::PARAM_STR;
                    break;
                case 'invMinPrice':
                    // $formatted_value = number_format($value, 2);
                    $sql .= " AND inv.invPrice >= :invMinPrice";
                    // $bindings[':invMinPrice'] = PDO::PARAM_STR;
                    // $bindings_values[':invMinPrice'] = $formatted_value;
                    break;
                case 'invMaxPrice':
                    // $formatted_value = number_format($value, 2);
                    $sql .= " AND inv.invPrice <= :invMaxPrice";
                    // $bindings[':invMaxPrice'] = PDO::PARAM_STR;
                    // $bindings_values[':invMaxPrice'] = $formatted_value;
                    break;
                case 'invMiles':
                    $sql .= " AND inv.invMiles <= :invMiles";
                    // $bindings[':invMiles'] = PDO::PARAM_INT;
                    break;
                case 'invColor':
                    $sql .= " AND inv.invColor = :invColor";
                    // $bindings[':invColor'] = PDO::PARAM_STR;
                    break;
                case 'classificationId':
                    $sql .= " AND inv.classificationId = :classificationId";
                    // $bindings[':classificationId'] = PDO::PARAM_INT;
                    break;
                case "sort-order":
                    $sortSQL = " ORDER BY inv." . $value;
                    // $bindings[':order_by'] = PDO::PARAM_STR;
                    break;
            }
        }
    }

    if ($sortSQL != "") {
        $sql .= $sortSQL;
    }

    $stmt = $db->prepare($sql);

    if (array_key_exists(':invId', $search)) {
        $stmt->bindValue(':invId', $search['invId'], PDO::PARAM_STR);
    }
    if (array_key_exists(':invMinYear', $search)) {
        $stmt->bindValue(':invMinYear', $search['invMinYear'], PDO::PARAM_INT);
    }
    if (array_key_exists(':invMaxYear', $search)) {
        $stmt->bindValue(':invMaxYear', $search['invMaxYear'], PDO::PARAM_INT);
    }
    if (array_key_exists(':invMake', $search)) {
        $stmt->bindValue(':invMake', $search['invMake'], PDO::PARAM_STR);
    }
    if (array_key_exists(':invModel', $search)) {
        $stmt->bindValue(':invModel', $search['invModel'], PDO::PARAM_STR);
    }
    if (array_key_exists(':invDesc', $search)) {
        $stmt->bindValue(':invDesc', $search['invDesc'], PDO::PARAM_STR);
    }
    if (array_key_exists(':invMinPrice', $search)) {
        $stmt->bindValue(':invMinPrice', number_format($search['invMinPrice'], 2), PDO::PARAM_STR);
    }
    if (array_key_exists(':invMaxPrice', $search)) {
        $stmt->bindValue(':invMaxPrice', number_format($search['invMaxPrice'], 2), PDO::PARAM_STR);
    }
    if (array_key_exists(':invMiles', $search)) {
        $stmt->bindValue(':invMiles', $search['invMiles'], PDO::PARAM_INT);
    }
    if (array_key_exists(':invColor', $search)) {
        $stmt->bindValue(':invColor', $search['invColor'], PDO::PARAM_STR);
    }
    if (array_key_exists(':classificationId', $search)) {
        $stmt->bindValue(':classificationId', $search['classificationId'], PDO::PARAM_INT);
    }


    $sql = $stmt->queryString;
    echo $sql; // Output: SELECT * FROM users WHERE id = 1
    echo "<br>";
    $stmt->debugDumpParams();
    // $stmt->execute();
    // echo $stmt->debugDumpParams();
    // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    try {
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error executing query: " . $e->getMessage() . "<br>";
        echo "SQL statement: " . $stmt->queryString . "<br>";
        echo "Parameter bindings: ";
        print_r($stmt->debugDumpParams());
        exit();
    }

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
    return $results;
}

  function paginate($search, $page, $displayLimit)
  {
    // THIS FUNCTION DOES THE SAME AS ABOVE EXCEPT IT USES THE $page and $displayLimit TO CONSTRAIN THE RESULTS (e.g. if I'm on page 2, I should only see results 11 through 20)
  }