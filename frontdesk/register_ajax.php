<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
$link=connect();
$action=$_GET['action'];

if ($action=='user'){
    $username=htmlspecialchars(trim($_POST['username']));
    if (!empty($username)){
        $query="select * from sm_member where name='{$username}'";
        $result=execute($link,$query);
        if (mysqli_num_rows($result)) {
            echo "exist";
        }else{
            echo "use";
        }
    };
}

if($action=='vocode'){
    $vocode=htmlspecialchars(trim($_POST['vocode']));
    if (strtolower($vocode)!=strtolower($_SESSION['vocode'])){
        echo "err";
    }else{
        echo "ok";
    };
}



?>