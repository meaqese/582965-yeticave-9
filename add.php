<?php
	require 'helpers.php';
	require 'config.php';

	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $add_lot = include_template("add-lot.php",
            [
                'categories' => $Categorylist
            ]
        );

        $layout = include_template("layout.php",
            [
                'title' => 'Добавление лота',
                'content' => $add_lot,
                'is_auth' => $is_auth,
                'user_name' => $user_name,
                'categories' => $Categorylist
            ]
        );

        print $layout;
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $lot = $_POST['lot'];
            $error = [];
            $required_fields = ['name','category','description','firstprice','bidstep','enddate'];
            $intreq_fields = ['firstprice','bidstep'];
            $dict = [
                'file' => 'Картинка',
                'name' => 'Название',
                'category' => 'Категория',
                'description' => 'Описание',
                'firstprice' => 'Начальная цена',
                'bidstep' => 'Шаг ставки',
                'enddate' => 'Дата окончания торгов'
            ];

            /* Form Validation [Begin]
             * */

            foreach ($required_fields as $key) {
                if (empty($lot[$key]) OR '0' == $lot[$key]) {
                    $error[$key] = 'Это поле необходимо заполнить';
                }
            }

            foreach ($intreq_fields as $intfield) {
                if (!filter_var($lot[$intfield],FILTER_VALIDATE_INT)) {
                    $error[$intfield] = $dict[$intfield].' должен быть целым и больше нуля';
                }
            }

            $category_option_id = intval($lot['category']);

            $category_id_query = mysqli_query($db,"SELECT * FROM `categories` WHERE `id` = '$category_option_id'");
            if (!mysqli_num_rows($category_id_query)) {
                $error['category'] = $dict['category'].' не существует';
            }


            if (is_date_valid($lot['enddate'])) {
                $periodinsec = strtotime($lot['enddate']) - strtotime("now");

                if (($periodinsec / 3600) < 24) {
                    $error['enddate'] = $dict['enddate'] . ' должна быть как минимум на день дольше и иметь формат ГГГГ-ММ-ДД';
                }
            }

            /* Form Validation [End]
             * */

            if (is_uploaded_file($_FILES['lot-img']['tmp_name'])) {
                $tmp_name = $_FILES['lot-img']['tmp_name'];
                $filename = $_FILES['lot-img']['name'];

                $filemimetype = finfo_open(FILEINFO_MIME_TYPE);
                $finfo = finfo_file($filemimetype,$tmp_name);



                if ($ext = mime_to_ext($finfo) != '') {
                    $newpath = 'uploads/'.uniqid().$ext;
                }
                else {
                    $error['file'] = 'Изображение должно иметь расширение типа JPG/JPEG или PNG';
                }
            }
            else {
                $error['file'] = 'Вы не загрузили картинку';
            }

            if (count($error)) {
                $add_lot = include_template('add-lot.php',
                    [
                        'error' => $error,
                        'dict' => $dict,
                        'categories' => $Categorylist,
                        'lot' => $lot,
                    ]  
                );

                $layout = include_template("layout.php",
                    [
                        'title' => 'Добавление лота',
                        'content' => $add_lot,
                        'is_auth' => $is_auth,
                        'user_name' => $user_name,
                        'categories' => $Categorylist
                    ]
                );

                print $layout;
            }
            else {
                move_uploaded_file($tmp_name, $newpath);

                $sqlmove = "INSERT INTO `lot` (`author_id`,`category_id`,`dateadd`,`lotname`,`lotdesc`,`imgurl`,`firstprice`,`enddate`,`bidstep`) VALUES (?,?,NOW(),?,?,?,?,?,?)";

                $stmt = db_get_prepare_stmt($db,$sqlmove,[
                    1,
                    $lot['category'],
                    $lot['name'],
                    $lot['description'],
                    $newpath,
                    $lot['firstprice'],
                    $lot['enddate'],
                    $lot['bidstep']
                ]);
                $res = mysqli_stmt_execute($stmt);

                $ins = mysqli_insert_id($db);
                header("Location: /lot.php?id=$ins");
            }
    }


?>