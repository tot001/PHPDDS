<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$template=array("title"=>"子板块列表",
    "keywords"=>"子板块列表",
    "description"=>"子板块列表",
    "css"=>array('style/index.css','style/module_add.css'));
?>
<?php include_once 'inc/header.inc.php'; ?>
<div class="container-fluid ">
    <div class="row ">
        <div class="col-sm-1 col-md-10 " id="main">
            <div class="title">添加子板块</div>
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
                                <option value="0">--请选择父版块--</option>
                                <?php
                                    $query="select * from am_father_module";
                                    $result_father=execute($link,$query);
                                    while ($data=mysqli_fetch_assoc($result_father)){
                                        echo "<option value='{$data['id']}'>{$data['module_name']}</option>";
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
                        <td><input class="module_name" name="module_name" type="text" /></td>
                        <td>
                            板块名称不能为空(66)
                        </td>
                    </tr>
                    <tr>
                        <td>版块简介</td>
                        <td>
                            <textarea name="info"></textarea>
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
                include_once 'inc/check_son_module.inc.php';
                $query="insert into sm_son_module(father_module_id,module_name,info,member_id,sort) VALUES ({$_POST['father_module_id']},'{$_POST['module_name']}','{$_POST['info']}',{$_POST['member_id']},{$_POST['sort']})";
                Dexecute($link,$query);
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

<!--if (isset($_POST['submit'])){-->
<!--$query="insert into sm_son_module(father_module_id,module_name,info,member_id,sort) VALUES ({$_POST['father_module_id']},'{$_POST['module_name']}','{$_POST['info']}',{$_POST['member_id']},{$_POST['sort']})";-->
<!--echo $query;-->
<!--execute($link,$query);-->
<!--exit();-->
<!--}-->