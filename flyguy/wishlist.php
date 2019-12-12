<?php
session_start();
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['login_user']) || (trim($_SESSION['login_user']) == '')) {
    
	$session_id=null;
}else{
	$session_id=$_SESSION['login_user'];
}
include 'includes/functions/methods.php';
include 'includes/functions/validation.php';
include 'config/config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fly-Guy</title>
<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php require 'header.php';?>
    <div class="main">
	<p><h1>My Booked Flights</h1></p>
			<table class="table">
				<tr>
					<th>Type</th>
					<th>Departure Location</th>
					<th>Destination</th>
					<th>Departure time</th>
					<th>Duration (Minutes)</th>
					<th>book</th>
				</tr>
				<?php
					$getFlights=$db->query("SELECT flight.* FROM flight inner join wishlist on wishlist.flightID=flight.flightID WHERE wishlist.memberID='$session_id'");
					while($rows=mysqli_fetch_array($getFlights)){
						$flightID=$rows[0];
						$departureLocation=$rows[1];
						$destination=$rows[2];
						$duration=$rows[3];
						$departureTime=$rows[4];
						$type=$rows[5];
				?>
				<tr>
					<td><?php echo $type; ?></td>
					<td><?php echo $departureLocation; ?></td>
					<td><?php echo $destination; ?></td>
					<td><?php echo $departureTime; ?></td>
					<td><?php echo $duration." Minutes"; ?></td>
					<td><a href="book.php?flightID=<?php echo $flightID; ?>" class="smallButton">Book</a></td>
				</tr>
					<?php } ?>
			</table>
    </div>
	</div>
    <?php require 'footer.php';?>
</body>
</html>
