<?php
    require "helpers.php";


    $is_auth = rand(0, 1);

    $user_name = 'BigBoy'; // укажите здесь ваше имя


    #ARRAYS#
    $goodnamelist = ['Доски и лыжи','Крепления','Ботинки','Одежда','Инструменты','Разное'];
    $goodlist = [
        [
            "name"=>"2014 Rossignol District Snowboard",
            "category"=>"$goodnamelist[0]",
            "price"=>"10999",
            "picture"=>"img/lot-1.jpg",
        ],
        [
            "name"=>"DC Ply Mens 2016/2017 Snowboard",
            "category"=>"$goodnamelist[0]",
            "price"=>"159999",
            "picture"=>"img/lot-2.jpg",
        ],
        [
            "name"=>"Крепления Union Contact Pro 2015 года размер L/XL",
            "category"=>"$goodnamelist[1]",
            "price"=>"8000",
            "picture"=>"img/lot-3.jpg",
        ],
        [
            "name"=>"Ботинки для сноуборда DC Mutiny Charocal",
            "category"=>"$goodnamelist[2]",
            "price"=>"10999",
            "picture"=>"img/lot-4.jpg",
        ],
        [
            "name"=>"Куртка для сноуборда DC Mutiny Charocal",
            "category"=>"$goodnamelist[3]",
            "price"=>"7500",
            "picture"=>"img/lot-5.jpg",
        ],
        [
            "name"=>"Маска Oakley Canopy",
            "category"=>"$goodnamelist[5]",
            "price"=>"5400",
            "picture"=>"img/lot-6.jpg",
        ]
    ];

    /* DATE */
    $now = date_create("now");
    $midnight = date_create("tomorrow midnight");

    $diff = date_diff($now,$midnight);
    $hours = date_interval_format($diff,'%H:%I');

    /*NUMFORM*/
    function numform($price) {
        $price = ceil($price);
        if ($price >= 1000) {
            $price = number_format($price,0,'',' ').' ₽';
        }
        return $price;
    }

    $page_content = include_template("index.php",
        [
            'category' => $goodnamelist,
            'list' => $goodlist,
            'hours' => $hours,
        ]);
    $layout = include_template("layout.php",
        [
            'title' => 'Главная',
            'content' => $page_content,
            'user_name' => $user_name,
            'is_auth' => $is_auth,
            /*Cycle*/
            'goodnamelist' => $goodnamelist,
            'goodlist' => $goodlist,
        ]);
    print $layout;
?>
