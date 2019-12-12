<?php
session_start();
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['login_admin']) || (trim($_SESSION['login_admin']) == '')) {
    header("location: admin.php");
    exit();
}
$session_id=$_SESSION['login_admin'];
include 'includes/functions/methods.php';
include 'includes/functions/validation.php';
include 'config/config.php';
?>
<?php
if(isset($_GET['flightID'])){
	$flightID=$_GET['flightID'];
}
?>
<?php
if(isset($_POST['save_flight'])){
	$departure_location=validate($_POST['departure_location']);
	$destination=validate($_POST['destination']);
	$duration=validate($_POST['duration']);
	$departure_time=validate($_POST['departure_time']);
	$type=$_POST['type'];
	
		$update=$db->query("UPDATE flight SET departure_location='$departure_location',destination='$destination',duration='$duration',departuretime='$departure_time',type='$type' WHERE flightID='$flightID'");
		if($update==true){
			echo "<script>alert('Flight saved')</script>";
			echo "<script>window.open('view_flights.php','_self')</script>";
		}else{
			echo mysqli_error($db);
		}

}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fly Guy Admin</title>
<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="assets/css/menu_styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php
		require 'header.php';
	?>
    <div class="main">
		<div class="left">
			  <div id="navigation">
			  <h2><?php echo "Welcome ".$session_id; ?></h2>
				<div id="menu">
				  <ul>
					<li><a href="admin.php">Login</a></li>
					<li><a href="view_flights.php">Flights</a></li>
					<li><a href="add_flight.php">Add Flight</a></li>
					<li><a href="view_bookings.php">View Bookings</a></li>
				  </ul>
				</div>
			  </div> 
		</div>
		<div class="mainContent">
			<form class="form-style-9" method="post" action="">
			<p><h2>Admin Login</h2></p>
			<ul>
			<li>
			<select name="type" class="field-style field-full align-none" required/>
				<option value="">Type...</option>
				<option value="domestic" <?php if(fetchValue("SELECT type FROM flight WHERE flightID='$flightID'","type")=="domestic"){echo "selected";} ?> >Domestic</option>
				<option value="europe" <?php if(fetchValue("SELECT type FROM flight WHERE flightID='$flightID'","type")=="europe"){echo "selected";} ?> >Europe</option>
			</select>
			</li>			
			<li>
			<input type="text" value="<?php echo fetchValue("SELECT departure_location FROM flight WHERE flightID='$flightID'","departure_location"); ?>" name="departure_location" required class="field-style field-full align-none" placeholder="Departure Location" />
			</li>
			<li>
			<input type="text" name="destination" value="<?php echo fetchValue("SELECT destination FROM flight WHERE flightID='$flightID'","destination"); ?>" required class="field-style field-full align-none" placeholder="Destination" />
			</li>
			<li>
			<input type="text" value="<?php echo fetchValue("SELECT duration FROM flight WHERE flightID='$flightID'","duration"); ?>" name="duration" required class="field-style field-full align-none" placeholder="Duration in minutes" />
			</li>
			<li>
			<input type="text" value="<?php echo fetchValue("SELECT departuretime FROM flight WHERE flightID='$flightID'","departuretime"); ?>" name="departure_time" required class="field-style field-full align-none" placeholder="Departure time" />
			</li>
			
			<li>
			<button type="submit" name="save_flight">Save Flight</button>
			</li>
			</ul>
			</form>
		</div>
    </div>
</body>
</html>
