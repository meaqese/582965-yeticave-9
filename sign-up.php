<?php
    session_start();
    require 'helpers.php';
    require 'config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_SESSION['email'])) {
            header('Location: /index.php');
        }
        else {
            $signup_template = include_template('sign-up-template.php',
                [
                    'categories' => $Categorylist
                ]
            );

            $layout = include_template('layout.php',
                [
                    'title' => 'Регистрация',
                    'content' => $signup_template,
                    'is_auth' => false,
                    'categories' => $Categorylist
                ]
            );

            print $layout;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = $_POST['user'];
        $errors = [];
        $required_fields = ['email','password','name','contact'];

        # Variables for database queries

        $email = $user['email'];

        /**
         * Register form validation
         */

        foreach ($required_fields as $required_field) {
            if (empty($user[$required_field])) {
                $errors[$required_field] = 'Необходимо заполнить это поле.';
            }
        }

        if (empty($errors['email'])) {
            if (!filter_var($user['email'],FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Введите ваш реальный e-mail адрес';
            }
            else {
                $email_check = mysqli_query($db,"SELECT * FROM users WHERE email = '$email'");

                if (mysqli_num_rows($email_check) > 0) {
                    $errors['email'] = 'Пользователь с данным email уже есть в базе данных';
                }
            }
        }

        if (empty($errors['passoword'])) {
            if (strlen($user['password']) < 8) {
                $errors['password'] = 'Пароль должен иметь значение не менее 8 символов';
            }
        }

        if (count($errors)) {
            $signup_template = include_template('sign-up-template.php',
                [
                    'categories' => $Categorylist,
                    'error' => $errors,
                    'user' => $user
                ]
            );

            $layout = include_template('layout.php',
                [
                    'title' => 'Регистрация',
                    'content' => $signup_template,
                    'is_auth' => false,
                    'categories' => $Categorylist
                ]
            );

            print($layout);
        }
        else {
            $user['password_hash'] = password_hash($user['password'],PASSWORD_DEFAULT);

            $sql_accept =
                "INSERT INTO users (regdate, email, `name`, `password`, contacts)".
                "VALUES (NOW(), ?, ?, ?, ?)";

            $accept_stmt = db_get_prepare_stmt($db,$sql_accept,
                [
                    $user['email'],
                    $user['name'],
                    $user['password_hash'],
                    $user['contact']
                ]
            );
            mysqli_stmt_execute($accept_stmt);

            header('Location: index.php');
        }
    }
?>
