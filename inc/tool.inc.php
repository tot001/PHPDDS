<?php
function myAlert($color,$url,$title,$string){
    //warning success info danger
    if ($color=='info'){
        $Suhtml=<<<B
<div id="myAlert" class="alert alert-{$color}" >
    <a href="{$url}" class="close" data-dismiss="alert">&times;</a>
    <strong>{$title}！</strong>{$string}。
</div>
<script>; 
   location.href='{$url}'; 
</script>;
B;
        echo $Suhtml;
        exit();
    }
    if ($color=='warning'){
        $Wahtml=<<<B
<div id="myAlert" class="alert alert-{$color}" >
    <a href="{$url}" class="close" data-dismiss="alert">&times;</a>
    <strong>{$title}！</strong>{$string}。
</div>
B;
        echo $Wahtml;
    }else{
        $Dehtml=<<<B
<div id="myAlert" class="alert alert-{$color}" >
    <a href="{$url}" class="close" data-dismiss="alert">&times;</a>
    <strong>{$title}！</strong>{$string}。
</div>
B;
        echo $Dehtml;
        exit();
    }
};
function AlertSort($color,$url,$title,$string){
    $html=<<<A
    <script>
    window.onload=function () {
       Alert_sort("{$color}","{$url}","{$title}","{$string}");
      }
    </script>
A;
    echo $html;
}

function is_login($link){
    if (isset($_COOKIE['memberName']) && isset($_COOKIE['memberPw'])){
        $query="select * from sm_member WHERE name='{$_COOKIE['memberName']}' and sha1(pw)='{$_COOKIE['memberPw']}' ";
        $result=execute($link,$query);
        if (mysqli_num_rows($result)==1){
            $data=mysqli_fetch_assoc($result);
            return $data['id'];
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function skip($url,$str="",$con=""){
    $html=<<<A
<!DOCTYPE html>
<html>
<head>
	<title>正在跳转中</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta http-equiv="refresh" content="1;URL={$url}" />
</head>
<body>
<div class="jumbotron" style="background: white">
<div class="container" style="text-align: center;">
<h1>$str</h1>
<p>
    $con
</p>
<p><a class="btn btn-primary btn-lg" role="button" href="javascript:history.back()">返回上一页</a></p>
</div>
</div>
</body>
</html>
A;
    echo $html;
    exit();
};

function check_user($member_id,$content_member_id){
    if($member_id==$content_member_id){
        return true;
    }else{
        return false;
    }
}
?>






