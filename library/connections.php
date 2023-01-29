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

    // phConnect();

?>

<!-- 
In the code above you will see an arrow symbol (e.g. =>) and a double colon (e.g. PDO::ATTR_ERRMODE). You may ask, "What do those mean?"

The arrow symbol - =>
The arrow is a means of assigning a "key" to a "value" within an array. If you look at the entire line, 

Double Colon - ::
The double colon in this code is a way in Object Oriented Programming to directly access a method within the class.-->

