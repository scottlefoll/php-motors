<!-- Account PHP Motors Model -->
<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    function regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword){
        // Create a connection object using the phpmotors connection function
        $db = phConnect();
        $rowsChanged = 0;
        // The SQL statement
        $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
            VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);

        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
        $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        $stmt->bindValue(':clientPassword', $hashedPassword, PDO::PARAM_STR);
        $rowsChanged = $stmt->execute();
        $stmt->closeCursor();
        return $rowsChanged;
    }


    function checkExistingEmail($clientEmail){
        // Create a connection object using the phpmotors connection function
        $db = phConnect();
        $rowsChanged = 0;
        // The SQL statement
        $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :clientEmail';
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $stmt->rowCount();
        $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
        // echo "<script>alert('Accounts Model: rowsChanged = $rowsChanged');</script>";
        $stmt->closeCursor();
        # check if email exists
        if (empty($matchEmail)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

   function getClient($clientEmail){
        // Create a connection object using the phpmotors connection function
        $db = phConnect();
        // The SQL statement
        $sql = 'SELECT * FROM clients WHERE clientEmail = :clientEmail';
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        // Insert the data
        $stmt->execute();
        // echo "<script>alert('Accounts Model: rowsChanged = $rowsChanged');</script>";
        $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $clientData;
   }