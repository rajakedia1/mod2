<!-- PHP Connection -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hackfest";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


// Query to SELECT alll the locations
$sql = "SELECT * FROM parking";
$result = $conn->query($sql);

?>


<!doctype html>
<html>

<head>
<title>ABC</title>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyDtyd0-jWHuEPyxtCsVGJkU5PQSXGrYS6I" 
          type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/navbar.css">
<style type="text/css">
		body { font-family: Helvetica, sans-serif; }
		h2, h3 { margin-top:0; }
		form { margin-top: 15px; }
		form > input { margin-right: 15px; }
		#results { float:right; margin:20px; padding:20px; border:1px solid; background:#ccc; }
	</style>
</head>

<body onload="getLocation()">

      <div class="navbar">
        <div class="nav-element" style="color:#fff;float:left;">PBee</div>        
        <div class="nav-element" style="color:#fff;float:right;">Contribute</div>
        <div class="nav-element" style="color:#fff;float:right;">About</i></div>
        <div class="nav-element" style="color:#fff;float:right;">Home</div>
        
    </div>
    <h2 style="text-align:center;font-family:arial;margin:50px;">Your Nearest Parking Location is: <i>Penman Auditorium</i></h2>
    <div class="gpsButton" ><a href="parking.php" style="text-decoration:none;color:white;">Park my Car!</a>
    
    </div>
    <div id="loc" style="display:none;"></div>

<div id="map" style=" height: 400px;"></div>

<script>
	// function getLocation(){
	// 	var x = [ <?php 
	// 	if ($result->num_rows > 0) {
 //   		// output data of each row
 //    	while($row = $result->fetch_assoc()) {
	// 	    	echo '[';
	// 	    	echo $row["id"] . ',';
	// 	    	echo $row["latitude"] . ',';
	// 	    	echo $row["longitude"] . ',';
	// 	    	echo $row["array"] . ',';
	// 	    	echo $row["address"] . '';
	// 	    	echo '],';
	// 	    }
	// 	}else {
	// 		alert("No Locations !!!");
	// 	}
 //        ?> ];
	// 	return x;
	// }

	

	// var locations = getLocation();

	// console.log(locations);

	var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 17,
      center: new google.maps.LatLng(23.81, 86.44),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    //var infowindow = new google.maps.InfoWindow();

    var marker, i;

    // for (i = 0; i < locations.length; i++) {  
    // 	console.log(locations[i][1]+" "+locations[i][2]);
    //   marker = new google.maps.Marker({
    //     position: new google.maps.LatLng(locations[i][1], locations[i][2]),
    //     map: map
    //   });

      <?php  
      	if ($result->num_rows > 0) {
   		// output data of each row
    	while($row = $result->fetch_assoc()) {
    		?> 
    		marker = new google.maps.Marker({
    			position: new google.maps.LatLng(<?php echo $row["latitude"]; ?>,<?php echo $row["longitude"]; ?>),
    			map: map,
    			label: {
 					   color: 'black',
    					fontWeight: 'bold',
    					text: '<?php echo $row["address"];?>'
  						}
    		});
    	<?php 
    		}
    	}
    	?>

     // google.maps.event.addListener(marker, 'click', (function(marker, i) {
      //  return function() {
       //   infowindow.setContent(locations[i][0]);
        //  infowindow.open(map, marker);
       // }
      //})(marker, i));
    

	
</script>
<script >
var x = document.getElementById("loc");
var x1=0,x2=0;

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
        marker = new google.maps.Marker({
                position: new google.maps.LatLng(x1,x2),
                map: map,
                label: {
                       color: 'black',
                        fontWeight: 'bold',
                        text: 'Penman Auditorium'
                        }
            });
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x1 = position.coords.latitude;
    x2 = position.coords.longitude;
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
    console.log("Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude);
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
    }
}
</script>


</body>
</html>




