<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
include_once '../inc/tool.inc.php';
include_once 'inc/page.inc.php';
$template=array("title"=>"show",
    "keywords"=>"show",
    "description"=>"show",
    "css"=>array('style/public.css','style/show.css'),
    "js"=>array('js/show.js'));
$link=connect();
$member_id=is_login($link);
if (!isset($_GET['id']) || !is_numeric($_GET['id'])){
    Header("Location: ../admin/404.php");
    exit();
}
$query="update amdds.sm_content set times=times+1 WHERE id={$_GET['id']}";
execute($link,$query);
$query="select st.id ,st.module_id,st.title,st.content,st.time,st.times,st.member_id,sm.name,sm.photo from sm_content st,sm_member sm WHERE st.id={$_GET['id']} AND st.member_id=sm.id";
$result_con=execute($link,$query);
$data_con=mysqli_fetch_assoc($result_con);

if (mysqli_num_rows($result_con)!=1){
    Header("Location: ../admin/404.php");
    exit();
}

$data_con['title']=htmlspecialchars($data_con['title']);
$data_con['content']=nl2br(htmlspecialchars($data_con['content']));

$query="select count(*) from amdds.sm_reply WHERE content_id={$_GET['id']} AND quote_id=0";
$count_reply=num($link, $query);
$page_size=10;
$page=page($count_reply,$page_size);

?>
<?php include_once 'inc/desk_header.inc.php' ?>

<div class="container ">
    <div class="col-lg-12 column ">
        <div class="page-header">
            <h1>
                Content display <br>
                <small>Subtext for header</small>
            </h1>
        </div>
    </div>
    <?php if ($_GET['page']==1){?>
    <div class="col-lg-12 col-sm-12 article-list_purus">
        <article class="featured">
            <ul class="col-lg-2 col-sm-2">
                <li><img class="img-rounded " src="<?php if($data_con['photo']!=''){echo $data_con['photo'];}else{echo 'style/photo.jpg';}?>" style="width: 80px" alt=""></li>
                <li class="name-thumb_purus"><?php echo "{$data_con['name']}"?></li>
            </ul>
            <div class="col-lg-10 col-sm-10">
                <h2 class="posttitle_purus">
                    <span class="	glyphicon glyphicon-star"></span>
                    <?php echo "{$data_con['title']}"?>
                </h2>
                <p class="content_purus z_box_z">
                    <?php echo "{$data_con['content']}"?>
                </p>
                <div class="time_purus col-lg-12">
                    <div class="pull-right">
                        Browse:<?php echo $data_con['times']?>&nbsp;
                        <?php echo date('Y-m-d',strtotime($data_con['time']))?>&nbsp;
                        <a  id="reply">Reply</a>
                    </div>

                </div>

            </div>
        </article>
    </div>
    <?php }?>
    <div class="article_list_j">
    <?php
    $i=($_GET['page']-1)*$page_size+1;
    $query="SELECT sp.time,sp.content,sp.id,sp.quote_id,sp.member_id,sm.photo,sm.name FROM sm_reply sp,sm_member sm WHERE 
sp.member_id=sm.id AND sp.content_id={$_GET['id']} AND sp.quote_id=0 ORDER by id asc {$page['limit']}";
        $result_reply=execute($link,$query);
        while ($data_reply=mysqli_fetch_assoc($result_reply)){
            $data_reply['content']=nl2br(htmlspecialchars($data_reply['content']));

    ?>
        <div class="col-lg-12 col-sm-12 article-list_purus" >
            <article class="featured">
                <ul class="col-lg-2 col-sm-2">
                    <li><img class="img-rounded " src="<?php if($data_reply['photo']!=''){echo $data_reply['photo'];}else{echo 'style/photo.jpg';}?>" style="width: 80px" alt=""></li>
                    <li class="name-thumb_purus"><?php echo "{$data_reply['name']}"?></li>
                </ul>
                <div class="col-lg-10 col-sm-10">
                    <div class="pubdate">
                        <span class="date">回复时间：<?php echo $data_reply['time'] ?></span>
                        <span class="floor"><?php echo $i++ ?>楼</span>
                    </div>
                    <div class="content_purus z_box_z">
                        <?php echo "{$data_reply['content']}"?>
                    </div>
                    <div class="time_purus col-lg-12 col-md-12" >
                        <div class="queto<?php echo $data_reply['id']?> col-lg-11 col-md-10 col-sm-10 ">
                            <?php
                            $query="SELECT count(*) FROM amdds.sm_reply sp,amdds.sm_member sm WHERE 
sp.quote_id={$data_reply['id']} AND sp.content_id={$_GET['id']} AND sp.member_id=sm.id";
                            $floor=num($link,$query);
                            if ($floor>=1){
                                echo "<div class='media well'>";
                            $query="SELECT sp.content,sp.quote_id,sm.photo,sm.name FROM amdds.sm_reply sp,amdds.sm_member sm WHERE 
sp.quote_id={$data_reply['id']} AND sp.content_id={$_GET['id']} AND sp.member_id=sm.id";
                            $result_quote=execute($link,$query);
                            while ($data_quote=mysqli_fetch_assoc($result_quote)){
                                    ?>
                            <div class="media">
                                <a href="#" class="pull-left"><img class="img-circle" src="<?php if($data_reply['photo']!=''){echo $data_reply['photo'];}else{echo 'style/photo.jpg';}?>" class="media-object" alt='' /></a>
                                    <div class="media-body">
                                        <h6 class="media-heading">
                                            <?php echo $data_quote['name']?>
                                        </h6>
                                            <?php echo nl2br(htmlspecialchars($data_quote['content']))?>
                                    </div>
                            </div>
                            <?php }
                            echo "</div>";}
                            ?>

                        </div>
                        <div class="reply_r col-lg-1 col-md-2 col-sm-2" data-replyID="<?php echo $data_reply['id']?>">
                            <a class="reply">Reply</a>
                        </div>

                    </div>
                </div>
            </article>
        </div>
    <?php  } ?>
    </div>

    <div class="page_warp">
        <div class="col-lg-offset-2 col-lg-8 col-sm-12 ">
            <ul class="pager">
                <?php
                    echo $page['html'];
                ?>
            </ul>
        </div>

    </div>


</div>



<div class="intercom-messenger col-sm-5 col-lg-3">
    <div class="mess-header">
        <h5>
            Conversations <br>
            <small>Reply</small>
        </h5>
    </div>
    <div class="mess-content">
        <from id="mess-from" method="post" class="form-horizontal" action="#">
            <div class="form-group">
                <div class="mess-cont-area">
                    <textarea id="messReply"  name="messReply" class="form-control " cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class=" form-group mess-footer">
                <input type="submit" id="messSub" class="mess-btn btn" name="messSub" value="New Reply" />
            </div>
        </from>
        <p class="log"></p>
    </div>

</div>
<?php if ($member_id){?>
    <script>
        $(function () {
            $('.intercom-reply ').click(function () {
                Intercom_toggle();
            });
            Reply_ajax(<?php echo $_GET['id'] ?>,<?php echo $member_id ?>);
        })
    </script>
<?php }else{?>
    <script>
        $(function () {
            $('.intercom-reply , .reply').click(function () {
                $('#Modal_log').modal('toggle');
            },function () {
                $('#Modal_log').modal('toggle');
            })
        })
    </script>
<?php }?>

<div class="intercom-frame" >
    <div id="intercom-container">
        <div class="intercom-reply">
            <div class="intercom-launcher-open-icon"></div>
            <div class="intercom-launcher-close-icon"></div>
        </div>
    </div>
</div>

<div id="footer-full" class=" col-xs-12">
    <div class="bottom">
        <a>Admin</a>
    </div>
    <div class="copyright">Powered by Admin ©2015 Admin.com</div>
</div>

<?php include_once 'inc/desk_footer.inc.php'?>

