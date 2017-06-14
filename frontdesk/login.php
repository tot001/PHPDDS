<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
$link=connect();
$action=$_GET['action'];
$mevocode=false;
escape($link,$_POST);
if ($action=='login'){
    $mename=htmlspecialchars(trim($_POST['mename']));
    $mepw=htmlspecialchars(trim($_POST['mepw']));
    $vocode=htmlspecialchars(trim($_POST['mevocode']));
    if (empty($mename)){
        $arr['success']=0;
        $arr['msg']='Username is empty';
        echo json_encode($arr);
        exit();
    }
    if (empty($mepw)){
        $arr['success']=0;
        $arr['msg']='Password is empty';
        echo json_encode($arr);
        exit();
    }

    if (empty($_POST['metime'])|| $_POST['metime']>'259200'|| !is_numeric($_POST['metime'])){
        $_POST['metime']=86400;
    }

    if (strtolower($vocode)!=strtolower($_SESSION['vocode'])){
        $arr['success']=0;
        $arr['msg']='Wrong Vocode';
        echo json_encode($arr);
        exit();
    }else{
         $mevocode=true;
    }

    if (!empty($mename) && !empty($mepw) && $mevocode==true){
        $query="select * from sm_member where name='{$_POST['mename']}' and pw=md5('{$_POST['mepw']}')";
        $result=execute($link,$query);
        if (mysqli_num_rows($result)==1) {
            setcookie('memberName',$_POST['mename'],time()+$_POST['metime']);
            setcookie('memberPw',sha1(md5($_POST['mepw'])),time()+$_POST['metime']);
            $arr['success']=1;
        }else{
            $arr['success']=0;
            $arr['msg']='Wrong Username or Password';
        }
        echo json_encode($arr);
    };

}elseif ($action=='logout'){
    echo '1';
    // setcookie('member[name]',"",time()-$_POST['metime']);
    // setcookie('member[pw]',"",time()-$_POST['metime']);
}
?>


