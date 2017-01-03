<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'paymentoptioninfo');    // DB username
define('DB_PASSWORD', 'paymentoptioninfo');  // DB password
define('DB_DATABASE', 'paymentoptioninfo'); // DB name
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die( "Unable to connect");
$database = mysqli_select_db($connection, DB_DATABASE) or die( "Unable to select database");
?>