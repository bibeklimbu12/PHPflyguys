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
if(isset($_POST['register'])){
	$username=validate($_POST['username']);
	$email=validate($_POST['email']);
	$password=validate($_POST['password']);
	$insert=$db->query("INSERT INTO members (names,email,password) VALUES ('$username','$email','$password')");
	if($insert==true){
			$_SESSION['login_user']=$memberID;
			echo "<script>alert('Account created successfully')</script>";
			echo "<script>window.open('index.php','_self')</script>";
		
	}
}
?>
<?php
if(isset($_POST['register'])){
	$username=validate($_POST['username']);
	$password=validate($_POST['password']);
	$countUser=fetchValue("SELECT COUNT(memberID) FROM members WHERE username='$username'","COUNT(memberID)");
	$hashed_password=fetchValue("SELECT password FROM members WHERE username='$username'","password");
	if($countUser==1 && decrypt($hashed_password)==$password){
		$memberID=fetchValue("SELECT username FROM members WHERE username='$username'","username");
		$_SESSION['login_user']=$memberID; // Initializing Session
		echo"<script>window.open('index.php','_self')</script>"; // Redirecting To Other Page			
			
	}else{
		echo "<script>alert('Invalid login credentials')</script>";
		echo"<script>window.open('member_login.php','_self')</script>"; // Redirecting To Other Page
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
				<p><h1>Already have account...Login</h1></p>
                
				<form class="form-style-9" method="post" action="">
				<p><h2>Fill the form to login</h2></p>
				<ul style="list-style-type:none">
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
				<hr>				
            	<p><h1>Register</h1></p>
				<form class="form-style-9" method="post" action="">
				<p><h2>Fill the form to register</h2></p>
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
				<button type="submit" name="register">Register</button>
				</li>
				</ul>
				</form>	
				
			
        
    </div>
    <?php require 'footer.php'; ?>
</body>
</html>
