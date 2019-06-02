<?php
    require "helpers.php";

    /* DATABASE CONNECT */
    $db = mysqli_connect('localhost','mysql','mysql','yeticave') or die(mysqli_error($db));
    mysqli_set_charset($db,'utf8');

    /* Query for list of lots */
    $getLotslist = mysqli_query($db, "SELECT `lotname`,cary.name,`imgurl`,`firstprice` FROM `lot` INNER JOIN `categories` cary ON cary.id = lot.category_id WHERE `enddate` > TIMESTAMP(NOW()) ORDER BY `dateadd` DESC;");
    $lotlist = mysqli_fetch_all($getLotslist,MYSQLI_ASSOC);


    /* Query for list of categories */
    $getCategorieslist = mysqli_query($db,"SELECT * FROM `categories`");
    $categorieslist = mysqli_fetch_all($getCategorieslist,MYSQLI_ASSOC);

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

    #DATE#
    $now = date_create("now");
    $midnight = date_create("tomorrow midnight");

    $diff = date_diff($now,$midnight);
    $hours = date_interval_format($diff,'%H:%I');

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
            'category' => $categorieslist,
            'list' => $lotlist,
            'hours' => $hours
        ]
    );
    $layout = include_template("layout.php",
        [
            'title' => 'Главная',
            'content' => $page_content,
            'user_name' => $user_name,
            'is_auth' => $is_auth,
            /*Cycle*/
            'categories' => $categorieslist,
        ]);

    print $layout;
?>
