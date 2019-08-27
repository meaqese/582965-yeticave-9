<?php
    session_start();
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
    if (isset($_SESSION['email'])) {
        $layout = include_template("layout.php",
            [
                'title' => 'Главная',
                'content' => $page_content,
                'user_name' => $_SESSION['email'],
                'is_auth' => true,
                /*Cycle*/
                'categories' => $Categorylist
            ]
        );
    }
    else {
        $layout = include_template("layout.php",
            [
                'title' => 'Главная',
                'content' => $page_content,
                'is_auth' => false,
                'categories' => $Categorylist
            ]
        );
    }

    print $layout;
?>
