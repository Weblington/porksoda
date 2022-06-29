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
  width: auto;
  margin: auto;
  
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

                        $hourzero = strtotime("now");
                        $hourone = strtotime("+1 Hours");
                        $hourtwo = strtotime("+2 Hours");
                        $hourthree = strtotime("+3 Hours");
                        $hourfour = strtotime("+4 Hour");;
                        $hourfive = strtotime("+5 Hours");
                        $hoursix = strtotime("+6 Hours");
                        $hourseven = strtotime("+7 Hours");
                        $houreight = strtotime("+8 Hours");
                        $hournine = strtotime("+9 Hours");
                        $hourten = strtotime("+10 Hours");
                        $houreleven = strtotime("+11 Hours");
                        $hourtwelve = strtotime("+12 Hours");
                        $hourthirteen = strtotime("+13 Hour");
                        $hourfourteen = strtotime("+14 Hours");
                        $hourfifteen = strtotime("+15 Hours");
                        $hoursixteen = strtotime("+16 Hours");;
                        $hourseventeen = strtotime("+17 Hours");
                        $houreighteen = strtotime("+18 Hours");
                        $hournineteen = strtotime("+19 Hours");
                        $hourtwenty = strtotime("+20 Hours");
                        $hourtwentyone = strtotime("+21 Hours");
                        $hourtwentytwo = strtotime("+22 Hours");
                        $hourtwentythree = strtotime("+23 Hours");
                        $hourtwentyfour = strtotime("+24 Hours");
                        

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



<div id="rcorners">

<table style="width:100%">
  <tr>
    <th>Time</th>
    <th>Temperature</th>
    <th>Feels Like</th>
	<th>Condition</th>
    <th>Humidity</th>
    <th>Wind Speed</th>
	<th>Wind Direction</th>
    <th>Dew Point</th>
    <th>UVI</th>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourzero)?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['0']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['0']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['0']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['0']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['0']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['0']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['0']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['0']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourone); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['1']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['1']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['1']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['1']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['1']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['1']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['1']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['1']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourtwo); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['2']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['2']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['2']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['2']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['2']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['2']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['2']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['2']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourthree); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['3']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['3']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['3']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['3']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['3']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['3']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['3']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['3']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourfour); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['4']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['4']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['4']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['4']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['4']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['4']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['4']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['4']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourfive); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['5']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['5']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['5']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['5']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['5']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['5']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['5']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['5']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hoursix); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['6']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['6']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['6']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['6']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['6']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['6']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['6']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['6']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourseven); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['7']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['7']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['7']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['7']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['7']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['7']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['7']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['7']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $houreight); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['8']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['8']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['8']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['8']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['8']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['8']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['8']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['8']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hournine); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['9']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['9']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['9']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['9']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['9']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['9']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['9']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['9']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourten); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['10']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['10']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['10']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['10']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['10']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['10']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['10']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['10']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $houreleven); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['11']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['11']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['11']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['11']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['11']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['11']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['11']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['11']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourtwelve); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['12']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['12']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['12']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['12']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['12']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['12']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['12']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['12']['uvi']} </b> \r\n";
    ?></td>
  </tr>
</table>
</div>

<hr style = "opacity: 0">

<div id="rcorners">
<table style="width:100%">
  <tr>
    <th>Time</th>
    <th>Temperature</th>
    <th>Feels Like</th>
	<th>Condition</th>
    <th>Humidity</th>
    <th>Wind Speed</th>
	<th>Wind Direction</th>
    <th>Dew Point</th>
    <th>UVI</th>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourtwelve); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['12']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['12']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['12']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['12']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['12']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['12']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['12']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['12']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourthirteen); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['13']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['13']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['13']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['13']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['13']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['13']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['13']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['13']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourfourteen); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['14']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['14']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['14']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['14']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['14']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['14']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['14']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['14']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourfifteen); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['15']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['15']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['15']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['15']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['15']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['15']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['15']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['15']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hoursixteen); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['16']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['16']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['16']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['16']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['16']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['16']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['16']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['16']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourseventeen); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['17']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['17']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['17']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['17']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['17']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['17']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['17']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['17']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $houreighteen); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['18']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['18']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['18']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['18']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['18']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['18']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['18']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['18']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hournineteen); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['19']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['19']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['19']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['19']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['19']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['19']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['19']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['19']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourtwenty); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['20']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['20']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['20']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['20']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['20']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['20']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['20']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['20']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourtwentyone); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['21']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['21']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['21']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['21']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['21']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['21']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['21']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['21']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourtwentytwo); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['22']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['22']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['22']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['22']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['22']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['22']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['22']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['22']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourtwentythree); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['23']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['23']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['23']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['23']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['23']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['23']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['23']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['23']['uvi']} </b> \r\n";
    ?></td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo date("h:ia", $hourtwentyfour); ?></td>
    <td style="text-align:center"><?php
echo "<b> {$weatherData['hourly']['24']['temp']} $degrees </b> \r\n";
?></td>
    <td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['24']['feels_like']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['24']['weather']['0']['main']} </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['24']['humidity']}% </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['24']['wind_speed']} $speed </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['24']['wind_deg']}° $direction </b> \r\n";
    ?></td>
	<td style="text-align:center"> <?php
    echo "<b> {$weatherData['hourly']['24']['dew_point']} $degrees </b> \r\n";
    ?></td>
	<td style="text-align:center"><?php
    echo "<b> {$weatherData['hourly']['24']['uvi']} </b> \r\n";
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

