<?php
session_start();
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['login_user']) || (trim($_SESSION['login_user']) == '')) {
    echo "Login to your account to create wishlist";
}else{
	$session_id=$_SESSION['login_user'];
	require 'config/config.php';
	require 'includes/functions/methods.php';
	$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
	$response = json_decode($str_json, true); // decoding received JSON to array
	$flightID=$response[0];
	$insert=$db->query("INSERT INTO wishlist (flightID,memberID) VALUES ('$flightID','$session_id')");
	if($insert==true){
		echo "Flight added to your wishlist";
	}
}
?>