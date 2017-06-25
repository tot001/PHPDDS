<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
include_once '../inc/tool.inc.php';
include_once 'inc/page.inc.php';
$template=array("title"=>"list_father",
    "keywords"=>"list_father",
    "description"=>"list_father",
    "css"=>array('style/public.css','style/list.css'),
    "js"=>array(''));
$link=connect();
$member_id=is_login($link);
if (!isset($_GET['id']) || !is_numeric($_GET['id'])){
    Header("Location: ../admin/404.php");
    exit();
}
$query="select * from am_father_module WHERE id={$_GET['id']}";
$result_father=execute($link,$query);
$data_father=mysqli_fetch_assoc($result_father);
if (mysqli_num_rows($result_father)==0){
    Header("Location: ../admin/404.php");
    exit();
}
$query="SELECT * FROM sm_son_module WHERE father_module_id={$_GET['id']}";
$result_son=execute($link,$query);
$id_son='';$son_list='';
while ($data_son=mysqli_fetch_assoc($result_son)){
    $id_son.=$data_son['id'].',';
    $son_list.="<a href='list_son.php?id={$data_son['id']}'>{$data_son['module_name']} </a>";
}
$id_son=trim($id_son,',');
if($id_son==''){
    $id_son='-1';
}
$query="select COUNT(*) FROM sm_content WHERE module_id IN ({$id_son})";
$count_all=num($link,$query);
$query="select COUNT(*) FROM sm_content WHERE module_id IN ({$id_son}) and time>CURDATE()";
$count_today=num($link,$query);
?>
<?php include_once 'inc/desk_header.inc.php' ?>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index.php"  class="glyphicon glyphicon-home">Home</a></li>
        <li class="active"><a href="list_father.php?id=<?php echo $data_father['id']?>"><?php echo $data_father['module_name']?></a></li>
    </ol>
    <div id="list_ft" class="list_ft col-lg-12">
        <div class="ft_left col-lg-8">
            <h2><?php echo $data_father['module_name']?></h2>
            <div class="digital">
                <span><?php echo "今日: {$count_today}"?></span>
                <span>&nbsp;&nbsp;&nbsp;<?php echo "总贴:{$count_all}"?></span>
                <div class="moderator">
                    子版块：<?php echo $son_list?>
                </div>
            </div>


            <ul class="postsList">
                <?php
                $page=page($count_all,2,5);

                if ($count_all!=0){
                    $query="SELECT st.title,st.time,st.times,st.id,st.member_id,sr.name,sr.photo,son.module_name,son.id ssm_id 
FROM sm_content st , sm_member sr ,sm_son_module son 
WHERE st.module_id IN ({$id_son}) 
and st.member_id = sr.id 
and st.module_id=son.id {$page['limit']}";
                    $result_con=execute($link,$query);
//                    var_dump(mysqli_fetch_all($result_con,MYSQLI_ASSOC));
                    while ($data_con=mysqli_fetch_assoc($result_con)){
                        $data_con['title']=htmlspecialchars($data_con['title']);
                        $query="select time from sm_reply WHERE content_id={$data_con['id']} ORDER  BY id DESC limit 1";
                        $result_last_reply=execute($link,$query);
                        if (mysqli_num_rows($result_last_reply)==0){
                            $last_time="暂无";
                        }else{
                            $data_last_reply=mysqli_fetch_assoc($result_last_reply);
                            $last_time=date('Y-m-d',strtotime($data_last_reply['time']));
                        }
                        $query="select count(*) from sm_reply WHERE content_id={$data_con['id']}";
                ?>
                    <li>
                        <div class="smallPic">
                            <a href="member.php?id=<?php echo $data_con['member_id']?>"><img src="<?php if($data_con['photo']!=''){echo $data_con['photo'];}else{echo 'style/photo.jpg';}?>" alt=""></a>
                        </div>
                        <div class="subject">
                            <div class="titleWarp">
                                <a href="list_son.php?id=<?php echo $data_con['ssm_id']?>" target="_blank">[<?php echo $data_con['module_name']?>]
                               <?php echo $data_con['title']?>
                                </a>
                                <p>
                                    楼主：<?php echo "{$data_con['name']} " ?><?php echo date('Y-m-d',strtotime($data_con['time']))?>
                                    最后回复：<?php echo $last_time?>
                                </p>
                            </div>
                        </div>
                        <div class="count">
                            <p>回复 <br><span><?php echo num($link,$query)?></span></p>
                            <p>浏览 <br><span><?php echo  $data_con['times']?></span></p>
                        </div>
                        <div style="clear: both;flex: 0"></div>
                    </li>
                <?php }}?>
            </ul>
            <div class="page_warp">
                <a class="col-lg-3" href="publish.php?ft_id=<?php echo $_GET['id']?>" target="_blank"><button class="btn btn-primary btn-sm publish">发帖</button></a>
                <div class="col-lg-7 ">
                    <ul class=" pager">
                        <?php
                            echo $page['html'];
                        ?>
                    </ul>
                </div>

            </div>

        </div>

        <div class="ft_right  col-lg-3">
            <div class=" panel panel-default ">
                <div class="panel-heading">
                    <h5>
                        <i class="glyphicon glyphicon-th-list"></i>
                        <span>版块列表</span>
                    </h5>
                </div>
                <?php
                $query="select * from am_father_module LIMIT 0,5";
                $result_father=execute($link, $query);
                $i=1;
                while($data_father=mysqli_fetch_assoc($result_father)){
                    $i++;
                    ?>
                    <div class="panel-heading">
                        <h3 data-toggle="collapse" data-target="#downMenu<?php echo $i?>">
                            <a href="list_father.php?id=<?php echo $data_father['id']?>"><?php echo $data_father['module_name']?></a>
                        </h3>
                    </div>
                    <div class=" panel-collapse collapse" id="downMenu<?php echo $i?>" >
                        <div class="panel-body">
                            <ul >
                                <?php
                                $query="select * from sm_son_module where father_module_id={$data_father['id']}";
                                $result_son=execute($link, $query);
                                while($data_son=mysqli_fetch_assoc($result_son)){
                                    ?>
                                    <li><h3><a href=""><?php echo $data_son['module_name']?></a></h3></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <?php
                }
                ?>

            </div>
        </div>

        <div id="footer" class=" col-xs-12">
            <div class="bottom">
                <a>Admin</a>
            </div>
            <div class="copyright">Powered by Admin ©2015 Admin.com</div>
        </div>
    </div>
</div>
<?php include_once 'inc/desk_footer.inc.php'?>

