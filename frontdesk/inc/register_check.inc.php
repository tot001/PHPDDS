<?php
if (empty($_POST['name'])){
    Header("Location: register.php");
    exit();
    }
    if (empty($_POST['pw'])|| mb_strlen($_POST['pw']<6)){
        Header("Location: register.php");
        exit();
    }
    if ($_POST['pw']!=$_POST['confirm_pw']){
        Header("Location: register.php");
        exit();
    }
//    if (strtolower($_POST['vocode'])!=strtolower($_SESSION['vocode'])){
//        Header("Location: register.php");
//        exit();
//    }
    $_POST=escape($link,$_POST);
?>

