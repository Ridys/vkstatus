<?php
# dev. Dmitry Ageykin
# GitHub: https://github.com/Ridys/vkstatus
require_once 'vk_config.php';
$min = 0; $temp = 0; $weather = 0;
while ($min++ <= 100000000) {
	if ($min >= 15) {
		# создание запроса на погоду
		$weather_params = array(
		'id' => $city_id,
		'appid' => $weather_key,
		'units' => 'metric'
		);
		$weather_get = http_build_query($weather_params);
		$result_weather = json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/weather?'. $weather_get), true);
        $temp = $result_weather["main"]["temp"];
        $weather = $result_weather["weather"]["0"]["main"];
        $min = 0;
	} else {
		echo "\nВ данный момент насчитано: \n $min минут";
	}

# преобразование погоды
$weather_list = array('Thunderstorm', 'Clouds', 'Drizzle', 'Rain', 'Snow', 'Clear', 'Extreme', 'Additional', 'Atmosphere', 'Fog');
$weather_gen = array('Сейчас гроза &#127785;', 'Сейчас облачно &#9729;', 'Сейчас изморось &#127783;', 'Сейчас дождь &#9748;', 'Сейчас снег &#127784;', 'Сейчас безоблачно &#9728;', 'Сейчас шторм &#127786;', 'Сейчас ветрено &#127787;', 'Сейчас туман &#127787;', 'Сейчас туман &#127787;');
$link_wea = str_replace($weather_list, $weather_gen, $weather);

# преобразование цифр даты
$date = date('H:i');
$numbers = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
$num_code = array('0\a', '1\b', '2\c', '3\d', '4\e', '5\f', '6\g', '7\h', '8\k', '9\n');
$sdate = str_replace($numbers, $num_code, $date);
# преобразование даты в смайлики
$num_code = array('0\a', '1\b', '2\c', '3\d', '4\e', '5\f', '6\g', '7\h', '8\k', '9\n');
$smiles = array("0&#8419;", "1&#8419;", "2&#8419;", "3&#8419;", "4&#8419;", "5&#8419;", "6&#8419;", "7&#8419;", "8&#8419;", "9&#8419;");
$rdate = str_replace($num_code, $smiles, $sdate);

# создание запроса на смену статуса
$request_params = array(
'user_id' => $user_id,
'text' => "Время у меня: $rdate | $temp °C, $link_wea",
'access_token' => $access_key,
'v' => '5.52'
);
$get_params = http_build_query($request_params);
$result = json_decode(file_get_contents('https://api.vk.com/method/status.set?'. $get_params));
sleep(60);
}
?> 