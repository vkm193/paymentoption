<?php
session_start();
ini_set('display_errors', 0);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
<title>Know the payment options near by you</title>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap-theme.css">
<link rel="stylesheet" href="css/customStyle.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<script src="js/jquery.session.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfPn5VZ8plJcYlxAUaxDsCyh_KSDWUnZo&callback=initMap" type="text/javascript"></script>
<script src="js/customScript.js"></script>
<script src="js/geoLocation.js"></script>
<script src="js/bootstrap-add-clear.js"></script>
<script type="text/html" src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
<script src="js/jquery.clearsearch.js"></script>
</head>
<body style="background-image: linear-gradient( to right, rgba(255, 153, 51, 0.33), white , rgba(0, 128, 0, 0.45));">
<script>
var fbId = "<?php echo ($_SESSION['FBID'] ? $_SESSION['FBID'] : null); ?>";
</script>
<nav class="navbar navbar-inverse" style="border: 0px; border-radius: 0px;">
		<div class="container-fluid header-container-fluid" style="background-color: #428bca;">
		<p class="navbar-text navbar-right"> <a href="fbloginsdk/logout.php" class="navbar-link" style="color: white;">Logout</a></p>
			<?php if($_SESSION['FBID']){
				echo '<p class="navbar-text navbar-right"> <a href="fbloginsdk/logout.php" class="navbar-link" style="color: white;">>Logout</a></p>'; 
				}?>
			<p class="navbar-text navbar-right"> <a href="#" class="navbar-link no-decoration" style="color: white;">How can I serve?</a></p>
		</div>
	</nav>
<div class="container">
	
	<h1 class="heading-tagline"><a href="#" class="no-decoration">Payment options nearby!</a></h1>
	<hr/>
