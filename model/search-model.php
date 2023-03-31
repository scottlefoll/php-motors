<?php
    /* **********************************
    * Search Model
    ********************************** */

    function getSearchResults($search){
        $db = phpConnect();
        $sql = "SELECT * FROM inventory AS i
                LEFT JOIN images AS img
                ON i.invId = img.invId
                WHERE img.imgName LIKE '%-tn.%'
                AND (i.invId
                LIKE '";
        $sql .= $search;
        $sql .= "' OR i.invYear LIKE '";
        $sql .= $search;
        $sql .= "' OR i.invMake LIKE '";
        $sql .= $search;
        $sql .= "' OR i.invModel LIKE '";
        $sql .= $search;
        $sql .= "' OR i.invDescription LIKE '";
        $sql .= $search;
        $sql .= "' OR i.invPrice LIKE '";
        $sql .= $search;
        $sql .= "' OR i.invMiles LIKE '";
        $sql .= $search;
        $sql .= "' OR i.invColor LIKE '";
        $sql .= $search . "')";

        $stmt = $db->prepare($sql);
        // echo "<pre>";
        //     print_r($sql);
        // echo "</pre>";
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function paginate($search, $page, $displayLimit) {
        // THIS FUNCTION DOES THE SAME AS ABOVE EXCEPT IT USES THE $page and
        // $displayLimit TO CONSTRAIN THE RESULTS
        // (e.g. if I'm on page 2, I should only see results 11 through 20)
        $db = phpConnect();
        $start = ($page - 1) * $displayLimit;

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else if (!isset($page) || $page < 1) {
            $page = 1;
        }

        $sql = "SELECT * FROM inventory AS i
                LEFT JOIN images AS img
                ON i.invId = img.invId
                WHERE img.imgName LIKE '%-tn.%'
                AND (i.invId
                LIKE '$search'
                OR i.invYear LIKE '$search'
                OR i.invMake LIKE '$search'
                OR i.invModel LIKE '$search'
                OR i.invDescription LIKE '$search'
                OR i.invPrice LIKE '$search'
                OR i.invMiles LIKE '$search'
                OR i.invColor LIKE '$search')
                ORDER BY i.invYear ASC, i.invMake ASC, i.invModel ASC
                LIMIT $start, $displayLimit";

        $stmt = $db->prepare($sql);
        // echo "<pre>";
        //     print_r($sql);
        // echo "</pre>";
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

?>