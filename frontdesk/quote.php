<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
$link=connect();
$_POST=escape($link,$_POST);

?>