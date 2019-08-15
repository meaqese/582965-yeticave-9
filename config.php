<?php
	$db_data = [
		'host' => 'localhost',
		'user' => 'mysql',
		'password' => 'mysql',
		'base' => 'yeticave'
	];

	$db = mysqli_connect($db_data['host'],$db_data['user'],$db_data['password'],$db_data['base']) or die(mysqli_connect_error($db));
	mysqli_set_charset($db,'utf8');

	$is_auth = rand(0, 1);

	$user_name = 'BigBoy'; // укажите здесь ваше имя


	/**
	 * Возвращает время до полуночи
	 */
	date_default_timezone_set('Europe/Moscow');
	$timeinsec = strtotime("tomorrow midnight") - strtotime("now");
	$hours = floor($timeinsec / 3600);
	$minutes = floor(($timeinsec % 3600) / 60);
	$interval = [
		'hours' => $hours,
		'minutes' => $minutes,
		'seconds' => $timeinsec
	];


	/**
	 * Получаем категории
	 */
	$getCategorylist = mysqli_query($db,"SELECT * FROM `categories`");
	$Categorylist = mysqli_fetch_all($getCategorylist,MYSQLI_ASSOC) or mysqli_error($db);
?>