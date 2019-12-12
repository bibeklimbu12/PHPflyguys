<?php
require 'config/config.php';
if(isset($_GET['flightID'])){
	$flightID=$_GET['flightID'];
	$query=$db->query("DELETE FROM flight WHERE flightID='$flightID'");
	if($query==true){
		echo "<script>alert('You hav successfully removed the flight')</script>";
		echo "<script>window.open('view_flights.php','_self')</script>";
	}
}
?>