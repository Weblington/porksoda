<!DOCTYPE html>
<html>
<head>
<title>Weather</title>
</head>
<body id = "background">

<link rel="stylesheet" href="main.css">

<style> 

	#rcorners {
  background-color: #5C7F95;
  border-radius: 25px;
  border: 8px solid #315165;
  padding: 20px;
  width: 380px;
  margin: auto;
  
}
</style>


<?php

    CONST URL_BASE_OPENWEATHERMAP = 'https://api.openweathermap.org/data/2.5/onecall';
	CONST API_KEY_OPENWEATHERMAP = '2e877f76713455f606228217dd194270';

	$degrees;
	$speed;


	$units = $_POST['unit'];

	switch($units){
		case 'Imperial':
			$degrees = '°F';
			$speed = 'mph';
			break;
		case 'Metric':
			$degrees = '°C';
			$speed = 'kmph';
			break;
		default:
		include 'incorrect.php';
		return;
}

	
function makeWeatherAPICall($lat, $lon, $unit)
	{
		$data = http_build_query([
			'lat' => $lat,
			'lon' => $lon,
			'appid' => API_KEY_OPENWEATHERMAP,
			'units' => $unit
			
		]);
		$url = URL_BASE_OPENWEATHERMAP . "?{$data}";
		//echo "Calling {$url}\r\n";

		$request = curl_init();
		curl_setopt($request, CURLOPT_URL, $url);
		curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec($request);
		curl_close($request);

		return json_decode($response, true);
	}

$weatherData = makeWeatherAPICall((float)$_POST['lat'], (float)$_POST['lon'], htmlspecialchars($_POST['unit']));
?>

<?php

$jsondirection = $weatherData['hourly']['0']['wind_deg'];
$direction;

switch(true){
	case $jsondirection <= 45 && $jsondirection >= 0:
		$direction = 'North';
		break;
	case $jsondirection <= 90 && $jsondirection >= 45:
		$direction = 'Northeast';
		break;
	case $jsondirection <= 135 && $jsondirection >= 90:
		$direction = 'East';
		break;
	case $jsondirection <= 180 && $jsondirection >= 135:
		$direction = 'Southeast';
		break;
	case $jsondirection <= 225 && $jsondirection >= 180:
		$direction = 'South';
		break;
	case $jsondirection <= 270 && $jsondirection >= 225:
		$direction = 'Southwest';
		break;
	case $jsondirection <= 315 && $jsondirection >= 270:
		$direction = 'West';
		break;
	case $jsondirection <= 360 && $jsondirection >= 315:
		$direction = 'Northwest';
		break;
	default:
	echo "Error with wind direction!!";
}
?>




<div id ="rcorners">
<p style = "font-size: 28px">
<?php
echo "Real Temperature: <b> {$weatherData['hourly']['0']['temp']} $degrees </b> \r\n";
?>
</p>

<hr style = "opacity: 0">

<p style = "font-size: 28px">
    <?php
    echo "Feels Like: <b> {$weatherData['hourly']['0']['feels_like']} $degrees </b> \r\n";
    ?>
</p>

<hr style = "opacity: 0">

<p style = "font-size: 28px">
    <?php
    echo "Current Conditions:<b> {$weatherData['hourly']['0']['weather']['0']['main']} </b> \r\n";
    ?>
</p>

<hr style = "opacity: 0">

<p style = "font-size: 28px">
    <?php
    echo "Current Precipitation:<b> {$weatherData['minutely']['0']['precipitation']}% </b> \r\n";
    ?>
</p>

<hr style = "opacity: 0">

<p style = "font-size: 28px">
    <?php
    echo "Next Hour Precipitation:<b> {$weatherData['minutely']['60']['precipitation']}% </b> \r\n";
    ?>
</p>

<hr style = "opacity: 0">

<p style = "font-size: 28px">
    <?php
    echo "Humidity: <b> {$weatherData['hourly']['0']['humidity']}% </b> \r\n";
    ?>
</p>

<hr style = "opacity: 0">

<p style = "font-size: 28px">
    <?php
    echo "Wind Speed: <b> {$weatherData['hourly']['0']['wind_speed']} $speed </b> \r\n";
    ?>
</p>

<hr style = "opacity: 0">

<p style = "font-size: 28px">
    <?php
    echo "Wind Direction: <b> {$weatherData['hourly']['0']['wind_deg']}° $direction </b> \r\n";
    ?>
</p>

<hr style = "opacity: 0">

<p style = "font-size: 28px">
    <?php
    echo "Dew Point: <b> {$weatherData['hourly']['0']['dew_point']} $degrees </b> \r\n";
    ?>
</p>

<hr style = "opacity: 0">

<p style = "font-size: 28px">
    <?php
    echo "UV Index Level <b> {$weatherData['hourly']['0']['uvi']} </b> \r\n";
    ?>
</p>

<hr style = "opacity: 0">

<hr style = "opacity: 0">


<form action="index.php" method="post">
<p><input type="submit" value="Return" style="height:50px; width:75px"/></p>
</form>

</div>
</body>
</html>
