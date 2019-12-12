<?php
require 'includes/functions/sanitize.php';
require 'includes/functions/methods.php';
require 'config/config.php';
?>
<?php
if (isset($_POST['loginbtn'])){
	$username=validate($_POST['username']);
	$password=validate($_POST['password']);
	$query="SELECT count(userID) FROM user WHERE username='$username' AND password='$password'";
	if (fetchValue($query,"count(userID)")==1){
		$session['user']=fetchValue("SELECT userid FROM user WHERE username='$username' AND password='$password'","userid");
		echo "<script>alert('session granted')</script>";
		echo "<script>window.open('my_music.php','_self')</script>";
	}else{
		echo "<script>alert('Invalid username or password')</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Fly Guy</title>
<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php
		require 'header.php';
	?>
    <div class="main">
        <div class="content_product">
        	<div class="info">
            	<p><h1>Our Flights 
				<form action="" method="post">
					<select id="searchBy" class="input2" required>
						<option value="">Search By...</option>
						<option value="type">type</option>
						<option value="departure_location">Departure Point</option>
						<option value="destination">Destination</option>
						<option value="day">Day of the week</option>
					</select>
					<input type="text" id="searchValue" class="input2" placeholder="search phrase" required>
					<input type="button" class="input2" value="Search" onclick="searchFlights()">
				</form>
				</p>
                <hr>
            </div>
            <div class="products" id="resultField">
			<?php
				$getFlights=$db->query("SELECT * FROM flight");
				while($rows=mysqli_fetch_array($getFlights)){
				$flightID=$rows[0];
				$departureLocation=$rows[1];
				$destination=$rows[2];
				$duration=$rows[3];
				$departureTime=$rows[4];
				$type=$rows[5];
				if(fetchValue("SELECT COUNT(flightID) FROM flight_days WHERE flightID='$flightID'","COUNT(flightID)")==7){
					$days="Daily";
				}else{
					$days=fetchValue("SELECT group_concat(day) FROM flight_days WHERE flightID='$flightID'","group_concat(day)");
				}
			?>
            	<div class="item">
					<img src="assets/images/plane.gif" alt="plane" width="240px" />
					<p><span class="theme_text">Type:</span> <?php echo $type; ?></p>
					<p><span class="theme_text">Depart From:</span> <?php echo $departureLocation; ?></p>
					<p><span class="theme_text">Destination:</span> <?php echo $destination; ?></p>
					<p><span class="theme_text">Duration:</span> <?php echo $duration." Minutes"; ?></p>
					<p><span class="theme_text">Depart at:</span> <?php echo $departureTime; ?></p>
					<p><span class="theme_text">Days:</span> <?php echo $days; ?></p>
					<p><a href="book.php?flightID=<?php echo $flightID; ?>" class="smallButton">Book</a> <button class="smallButton"  onclick="createWishList('<?php echo $flightID; ?>')">add to wishlist</button></p>
				</div>
				<?php } ?>
            </div>
				
        </div>
     </div>
    </div>
    <?php require 'footer.php'; ?>
	
	<div class="loaded" id="loader"><img src="assets/images/spinner.gif"></div>
	<div class="faded" id="fader"></div>
	
	<script src="assets/js/script.js"></script>
</body>
</html>
