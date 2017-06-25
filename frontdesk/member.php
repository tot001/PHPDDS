<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
include_once '../inc/tool.inc.php';
include_once 'inc/page.inc.php';

$template=array("title"=>"member",
    "keywords"=>"member",
    "description"=>"member",
    "css"=>array('style/public.css','style/member.css'),
    "js"=>array('js/member.js'));
$link=connect();
$member_id=is_login($link);
if (!isset($_GET['id']) || !is_numeric($_GET['id'])){
    Header("Location: ../admin/404.php");
    exit();
}
$query="select * from sm_member WHERE id={$_GET['id']}";
$result_son=execute($link,$query);
$data_son=mysqli_fetch_assoc($result_son);
if (mysqli_num_rows($result_son)==0){
    Header("Location: ../admin/404.php");
    exit();
}

$query="select COUNT(*) from sm_content WHERE member_id={$_GET['id']}";
$count_all=num($link,$query);
$query="select * from sm_member WHERE id={$_GET['id']}";
$result_mem=execute($link,$query);
$data_mem=mysqli_fetch_assoc($result_mem);

?>
<?php include_once 'inc/desk_header.inc.php' ?>
<div class="space-body container">
    <div class="h">
        <div class="wrapper">
            <div class="h-inner">
                <div class="h-gradient"></div>
                <div class="h-user">
                    <div class="h-avatar"><img src="style/photo.jpg" alt="" id="h-avatar"></div>
                    <div class="h-info">
                        <div class="h-basic">
                            <span id="h-name"><?php echo $data_mem['name']?></span>
                        </div>
                        <div class="h-sign" title="<?php echo $data_mem['signature']?>" style="display: none"></div>
                        <input type="text"  id="h-sign" maxlength="60">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            Mem_Ajax(<?php echo $_GET['id']?>);
        })
    </script>
    <div class="n">
        <div class="wrapper">
            <div class="n-inner">
                <div class="n-statistics">
                    <div class="n-data n-zt">
                        <p class="n-data-k">縂帖數</p>
                        <p class="n-data-v"><?php echo $count_all?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="s-space">
        <div class="wrapper">
            <div class=" col-1 col-lg-9">
                <ul class="postsList">
                    <?php
                    $i=0;
                    $page=page($count_all,10,5);
                        $query="SELECT st.title,st.time,st.times,st.id,st.member_id,sr.name,sr.photo FROM sm_content st , sm_member sr  WHERE st.member_id={$_GET['id']} and  st.member_id = sr.id order by id desc {$page['limit']}";
                        $result_con=execute($link,$query);
                        while ($data_con=mysqli_fetch_assoc($result_con)){
                            $data_con['title']=htmlspecialchars($data_con['title']);
                            $query="select time from sm_reply where content_id={$data_con['id']} order by id desc limit 1";
                            $result_last_reply=execute($link, $query);
                            if(mysqli_num_rows($result_last_reply)==0){
                                $last_time='暂无';
                            }else{
                                $data_last_reply=mysqli_fetch_assoc($result_last_reply);
                                $last_time=$data_last_reply['time'];
                            }
                            $query="select count(*) from sm_reply where content_id={$data_con['id']}";
                            ?>
                            <li id="item<?php echo$data_con['id']?>">
                                <div class="smallPic">
                                   <img class="img-rounded" src="<?php if($data_con['photo']!=''){echo $data_con['photo'];}else{echo 'style/photo.jpg';}?>" alt="">
                                </div>
                                <div class="subject">
                                    <div class="titleWarp">
                                        <a target="_blank" href="show.php?id=<?php echo$data_con['id']?>"><?php echo $data_con['title']?></a>
                                        <p>
                                            楼主：<?php echo "{$data_con['name']} " ?><?php echo date('Y-m-d',strtotime($data_con['time']))?>
                                            <span>
                                                <?php
                                                if(check_user($member_id,$data_con['member_id'])){
                                                    $DeUrl=urlencode("Ajax.php?id={$data_con['id']}&action=delete");
                                                    $RtUrl=urlencode($_SERVER['REQUEST_URI']);
                                                    $Message=$data_con['title'];
                                                    $Action="Delete";
                                                    $Confirm_url="confirm.php?DeUrl={$DeUrl}&RtUrl={$RtUrl}&Message={$Message}&action={$Action}";
                                                    echo "<a class='cm' data-toggle='modal' data-target='#ConModal' data-url='$Confirm_url'>Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                           <a href=''>Edit</a>";
                                                }

                                                ?>

                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="count">
                                    <p>回复 <br><span><?php echo num($link,$query)?></span></p>
                                    <p>浏览 <br><span><?php echo  $data_con['times']?></span></p>
                                </div>
                                <div style="clear: both;flex: 0"></div>
                            </li>
                        <?php }?>
                </ul>
                <div class="page_warp">
                    <div>
                        <ul class=" pager">
                            <?php
                            echo $page['html'];
                            ?>
                        </ul>
                    </div>
                </div>
                <div id="footer">
                    <h3 style="font-size: 20px">最近不勤快呦 (゜-゜)つロ</h3>
                </div>
            </div>
            <div class="col-lg-3"></div>


        </div>
    </div>
</div>

<div class="modal fade" id="ConModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>

<div class="alert alert-warning prompt">
    <a class="close" >
        &times;
    </a>
    <strong class="p-n"></strong>
</div>

<?php include_once 'inc/desk_footer.inc.php'?>
