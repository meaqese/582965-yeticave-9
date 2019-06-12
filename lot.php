<?php
	require 'helpers.php';
	require 'config.php';

	$queryid = mysqli_real_escape_string($db,$_GET['id']);
	$check_id = mysqli_query($db,"SELECT * FROM `lot` WHERE `id` = '$queryid' AND `enddate` > TIMESTAMP (NOW())");


	/* Get Category list */
	$getCategorylist = mysqli_query($db,"SELECT * FROM `categories`");
	$Categorylist = mysqli_fetch_all($getCategorylist,MYSQLI_ASSOC) or mysqli_error($db);

	/* Get Lots list */
	$getLotslist = mysqli_query($db,
"SELECT cary.name, `lotname`, `lotdesc`, `imgurl`, `firstprice`, `enddate`, lot.id, MAX(bids.offer) as maxprice, `bidstep` FROM `lot` 
INNER JOIN `categories` cary ON cary.id = lot.category_id 
INNER JOIN `bids` ON bids.lot_id = lot.id
WHERE `enddate` > TIMESTAMP(NOW()) AND lot.id = '$queryid' 
GROUP BY bids.lot_id 
ORDER BY `dateadd` DESC;");
	$Lotslist = mysqli_fetch_assoc($getLotslist) or mysqli_error($db);

	/* Bids */
	$bidsquery = mysqli_query($db,
		"SELECT users.name offername, offer, bidate FROM `bids`
INNER JOIN `lot` ON lot.id = bids.lot_id
INNER JOIN `users` ON users.id = bids.user_id
WHERE lot.id =  '$queryid'");

	$lot_page = include_template("lot.php",[
		'categories' => $Categorylist,
		'lot' => $Lotslist,
		'hours' => $hours,
		'bids' => $bidsquery
	]);

	$layout = include_template("layout.php",[
		'title' => $Lotslist['lotname'],
		'content' => $lot_page,
		'user_name' => $user_name,
		'is_auth' => $is_auth,
		/*Cycle*/
		'categories' => $Categorylist,
	]);
	if (empty($_GET['id']) OR mysqli_num_rows($check_id) == 0) {
		http_response_code('404');
	}
	else {
		print($layout);
	}
?>