<?php
include_once '../inc/msql.inc.php';
include_once '../inc/config.inc.php';
include_once '../inc/tool.inc.php';
if (!isset($_GET['id']) || is_numeric($_GET['id'])){
    $link=connect();
    $query="delete from sm_son_module WHERE id={$_GET['id'] }";
    //执行一条SQL语句,返回结果集对象或者布尔值
    Dexecute($link,$query);
    if (mysqli_affected_rows($link)==1){
        myAlert("success","father_module.php",'Success','Successfully Deleted');
    }else{
        myAlert("danger","father_module.php",'Failure','Failed To Delete');
        exit();
    }
}else{
    myAlert("danger","father_module.php",'Failure','Failed To Delete');
    exit();
}

?>
