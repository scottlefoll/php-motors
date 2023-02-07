<?php

    /* Proxy connection to the phpmotors database */


    function phConnect()
    {
        $server = 'localhost';
        $dbname = 'phpmotors';
        $username = 'iClient';
        // to error out the connection and test the error page, change the password to something incorrect
        $password = '5[oPh9Fjt4kpfOHd'; 
        $dsn = "mysql:host=$server;dbname=$dbname";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        // Create the actual connection object and assign it to a variable
        try {
            $link = new PDO($dsn, $username, $password, $options);
            return $link;
        } catch (PDOException $e) {
            header('Location: /phpmotors/view/500.php');
        exit;
        }
    }

?>


