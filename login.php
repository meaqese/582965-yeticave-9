<?php
    session_start();
    require 'helpers.php';
    require 'config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_SESSION['email'])) {
            header('Location: /index.php');
        }
        else {
            #temp - Template;
            $login_temp = include_template('login-template.php', ['categories' => $Categorylist]);

            $layout = include_template('layout.php', [
                'title' => 'Login',
                'content' => $login_temp,
                'is_auth' => false,
                'categories' => $Categorylist
            ]);
            print $layout;
        }
    }

    elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $authdata = $_POST['authdata'];
        $errors = [];
        $required_fields = ['email','password'];

        foreach ($required_fields as $required_field) {
            if (empty($required_field)) {
                $errors[$required_field] = 'Заполните это поле';
            }
        }

        if (!filter_var($authdata['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Введите ваш реальный E-Mail';
        }
        else {
            $email = $authdata['email'];
            $email_check = mysqli_query($db, "SELECT * FROM `users` WHERE `email` = '$email'");

            if (!mysqli_num_rows($email_check) > 0) {
                $errors['email'] = 'Данный E-Mail отсутствует в нашей базе';
            }
            else {
                $check_result = mysqli_fetch_assoc($email_check);
                $password = $authdata['password'];
                //$password_check_query = mysqli_query($db,"SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

                if (!password_verify($password, $check_result['password'])) {
                    $errors['password'] = 'Введенный вами пароль неверный';
                }
            }
        }


        if (count($errors)) {
            $login_temp = include_template('login-template.php',
                [
                    'categories' => $Categorylist,
                    'error' => $errors,
                    'authdata' => $authdata
                ]
            );

            $layout = include_template('layout.php',[
                'title' => 'Регистрация',
                'content' => $login_temp,
                'is_auth' => false,
                'categories' => $Categorylist
            ]);
            print $layout;
        }
        else {
            $_SESSION['username'] = $check_result['name'];
            $_SESSION['email'] = $authdata['email'];
            $_SESSION['password'] = $authdata['password'];

            header('Location: index.php');
        }
    }
?>