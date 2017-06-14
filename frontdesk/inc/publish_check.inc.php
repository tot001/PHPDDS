<?php
if (empty($_POST['module_id']) || !is_numeric($_POST['module_id'])){
    Header("Location: publish.php");
    exit();
}
$query="select * from sm_son_module where id={$_POST['module_id']}";
$result=execute($link, $query);
if (mysqli_num_rows($result)!=1){
    skip('publish.php','发布失败');
    exit();
}
if(empty($_POST['title']) || mb_strlen($_POST['title'])>255) {
    Header("Location: publish.php");
    exit();
}
if(empty($_POST['content'])) {
    Header("Location: publish.php");
    exit();
}
?>