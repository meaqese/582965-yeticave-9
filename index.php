<?php
    require "helpers.php";
    require 'config.php';

    /* Query for list of lots */
    $getLotslist = mysqli_query($db, "SELECT `lotname`,cary.name,`imgurl`,`firstprice`,lot.id FROM `lot` INNER JOIN `categories` cary ON cary.id = lot.category_id WHERE `enddate` > TIMESTAMP(NOW()) ORDER BY `dateadd` DESC;");
    $lotlist = mysqli_fetch_all($getLotslist,MYSQLI_ASSOC);

    #NUMFORM#
    function numform($price) {
        $price = ceil($price);
        if ($price >= 1000) {
            $price = number_format($price,0,'',' ').' ₽';
        }
        return $price;
    }

    $page_content = include_template("index.php",
        [
            'category' => $Categorylist,
            'list' => $lotlist,
            'interval' => $interval
        ]
    );
    $layout = include_template("layout.php",
        [
            'title' => 'Главная',
            'content' => $page_content,
            'user_name' => $user_name,
            'is_auth' => $is_auth,
            /*Cycle*/
            'categories' => $Categorylist
        ]);

    print $layout;
?>
