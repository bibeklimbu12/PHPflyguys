<?php
require 'config/config.php';
require 'includes/functions/methods.php';
$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
$response = json_decode($str_json, true); // decoding received JSON to array
$searchBy=$response[0];
$searchValue=$response[1];
$search=$db->query("SELECT flight.* FROM flight inner join flight_days on flight.flightID=flight_days.flightID WHERE $searchBy='$searchValue' group by flight.flightID");
while($rows=mysqli_fetch_array($search)){
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
            echo "<div class='item'>
					<img src='assets/images/plane.gif' alt='plane' width='240px' />
					<p><span class='theme_text'>Type:</span>$type</p>
					<p><span class='theme_text'>Depart From:</span>$departureLocation</p>
					<p><span class='theme_text'>Destination:</span>$destination</p>
					<p><span class='theme_text'>Duration:</span>$duration Minutes</p>
					<p><span class='theme_text'>Depart at:</span>$departureTime</p>
					<p><span class='theme_text'>Days:</span>$days</p>
					<p><a href='book.php?flightID=$flightID class='smallButton'>Book</a> <button class='smallButton'  onclick='createWishList($flightID)'>add to wishlist</button></p>
				</div>";
}
?>