<?php
session_start();
include 'config/config.php';
include 'includes/functions/methods.php';
include 'includes/functions/validation.php';
if(isset($_POST['login'])){
	$username=validate($_POST['username']);
	$password=validate($_POST['password']);
	$countUser=fetchValue("SELECT COUNT(adminID) FROM admin WHERE username='$username'","COUNT(adminID)");
	$hashed_password=fetchValue("SELECT password FROM admin WHERE username='$username'","password");
	if($countUser==1 && decrypt($hashed_password)==$password){
		$admin_id=fetchValue("SELECT username FROM admin WHERE username='$username'","username");
		$_SESSION['login_admin']=$admin_id; // Initializing Session
		echo"<script>window.open('view_flights.php','_self')</script>"; // Redirecting To Other Page			
			
	}else{
		echo "<script>alert('Invalid login credentials')</script>";
		echo"<script>window.open('admin.php','_self')</script>"; // Redirecting To Other Page
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
			<input type="text" name="username" class="field-style field-full align-none" placeholder="Username" />
			</li>
			<li>
			<input type="password" name="password" class="field-style field-full align-none" placeholder="password" />
			</li>
			<li>
			<button type="submit" name="login">Login</button>
			</li>
			</ul>
			</form>
		</div>
    </div>
</body>
</html>
