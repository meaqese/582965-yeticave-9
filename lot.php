<?php
    session_start();
	require 'helpers.php';
	require 'config.php';

    if (isset($_GET['id'])) {
        $lot_errors = [];

        $queryid = intval($_GET['id']);
        $check_id = mysqli_query($db, "SELECT * FROM `lot` WHERE `id` = '$queryid' AND `enddate` > TIMESTAMP (NOW())");

        if (mysqli_num_rows($check_id) > 0) {

            /**
             * Get Lots list
             */
            $getLotslistquery =
                "SELECT cary.name, `lotname`, `lotdesc`, `imgurl`, `firstprice`, `enddate`, lot.id, MAX(bids.offer) as maxprice, `bidstep` FROM `lot` 
		INNER JOIN `categories` cary ON cary.id = lot.category_id 
		LEFT JOIN `bids` ON bids.lot_id = lot.id
		WHERE `enddate` > TIMESTAMP(NOW()) AND lot.id = '$queryid' 
		GROUP BY bids.lot_id 
		ORDER BY `dateadd` DESC;";


            $getLotslist = mysqli_query($db, $getLotslistquery);
            $Lotslist = mysqli_fetch_assoc($getLotslist);
            /**
             * Get bids list
             */
            $bquerydata =
                "SELECT users.name offername, offer, bidate 
		FROM `bids` INNER JOIN `lot` ON lot.id = bids.lot_id 
		INNER JOIN `users` ON users.id = bids.user_id 
		WHERE lot.id =  '$queryid'";

            $bidsquery = mysqli_query($db, $bquerydata);


            /**
             * Include templates from /templates
             */
            $lot_page = include_template("lot.php", [
                'categories' => $Categorylist,
                'lots' => $Lotslist,
                'interval' => $interval,
                'bids' => $bidsquery
            ]);

            if (isset($_SESSION['email'])) {
                $layout = include_template("layout.php", [
                    'title' => $Lotslist['lotname'],
                    'content' => $lot_page,
                    'is_auth' => true,
                    'categories' => $Categorylist
                ]);
            }
            else {
                $layout = include_template("layout.php", [
                    'title' => $Lotslist['lotname'],
                    'content' => $lot_page,
                    'is_auth' => false,
                    /*Cycle*/
                    'categories' => $Categorylist
                ]);
            }
            print $layout;
        }
        else {
            $lot_errors[] = 'ID лота отсутствует в базе данных';
        }
    }
    else {
        $lot_errors[] = 'В строке запроса отсутсвует ID лота';
    }

    if (count($lot_errors)) {
        http_response_code('404');
    }

?>