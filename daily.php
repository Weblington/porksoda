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
  width: 860px;
  margin: auto;
  text-align: center;
  
  
}

#rcorners2 {
  background-color: #5C7F95;
  border-radius: 25px;
  border: 8px solid #315165;
  padding: 20px;
  width: 400px;
  margin: auto;
  
}

table, th, td {
  border:1px solid black;
}

#bottomright {

background-color: #5C7F95;
border-radius: 25px;
border: 8px solid #315165;
padding: 5px;
width: 140px;
position: absolute;
bottom: 0;
right: 0;
text-align: center;

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

$timezone = $weatherData['timezone'];

date_default_timezone_set($timezone);
                        

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


<?php

$dayzero = strtotime("today");
$dayone = strtotime("+1 day");
$daytwo = strtotime("+2 days");
$daythree = strtotime("+3 days");
$dayfour = strtotime("+4 days");
$dayfive = strtotime("+5 days");
$daysix = strtotime("+6 days");
$dayseven = strtotime("+7 days");

?>

<div id="rcorners">

<table>
<tr>
    <th>Day</th>
    <th>Morning Temperature</th>
    <th>Evening Temperature</th>
    <th>Night Temperature</th>
	<th>Condition</th>
    <th>Humidity</th>
    <th>Wind Speed</th>
    <th>Dew Point</th>
    <th>UVI</th>
  </tr>

  <tr>
    <td style="text-align:center"><?php echo date("l", $dayzero)?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['daily']['0']['temp']['morn']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['0']['temp']['eve']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['0']['temp']['night']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['0']['weather']['0']['main']} </b> \r\n";
    ?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['0']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['0']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['daily']['0']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['0']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("l", $dayone)?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['daily']['1']['temp']['morn']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['1']['temp']['eve']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['1']['temp']['night']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['1']['weather']['0']['main']} </b> \r\n";
    ?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['1']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['1']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['daily']['1']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['1']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("l", $daytwo)?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['daily']['2']['temp']['morn']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['2']['temp']['eve']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['2']['temp']['night']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['2']['weather']['0']['main']} </b> \r\n";
    ?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['2']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['2']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['daily']['2']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['2']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("l", $daythree)?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['daily']['3']['temp']['morn']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['3']['temp']['eve']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['3']['temp']['night']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['3']['weather']['0']['main']} </b> \r\n";
    ?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['3']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['3']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['daily']['3']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['3']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("l", $dayfour)?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['daily']['4']['temp']['morn']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['4']['temp']['eve']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['4']['temp']['night']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['4']['weather']['0']['main']} </b> \r\n";
    ?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['4']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['4']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['daily']['4']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['4']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("l", $dayfive)?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['daily']['5']['temp']['morn']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['5']['temp']['eve']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['5']['temp']['night']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['5']['weather']['0']['main']} </b> \r\n";
    ?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['5']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['5']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['daily']['5']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['5']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("l", $daysix)?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['daily']['6']['temp']['morn']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['6']['temp']['eve']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['6']['temp']['night']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['6']['weather']['0']['main']} </b> \r\n";
    ?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['6']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['6']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['daily']['6']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['6']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("l", $dayseven)?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['daily']['7']['temp']['morn']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['7']['temp']['eve']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['7']['temp']['night']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['7']['weather']['0']['main']} </b> \r\n";
    ?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['7']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['7']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['daily']['7']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['daily']['7']['uvi']} </b> \r\n";
    ?></td>
  </tr>
</table>
</div>

<div id="bottomright">
<form action="index.php" method="post">
<p><input type="submit" value="Return" style="height:50px; width:120px"/></p>
</form>
</div>

</body>
</html>