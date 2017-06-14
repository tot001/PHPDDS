<?php
if (empty($_POST['module_name'])){
    myAlert("danger","#",'Plate name','Not Empty');
}
if(mb_strlen($_POST['module_name'])>66){
    myAlert("warning","#",'Plate name','Greater than 66');
}
if(!is_numeric($_POST['sort'])){
    myAlert("warning","#",'Sort','Not Empty');
}
$_POST=escape($link,$_POST);
switch ($check_flag){
    case'add':
        $query="SELECT * FROM am_father_module WHERE module_name='{$_POST['module_name']}'";
    break;
    case 'update':
        $query="select * from am_father_module where module_name='{$_POST['module_name']}' and id!={$_GET['id']}";
        break;
    default:
        myAlert("danger","#",'Failure','');
}
$result=execute($link,$query);
if (mysqli_num_rows($result)){
    myAlert("danger","#",'Plate',' Existed');
}
?>