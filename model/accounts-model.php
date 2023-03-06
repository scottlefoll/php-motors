<!-- Account PHP Motors Model -->
<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    function regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword){
        // Create a connection object using the phpmotors connection function
        $db = phpConnect();
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
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function updateAccount($clientId, $clientFirstname, $clientLastname, $clientEmail){
        // Create a connection object using the phpmotors connection function
        $db = phpConnect();
        $rowsChanged = 0;
        // The SQL statement
        $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail
            WHERE clientId = :clientId';

        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
        $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function updatePassword($clientId, $hashedPassword){
        // Create a connection object using the phpmotors connection function
        $db = phpConnect();
        $rowsChanged = 0;
        // The SQL statement
        $sql = 'UPDATE clients SET clientPassword = :hashedPassword
            WHERE clientId = :clientId';

        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function isExistingEmail($clientEmail){
        // Create a connection object using the phpmotors connection function
        $db = phpConnect();
        $rowsfound = 0;
        // The SQL statement
        $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :clientEmail';
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        if ($rowsChanged > 0) {
            return 1;
        } else {
            return 0;
        }
    }

   function getClient($clientEmail){
        // Create a connection object using the phpmotors connection function
        $db = phpConnect();
        // The SQL statement
        $sql = 'SELECT * FROM clients WHERE clientEmail = :clientEmail';
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
        // Insert the data
        $stmt->execute();
        $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $clientData;
   }

    function getClientById($clientId){
        // Create a connection object using the phpmotors connection function
        $db = phpConnect();
        // The SQL statement
        $sql = 'SELECT * FROM clients WHERE clientId = :clientId';
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
        // Insert the data
        $stmt->execute();
        // echo "<script>alert('Accounts Model: rowsChanged = $rowsChanged');</script>";
        $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $clientData;
    }