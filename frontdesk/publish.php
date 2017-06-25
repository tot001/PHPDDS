<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
include_once '../inc/tool.inc.php';


$template=array("title"=>"publish",
    "keywords"=>"publish",
    "description"=>"publish",
    "css"=>array('style/public.css','style/publish.css'),
    "js"=>array('js/publish.js'));

$link=connect();

if(!$member_id=is_login($link)){
    if (isset($_SERVER['HTTP_REFERER'])){
        $url=$_SERVER['HTTP_REFERER'];
        skip($url,'Please sign in');
    }else{
        skip('index.php','Please sign in');
    }
    exit();
}

if (isset($_POST['submit'])){
    include 'inc/publish_check.inc.php';
    $_POST=escape($link,$_POST);
    $query="insert into sm_content(module_id,title,content,time,member_id) values({$_POST['module_id']},'{$_POST['title']}','{$_POST['content']}',now(),{$member_id})";
    execute($link, $query);
    if(mysqli_affected_rows($link)==1){
        skip('publish.php',"",'发布成功');
    }else{
        skip('publish.php',"",'发布失败');
        exit();
    }
}



?>

<?php include_once 'inc/desk_header.inc.php' ?>

<div class="container">
    <ol class="breadcrumb">
        <li><a href="index.php"  class="glyphicon glyphicon-home">Home</a></li>
        <li class="active">Publish</li>
    </ol>
    <div id="publish" class="col-lg-11 col-xs-12">
        <form id="" method="post" class="form-horizontal" action="">
            <div class="form-group">
                <div class="col-lg-5 col-sm-5">
                    <select class="form-control " name="module_id" id="module_id">

                        <?php
                        if (isset($_GET['ft_id']) && is_numeric($_GET['ft_id'])){
                            $where="where id={$_GET['ft_id']}";
                        }
                        $query="select * from am_father_module {$where} order by sort desc";
                        $result_father=execute($link, $query);
                        while ($data_father=mysqli_fetch_assoc($result_father)){
                            echo "<optgroup label='{$data_father['module_name']}'>";
                            $query="select * from sm_son_module where father_module_id={$data_father['id']} order by sort desc";
                            $result_son=execute($link, $query);
                            while ($data_son=mysqli_fetch_assoc($result_son)){
                                if (isset($_GET['module_id']) && $_GET['module_id']==$data_son['id']){
                                    echo "<option selected='selected' value='{$data_son['id']}'>{$data_son['module_name']}</option>";
                                }else{
                                    echo "<option value='{$data_son['id']}'>{$data_son['module_name']}</option>";
                                }
                            }
                            echo "</optgroup>";
                        }
                       ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class=" col-lg-6 col-sm-8">
                    <input type="text"  class="form-control " id="title" name="title" placeholder="Title" >
                </div>
            </div>

            <div class="form-group ">
                <div class="col-lg-8  col-sm-12">
                    <textarea name="content" class="form-control " id="content" cols="30" rows="10" ></textarea>
                </div>
            </div>

            <div class="form-group ">
                <div class=" col-sm-12">
                    <input class="btn btn-primary btn-sh"  name="submit" type="submit" value="发布" />
                </div>
            </div>
        </form>
    </div>
    <div id="footer" class="col-lg-11 col-xs-12">
        <div class="bottom">
            <a>Admin</a>
        </div>
        <div class="copyright">Powered by Admin ©2015 Admin.com</div>
    </div>
</div>


<?php include_once 'inc/desk_footer.inc.php'?>
