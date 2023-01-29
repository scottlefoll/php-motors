<?php

    /* Proxy connection to the phpmotors database */

<<<<<<< HEAD

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
            if (is_object($link)) {
                echo '';
            }
        } catch (PDOException $e) {
            header('Location: /phpmotors/home.php?page=500');
=======
    function phConnect()
    {
        $server = 'localhost';
        $dbname = 'phpmotors';
        $username = 'iClient';
        // to error out the connection and test the error page, change the password to something incorrect
        $password = '5[oPh9Fjt4kpfOHdZZZ'; 
        $dsn = "mysql:host=$server;dbname=$dbname";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        // Create the actual connection object and assign it to a variable
        try {
            $link = new PDO($dsn, $username, $password, $options);
            return $link;
        } catch (PDOException $e) {
            header('Location: /phpmotors/snippets/500_content.php');
>>>>>>> bb8d81e22b93458e733066709e615d8868b0a729
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

