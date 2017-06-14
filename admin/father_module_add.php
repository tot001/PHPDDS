<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$template=array("title"=>"添加父板块",
    "keywords"=>"添加父板块",
    "description"=>"添加父板块",
    "css"=>array('style/index.css','style/module_add.css'));;
?>

<?php include_once 'inc/header.inc.php'; ?>

<div class="container-fluid ">
    <div class="row ">
        <div class="col-sm-1 col-md-10 " id="main">
            <div class="title">添加父板块</div>
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
                        <td><input class="module_name" name="module_name" type="text" /></td>
                        <td>
                            板块名称不能为空(66)
                        </td>
                    </tr>
                    <tr>
                        <td>排序</td>
                        <td><input class="sort" name="sort" type="number" /></td>
                        <td>
                            填写数字
                        </td>
                    </tr>
                </table>
                <input class="btn btn-primary btn-sm my_add" type="submit" name="submit" value="确定" />
            </form>
        </div>
    </div>


    <div class="row">
        <div class="my_Alert" >
            <?php
            if (isset($_POST['submit'])){
                $check_flag='add';
                include_once 'inc/module_add_check.inc.php';
                $query="insert into am_father_module(module_name,sort) VALUES ('{$_POST['module_name']}',{$_POST['sort']})";
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

<?php include_once 'inc/footer.inc.php'; ?>


