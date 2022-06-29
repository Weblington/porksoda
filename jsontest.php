


<?php
	CONST URL_BASE_OPENWEATHERMAP = 'https://api.openweathermap.org/data/2.5/onecall';
	CONST API_KEY_OPENWEATHERMAP = '2e877f76713455f606228217dd194270';

	function makeWeatherAPICall($lat, $lon)
	{
		$data = http_build_query([
			'lat' => $lat,
			'lon' => $lon,
			'appid' => API_KEY_OPENWEATHERMAP,
			'units' => 'imperial'
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


$weatherData = makeWeatherAPICall('40.110190', '-78.503990');







//echo "Real temperature: {$weatherData['hourly']['0']['temp']} F \r\n";
//echo "Feels like: {$weatherData['hourly']['0']['feels_like']} F \r\n";
//echo "Humidity: {$weatherData['hourly']['0']['humidity']}% \r\n";
//echo "Wind Speed: {$weatherData['hourly']['0']['wind_speed']} mph \r\n";
//echo "Dew Point: {$weatherData['hourly']['0']['dew_point']} F \r\n";
//echo "UV Index Level {$weatherData['hourly']['0']['uvi']} \r\n";




	die(var_dump(makeWeatherAPICall('40.110190', '-78.503990')));