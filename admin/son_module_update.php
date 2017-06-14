<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$template=array("title"=>"子板块-修改",
    "keywords"=>"子板块列表",
    "description"=>"子板块列表",
    "css"=>array('style/index.css','style/module_add.css'));
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header("Location: http://localhost/DDS/admin/404.php");
    exit();
}

$query="select * from sm_son_module where id={$_GET['id']}";
$result=execute($link,$query);
$data=mysqli_fetch_assoc($result);
if (!mysqli_num_rows($result)){
    header("Location: http://localhost/DDS/admin/404.php");
    exit();
}
?>
<?php include_once 'inc/header.inc.php'; ?>
<div class="container-fluid ">
    <div class="row ">
        <div class="col-sm-1 col-md-10 " id="main">
            <div class="title">修改子板块-<?php echo $data['module_name'] ?></div>
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
                        <td>所属父板块</td>
                        <td>
                            <select name="father_module_id" id="">
<!--                                <option value="0">--请选择父版块--</option>-->
                                <?php
                                    $query="select * from am_father_module";
                                    $result_father=execute($link,$query);
                                    while ($data_father=mysqli_fetch_assoc($result_father)){
                                        if ($data_father['id']==$data['father_module_id']){
                                            echo "<option selected='selected' value='{$data_father['id']}'>{$data_father['module_name']}</option>";
                                        }else{
                                            echo "<option value='{$data_father['id']}'>{$data_father['module_name']}</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            选择所属父板块
                        </td>
                    </tr>
                    <tr>
                        <td>版块名称</td>
                        <td><input class="module_name" name="module_name" type="text" value="<?php echo $data['module_name']?>" /></td>
                        <td>
                            板块名称不能为空(66)
                        </td>
                    </tr>
                    <tr>
                        <td>版块简介</td>
                        <td>
                            <textarea name="info"><?php echo $data['info']?></textarea>
                        </td>
                        <td>
                            简介不得多于255个字符
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td>版主</td>
                        <td>
                            <select name="member_id">
                                <option value="0">选择一个会员作为版主</option>

                            </select>
                        </td>
                        <td>
                            可以边选一个会员作为版主
                        </td>
                    </tr>
                    <tr>
                        <td>排序</td>
                        <td><input class="sort" name="sort" type="number" value="<?php echo $data['sort']?>"/></td>
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
    </div>


    <div class="row">
        <div class="my_Alert" >
            <?php
            if (isset($_POST['submit'])){
                $check_flag='update';
                include_once 'inc/check_son_module.inc.php';
                $query="update sm_son_module set father_module_id={$_POST['father_module_id']},module_name='{$_POST['module_name']}',info='{$_POST['info']}',member_id={$_POST['member_id']},sort={$_POST['sort']} where id={$_GET['id']}";
                Dexecute($link,$query);
//                execute($link,$query);
                if (mysqli_affected_rows($link)==1){
                    myAlert("info","son_module.php",'Success','Successfully POST');
                }else{
                    myAlert("danger","#",'Failure','Failed To POST');
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include_once 'inc/footer.inc.php'; ?>
