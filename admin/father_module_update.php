<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
include_once '../inc/tool.inc.php';
$template=array("title"=>"父板块-修改",
    "keywords"=>"父板块列表",
    "description"=>"父板块列表",
    "css"=>array('style/index.css','style/module_add.css'));
$link=connect();
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header("Location: http://localhost/DDS/admin/404.php");
    exit();
}
$query="select * from am_father_module where id={$_GET['id']}";
$result=execute($link,$query);
if (!mysqli_num_rows($result)){
    header("Location: http://localhost/DDS/admin/404.php");
    exit();
}
$data=mysqli_fetch_assoc($result);

?>
<?php include_once 'inc/header.inc.php'?>
<div class="container-fluid ">
    <div class="row ">
        <div class="col-sm-1 col-md-10 " id="main">
            <div class="title">修改父板块</div>
            <table class="list">
                <tr>
                    <th>版块名称</th>
                    <th>操作</th>
                    <th>详细</th>
                </tr>
            </table>
            <form method="post">
                <table class="au">
                    <tr>
                        <td>版块名称</td>
                        <td><input class="module_name" value="<?php echo $data['module_name']; ?>" name="module_name" type="text" /></td>
                        <td>
                            板块名称不能为空(66)
                        </td>
                    </tr>
                    <tr>
                        <td>排序</td>
                        <td><input class="sort" name="sort" value="<?php echo $data['sort']; ?>" type="number" /></td>
                        <td>
                            填写数字
                        </td>
                    </tr>
                </table>
                <input class="btn btn-primary btn-sm my_add" type="submit" name="submit" value="确定" />
                    <a href="javascript:history.back()" class="cancel">
                        <button class="btn btn-primary btn-sm " type="button">取消</button>
                    </a>
            </form>
        </div>

        <div class="row">
            <div class="my_Alert" >
                <?php
                if (isset($_POST['submit'])){
                    $check_flag='update';
                    include_once 'inc/module_add_check.inc.php';
                    $query="update am_father_module set module_name='{$_POST['module_name']}',sort={$_POST['sort']} where id={$_GET['id']}";
                    Dexecute($link,$query);
                    if (mysqli_affected_rows($link)==1){
                        myAlert("info","father_module.php",'Success','Successfully POST');
                    }else{
                        myAlert("danger","#",'Failure','Failed To POST');
                    }
                }
                ?>
            </div>
        </div>

    </div>
    </div>
</div>


    <?php include_once 'inc/footer.inc.php'?>
