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
?>






