<?php
session_start();
require_once('dbconfig.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
	global $connection;
	$query = "SELECT vendor.id AS vendorid, vendor.name, vendor.ccdc, vendor.ccdctax, vendor.paytm, location.id AS locationid, location.area AS locArea, location.street, 
			  location.state, location.city_village FROM vendor 
			  JOIN location ON location.id = ".$_POST['locid']." AND vendor.id = ".$_POST['vid'];
	$result = mysqli_query($connection, $query);
	echo json_encode(mysqli_fetch_assoc($result));
?>
