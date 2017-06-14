<?php
session_start();
include_once 'inc/vocode.inc.php';
$_SESSION['vocode']=vcode(78,32,20,3);
?>