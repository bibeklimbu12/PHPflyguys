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
if(isset($_POST['add_flight'])){
	$departure_location=validate($_POST['departure_location']);
	$destination=validate($_POST['destination']);
	$duration=validate($_POST['duration']);
	$departure_time=validate($_POST['departure_time']);
	$type=$_POST['type'];
	
	if(empty($_POST['days'])){
		echo "<script>alert('Select atleast one day')</script>";
	}else{
		$insert=$db->query("INSERT INTO flight (departure_location,destination,duration,departuretime,type) VALUES ('$departure_location','$destination','$duration','$departure_time','$type')");
		if($insert==true){
			$flightID=fetchValue("SELECT flightID FROM flight ORDER BY flightID DESC limit 1","flightID");
			foreach($_POST['days'] as $day){
				$saveDay=$db->query("INSERT INTO flight_days (flightID,day) VALUES ('$flightID','$day')");
			}
			echo "<script>alert('Flight saved')</script>";
			echo "<script>window.open('view_flights.php','_self')</script>";
		}else{
			echo mysqli_error($db);
		}
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
				<option value="domestic">Domestic</option>
				<option value="europe">Europe</option>
			</select>
			</li>			
			<li>
			<input type="text" name="departure_location" required class="field-style field-full align-none" placeholder="Departure Location" />
			</li>
			<li>
			<input type="text" name="destination" required class="field-style field-full align-none" placeholder="Destination" />
			</li>
			<li>
			<input type="number" name="duration" required class="field-style field-full align-none" placeholder="Duration in minutes" />
			</li>
			<li>
			<input type="text" name="departure_time" required class="field-style field-full align-none" placeholder="Departure time" />
			</li>
			<li>
				<fieldset>
				<legend>Days</legend>
					<input type="checkbox" name="days[]" value="monday"/>Monday</br>
					<input type="checkbox" name="days[]" value="tuesday"/>Tuesday</br>
					<input type="checkbox" name="days[]" value="wednesday"/>Wednesday</br>
					<input type="checkbox" name="days[]" value="thursday"/>Thursday</br>
					<input type="checkbox" name="days[]" value="friday"/>Friday</br>
					<input type="checkbox" name="days[]" value="saturday"/>Saturday</br>
					<input type="checkbox" name="days[]" value="sunday"/>Sunday</br>
				</fieldset>
			</li>
			
			<li>
			<button type="submit" name="add_flight">Add Flight</button>
			</li>
			</ul>
			</form>
		</div>
    </div>
</body>
</html>
