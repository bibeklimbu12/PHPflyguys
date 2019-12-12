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
<?php
if (isset($_GET['flightID'])){
	$flightID=$_GET['flightID'];
}
?>
<?php
if(isset($_POST['book_flight'])){
	$username=validate($_POST['username']);
	$email=validate($_POST['email']);
	$password=validate($_POST['password']);
	$insert=$db->query("INSERT INTO members (names,email,password) VALUES ('$username','$email','$password')");
	if($insert==true){
		$memberID=fetchValue("SELECT memberID FROM members ORDER BY memberID DESC limit 1","memberID");
		$saveFlight=$db->query("INSERT INTO bookings (memberID,flightID) VALUES ('$memberID','$flightID')");
		if($saveFlight==true){
			//mailing
			$to      = '$email';
			$subject = 'Flight Booking confirmation';
			$message2 = "$flightID booked successfully";
			$headers = 'From: k1548879@kingston.ac.uk ' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
			$_SESSION['login_user']=$memberID;
			echo "<script>alert('Booking saved successfully')</script>";
			echo "<script>window.open('flights.php','_self')</script>";
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
        <div class="content">
            	<p><h1>Making Booking</h1></p>
                <hr>
				<?php
					if($session_id==null){
				?>
				<form class="form-style-9" method="post" action="">
				<p><h2>Fill the form to complete booking</h2></p>
				<ul style="list-style-type:none">
				<li>
				<input type="text" name="username" class="field-style field-full align-none" placeholder="Username" />
				</li>
				<li>
				<input type="email" name="email" class="field-style field-full align-none" placeholder="email" />
				</li>				
				<li>
				<input type="password" name="password" class="field-style field-full align-none" placeholder="password" />
				</li>
				<li>
				<button type="submit" name="book_flight">Book Flight</button>
				</li>
				</ul>
				</form>	
					<?php 
					}else{
						$saveFlight=$db->query("INSERT INTO bookings (memberID,flightID) VALUES ('$session_id','$flightID')");
						if($saveFlight==true){
							$email=fetchValue("SELECT email FROM members WHERE memberID='$session_id'","email");
							$to      = '$email';
							$subject = 'Flight Booking confirmation';
							$message2 = "$flightID booked successfully";
							$headers = 'From: k1548879@kingston.ac.uk ' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();
							echo "<script>alert('Booking saved successfully')</script>";
							echo "<script>window.open('flights.php','_self')</script>";
						}
					}
					?>
			
        </div>
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>
