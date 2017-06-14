<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
$link=connect();
$_POST=escape($link,$_POST);
$action=$_GET['action'];
$content=nl2br(htmlspecialchars(trim($_POST['content'])));
$member_id=htmlspecialchars(trim($_POST['member_id']));
$query="select * from amdds.sm_content WHERE id={$_GET['id']}";
$result_cont=execute($link,$query);
if (mysqli_num_rows($result_cont)!=1){
    $arr['error']=false;
    $arr['msgs']="提交失败";
    echo json_encode($arr);
    exit();
}
if (mb_strlen($content)<3){
    $arr['error']=false;
    $arr['msgs']="内容不得少于3个字";
    echo json_encode($arr);
    exit();
}
if (empty($member_id)){
    $arr['error']=false;
    $arr['msgs']="请登录";
    echo json_encode($arr);
    exit();
}
if ($action=='messReply'){
    if (mb_strlen($content)>3 && !empty($member_id)){
        $query="insert into amdds.sm_reply(content_id,content,time,member_id) VALUES ({$_GET['id']},'{$content}',now(),{$member_id})";
        execute($link,$query);
        if (mysqli_affected_rows($link)==1){
            $arr['success']=200;
            $arr['msgs']="提交成功";
            $query="select count(*) from amdds.sm_reply WHERE content_id={$_GET['id']}";
            $count=num($link, $query)+1;
            $query="SELECT sp.time,sp.content,sp.id,sp.member_id,sm.photo,sm.name FROM sm_reply sp,sm_member sm WHERE sp.member_id=sm.id AND sp.content_id={$_GET['id']} ORDER BY time desc limit 1";
            $result_reply=execute($link,$query);
            $data_reply=mysqli_fetch_assoc($result_reply);
            $reply_photo='';
            if($data_reply['photo']!=''){
                $reply_photo=$data_reply['photo'];
            } else{
                $reply_photo='style/photo.jpg';
            }
            $html=<<<a
        <div class="col-lg-12 col-sm-12 article-list_purus">
            <article class="featured">
                <ul class="col-lg-2 col-sm-2">
                    <li><img class="img-rounded " src="$reply_photo" style="width: 80px" alt=""></li>
                    <li class="name-thumb_purus">{$data_reply['name']}</li>
                </ul>
                <div class="col-lg-10 col-sm-10">
                    <div class="pubdate">
                        <span class="date">回复时间：{$data_reply['time']} </span>
                        <span class="floor">{$count}楼&nbsp;</span>
                    </div>
                    <p class="content_purus z_box_z">
                        {$data_reply['content']}
                    </p>
                    <div class="time_purus col-lg-12 col-md-12">
                       <div class="queto{$data_reply['id']} col-lg-11 col-md-10 col-sm-10 "></div>
                        <div class="reply_r col-lg-1 col-md-2 col-sm-2" data-replyID="{$data_reply['id']}">
                                <a class="reply">Reply</a>
                        </div>
                    </div>

                </div>
            </article>
        </div>
        <script>
            Reply_ajax({$_GET['id']},{$member_id});
        </script>
a;
            $arr['html']=$html;
        }else{
            $arr['error']=false;
            $arr['msgs']="提交失败";
        }
        echo json_encode($arr);
    }
}
else if ($action=='reply'){
    $reply_id=htmlspecialchars(trim($_POST['reply_id']));
    if (mb_strlen($content)>3 && !empty($member_id)){
        $query="insert into amdds.sm_reply(content_id,quote_id,content,time,member_id) values({$_GET['id']},{$reply_id},'{$content}',now(),{$member_id})";
        execute($link, $query);
        if(mysqli_affected_rows($link)==1){
            $arr['success']=200;
            $arr['msgs']="提交成功";
            $query="SELECT sp.content,sp.quote_id,sm.photo,sm.name FROM amdds.sm_reply sp,amdds.sm_member sm WHERE sp.quote_id={$reply_id} AND sp.content_id={$_GET['id']} AND sp.member_id=sm.id";
            $result_quote=execute($link,$query);
            $data_quote=mysqli_fetch_assoc($result_quote);
            $photo='';
            if($data_quote['photo']!=''){
                $photo=$data_quote['photo'];
            } else{
                $photo='style/photo.jpg';
            }
            $html=<<<b
            <div class="media">
            <a href="#" class="pull-left"><img class="img-circle" src="{$photo}" class="media-object" alt='' /></a>
                <div class="media-body">
                    <h4 class="media-heading">
                       {$data_quote['name']}
                    </h4> 
                        {$content}
            </div>
            </div>
b;
            $arr['html']=$html;
        }else{
            $arr['error']=false;
            $arr['msgs']="提交失败";
        }
        echo json_encode($arr);
    }
}






?>


