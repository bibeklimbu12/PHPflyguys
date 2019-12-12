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
			<table class="table">
				<tr>
					<th>#</th>
					<th>Type</th>
					<th>Departure Location</th>
					<th>Destination</th>
					<th>Departure time</th>
					<th>Duration (Minutes)</th>
					<th>Update</th>
					<th>Delete</th>
				</tr>
				<?php
					$getFlights=$db->query("SELECT * FROM flight");
					while($rows=mysqli_fetch_array($getFlights)){
						$flightID=$rows[0];
						$departureLocation=$rows[1];
						$destination=$rows[2];
						$duration=$rows[3];
						$departureTime=$rows[4];
						$type=$rows[5];
				?>
				<tr>
					<td><?php echo $flightID; ?></td>
					<td><?php echo $type; ?></td>
					<td><?php echo $departureLocation; ?></td>
					<td><?php echo $destination; ?></td>
					<td><?php echo $departureTime; ?></td>
					<td><?php echo $duration." Minutes"; ?></td>
					<td><a href="edit_flight.php?flightID=<?php echo $flightID; ?>" onclick="return confirm('Are you sure you want to update this flight')">Update</a></td>
					<td><a href="delete_flight.php?flightID=<?php echo $flightID; ?>" onclick="return confirm('Are you sure you want to delete this flight')">Delete</a></td>
				</tr>
					<?php } ?>
			</table>
		</div>
    </div>
</body>
</html>
