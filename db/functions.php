<?php
require_once('dbconfig.php');
function checkuser($fuid,$ffname,$femail){
	global $connection;
    $check = mysqli_query($connection, "select * from user where fbId='$fuid'");
	if (mysqli_num_rows($check) == 0) { // if new user . Insert a new record	
	$query = "INSERT INTO user (fbId,Name,emailid) VALUES ('$fuid','$ffname','$femail')";
	mysqli_query($connection, $query);	
	} else {   // If Returned user . update the user record		
	$query = "UPDATE user SET Name='$ffname', emailid='$femail' where fbId='$fuid'";
	mysqli_query($connection, $query);
	}
}
?>
