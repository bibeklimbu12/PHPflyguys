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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fly Guy</title>
<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php
		require 'header.php';
	?>
    <div class="main">
    	<div class="banner">
        	<img src="assets/images/banner.jpg" height="300px" width="1000px" alt="BANNER"/>        
        </div>
        <div class="content_product">
        	<div class="info">
            	<p><h2>Our Flights</h2></p>
                <hr>
            </div>
            <div class="products">
			<?php
				$getFlights=$db->query("SELECT * FROM flight LIMIT 12");
				while($rows=mysqli_fetch_array($getFlights)){
				$flightID=$rows[0];
				$departureLocation=$rows[1];
				$destination=$rows[2];
				$duration=$rows[3];
				$departureTime=$rows[4];
				$type=$rows[5];
			?>
            	<div class="item">
					<img src="assets/images/plane.gif" alt="plane" width="240px" />
					<p><span class="theme_text">Type:</span> <?php echo $type; ?></p>
					<p><span class="theme_text">Depart From:</span> <?php echo $departureLocation; ?></p>
					<p><span class="theme_text">Destination:</span> <?php echo $destination; ?></p>
					<p><span class="theme_text">Duration:</span> <?php echo $duration." Minutes"; ?></p>
					<p><span class="theme_text">Depart at:</span> <?php echo $departureTime ?></p>
				</div>
				<?php } ?>
            </div>
				<a href="flights.php" class="theme">View More</a>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>
