function openSpinner(loader,fader){
	document.getElementById(loader).style.display = 'block';	
	document.getElementById(fader).style.display = 'block';	
}
function closeSpinner(loader,fader){
	document.getElementById(loader).style.display = 'none';
	document.getElementById(fader).style.display = 'none';		
}

function searchFlights(){
	openSpinner("fader","loader");
	var searchBy=document.getElementById('searchBy').value;
	var searchValue=document.getElementById('searchValue').value;
	if(searchBy=="" || searchValue==""){
		alert('Fill all the fields');
		closeSpinner("fader","loader");
	}else{
		var values=[];
		values.push(searchBy);
		values.push(searchValue);
			if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			}
			else {// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			//var values = [firstName,lastName];
			var myJsonString = JSON.stringify(values);
			xmlhttp.onreadystatechange = respond1;
			xmlhttp.open("POST", "search_flights.php", true);
			xmlhttp.send(myJsonString);
	}
}

function respond1() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('resultField').innerHTML = xmlhttp.responseText;
			closeSpinner("fader","loader");
        }
}

function createWishList(flightID){
	openSpinner("fader","loader");
		var values=[];
		values.push(flightID);
			if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			}
			else {// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			//var values = [firstName,lastName];
			var myJsonString = JSON.stringify(values);
			xmlhttp.onreadystatechange = respond2;
			xmlhttp.open("POST", "add_to_wishlist.php", true);
			xmlhttp.send(myJsonString);
	
}

function respond2() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert(xmlhttp.responseText);
			closeSpinner("fader","loader");
        }
}