require 'path/connections.php';

function createConnection(){
 $server = 'dbServerName';
 $dbname= 'databaseName';
 $username = 'username';
 $password = 'thePassword';
 $dsn = 'mysql:host='.$server.';dbname='.$dbname;
 $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
 // Create the actual connection object and assign it to a variable
 try {
  $link = new PDO($dsn, $username, $password, $options);
  return $link;
 } catch(PDOException $e) {
  echo 'Sorry, the connection failed';
  exit;
 }
}

<!-- Checking for Errors
Whenever an interaction is taking place between the PHP and Database servers 
there is always the possibility of an error occurring. To do something with 
these possible errors and make them more user friendly (and hacker unfriendly) 
we "intercept" them. That is the reason for the Try - Catch syntax shown above. 
The connection piece in the try structure attempts to create the connection 
to the database server. If that fails, then the Catch structure captures 
the error and handles it.

If a connection error occurs we can then do something about it: show an 
error message (when we are testing and debugging such as in the example 
above), or do a redirect to a more generic notice (in an actual production 
situation). The example below shows an actual function set up to do 
everything described above. -->

function phpmotorsConnect(){
 $server = 'localhost';
 $dbname= 'phpmotors';
 $username = 'iClient';
 $password = 'thePassword'; 
 $dsn = "mysql:host=$server;dbname=$dbname";
 $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

 // Create the actual connection object and assign it to a variable
 try {
  $link = new PDO($dsn, $username, $password, $options);
  return $link;
 } catch(PDOException $e) {
  header('Location: /phpmotors/view/500.php');
  exit;
 }
}

<!-- Require_once Function
The connections.php shown (in the video) below would be the page 
where the connection code shown above would reside. The connections.php 
page itself, will be placed in a "library" folder, at the root of the 
phpmotors folder. -->

require_once 'path/connections.php';

<!-- Closing a connection -->

<?php
$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
// use the connection here
$sth = $dbh->query('SELECT * FROM foo');

// and now we're done; close it
$sth = null;
$dbh = null;
?>


<!-- Persistent connections -->

<!-- Many web applications will benefit from making persistent connections to 
database servers. Persistent connections are not closed at the end of the 
script, but are cached and re-used when another script requests a 
connection using the same credentials. The persistent connection cache 
allows you to avoid the overhead of establishing a new connection every 
time a script needs to talk to a database, resulting in a faster web 
application. 

Note:

If you wish to use persistent connections, you must set PDO::ATTR_PERSISTENT 
in the array of driver options passed to the PDO constructor-->


<?php
$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass, array(
    PDO::ATTR_PERSISTENT => true
));
?>
