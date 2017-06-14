<?php 
if(!is_numeric($_POST['father_module_id'])){
    myAlert("danger","#",'Plate name','Not Empty');
}
$query="select * from am_father_module where id={$_POST['father_module_id']}";
$result=execute($link,$query);
if(mysqli_num_rows($result)==0){
    myAlert("warning","#",'Select','Plate name');
    exit();
}
if(empty($_POST['module_name'])){
    myAlert("warning","#",'Sub','Not Empty');
    return false;
}
if(mb_strlen($_POST['module_name'])>66){
    myAlert("warning","#",'Plate name','Greater than 66');
    return false;
}
if(mb_strlen($_POST['info'])>255){
    myAlert("warning","#",'Sub-Introduction','Greater than 255');
    return false;
}
if(!is_numeric($_POST['sort'])){
    myAlert("warning","#",'Sorting can','Only Number');
    return false;
}
$_POST=escape($link,$_POST);
switch ($check_flag){
	case 'add':
		$query="select * from sm_son_module where module_name='{$_POST['module_name']}'";
		break;
	case 'update':
		$query="select * from sm_son_module where module_name='{$_POST['module_name']}' and id!={$_GET['id']}";
		break;
	default:
        myAlert("danger","#",'Failure','$check_flag');
}
$result=execute($link,$query);
if(mysqli_num_rows($result)){
    myAlert("warning","#",'Sub','Already exists');
}

?>