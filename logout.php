<?php
    session_start();
    if (isset($_SESSION['email'])) {
        unset($_SESSION['email']);
        unset($_SESSION['password']);

        header('Location: index.php');
    }
    else {
        header('Location: index.php');
    }
?>