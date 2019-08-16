<?php
    require 'helpers.php';
    require 'config.php';

    $signup_template = include_template('sign-up-template.php',
        [
            'categories' => $Categorylist
        ]
    );

    $layout = include_template('layout.php',
        [
            'title' => 'Регистрация',
            'content' => $signup_template,
            'is_auth' => $is_auth,
            'user_name' => $user_name,
            'categories' => $Categorylist
        ]
    );

    print $layout;
?>