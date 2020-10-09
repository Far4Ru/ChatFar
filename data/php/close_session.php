<?php
    session_start();
    if(empty($_SESSION['login']) or empty($_SESSION['password'])){
        header('Location: ../../index.php');
    }
    unset($_SESSION['login']);
    unset($_SESSION['id']);
    header('Location:  ../../index.php');
?>