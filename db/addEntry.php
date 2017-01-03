<?php
require_once('dbconfig.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
	global $connection;
	$lastInsertedLocationId = 0;
	$lastInsertedVendorId = 0;
    $check = mysqli_query($connection, "select Id from location where Street='".$_POST['street']."' and area='".$_POST['area']."' and 
							city_village='".$_POST['cityVillage']."' and state='".$_POST['state']."'");
	if (!$check || (mysqli_num_rows($check) == 0)) { // if new user . Insert a new record	
	$query = "INSERT INTO location (country, state, city_village, area, street) VALUES ('India','".$_POST['state']."','".$_POST['cityVillage']."', '".$_POST['area']."', '".$_POST['street']."')";
	if(mysqli_query($connection, $query))	
	{
		$lastInsertedLocationId = mysqli_insert_id($connection);
	}else
	{
		echo "Error: Error Inserting record for location";
		exit;
	}
	}else
	{
		$result = mysqli_fetch_assoc($check);
		$lastInsertedLocationId = $result['Id'];
	}

	$check = mysqli_query($connection, "select Id from vendor where name='".$_POST["vendor"]."'");
	if (!$check || mysqli_num_rows($check) == 0) { // if new user . Insert a new record
	$query = "INSERT INTO vendor (name, cash, ccdc, ccdctax, paytm) VALUES ('".$_POST['vendor']."', 1, ".$_POST['ccdcValue'].", ".$_POST['ccdcTax'].", ".$_POST['paytmValue'].")";
	if(mysqli_query($connection, $query))
	{
		$lastInsertedVendorId = mysqli_insert_id($connection);
	}else	
	{
		echo "Error: Error Inserting record for vendor";
		exit;
	}
	}else
	{
		$query = "UPDATE vendor SET ccdc= ".$_POST['ccdcValue'].", ccdcTax= ".$_POST['ccdcTax'].", paytm= ".$_POST['paytmValue']." WHERE name= '".$_POST['vendor']."'";
		if(!mysqli_query($connection, $query))
		{
			echo "Error: Error Updating record for vendor";
			exit;
		}

		$result = mysqli_fetch_assoc($check);
		$lastInsertedVendorId = $result['Id'];
	}
	if($lastInsertedLocationId && $lastInsertedVendorId)
	{
		$check = mysqli_query($connection, "select * from vendorlocationmap where vendorid=".$lastInsertedVendorId. " and locationid=".$lastInsertedLocationId);
		if (!$check || (mysqli_num_rows($check) == 0)) 
		{
			$query = "INSERT INTO vendorlocationmap (vendorid, locationid) VALUES (".$lastInsertedVendorId.", ".$lastInsertedLocationId.")";
			if(!mysqli_query($connection, $query))
			{
				echo "Error: Error Inserting record for Vendor Location";
				exit;
			}
		}
	}
	header("location:..")
?>