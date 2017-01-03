<?php
require_once('dbconfig.php');
	global $connection;
	$query = "select vendor.id AS vendorid, vendor.name, vendor.ccdc, vendor.ccdctax, vendor.paytm, location.id AS locationid, location.area, location.street from vendor 
				join vendorlocationmap vlm on vlm.vendorid = vendor.id
				join  location on location.id = vlm.locationid";
	$result = mysqli_query($connection, $query);
?>