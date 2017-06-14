<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$member_id=is_login($link);

$template=array("title"=>"index",
    "keywords"=>"index",
    "description"=>"index",
    "css"=>array('style/public.css','style/index.css'),
    "js"=>array(''));

?>

<?php include_once 'inc/desk_header.inc.php' ?>
<div class="container">
    <div id="ix_content">
        <div id="hot" class="auto">
            <div class="title">热门动态</div>
            <ul class="newlist">
                <li><a href="#">[库队]</a> <a href="#">私房库实战项目录制中...</a></li>
            </ul>
            <div style="clear:both;"></div>
        </div>
    </div>


    <?php
        $query="select * from am_father_module ORDER BY sort DESC";
        $result_father=execute($link,$query);
        while ($data_father=mysqli_fetch_assoc($result_father)){
    ?>
        <div class="box auto">
            <div class="title">
                <a href="list_father.php?id=<?php echo $data_father['id']?>"><?php echo $data_father['module_name']?></a>
            </div>
            <div class="classList">
                <?php
                    $query="select * from sm_son_module where father_module_id={$data_father['id']}";
                    $result_son=execute($link, $query);
                    if(mysqli_num_rows($result_son)){
                        while ($data_son=mysqli_fetch_assoc($result_son)){
                            $query="select count(*) from sm_content where module_id={$data_son['id']} and time > CURDATE()";
                            $count_today=num($link,$query);
                            $query="select count(*) from sm_content where module_id={$data_son['id']}";
                            $count_all=num($link,$query);
                            $html=<<<A
					<div class="childBox new col-lg-3 col-md-3 col-sm-4  col-xs-12">
						<h2><a href="list_son.php?id={$data_son['id']}">{$data_son['module_name']}</a> </h2>
						<span>帖子：{$count_all}</span>
						<span class="count_new">(今日{$count_today})</span>
						<br />
					</div>
A;
                            echo $html;
                        }
                    }else{
                        echo '<div style="padding:10px 0;">暂无子版块...</div>';
                    }
                ?>
                    <div style="clear:both;"></div>
            </div>
        </div>

    <?php } ?>



    <div id="footer" class="col-xs-12">
        <div class="bottom">
            <a>Admin</a>
        </div>
        <div class="copyright">Powered by Admin ©2015 Admin.com</div>
    </div>
</div>


<?php include_once 'inc/desk_footer.inc.php'?>
