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
	$now = date_create("now");
	$midnight = date_create("tomorrow midnight");

	$diff = date_diff($now,$midnight);
	$hours = date_interval_format($diff,'%H:%I');
?>