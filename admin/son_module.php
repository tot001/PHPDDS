<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$template=array("title"=>"子板块列表",
    "keywords"=>"子板块列表",
    "description"=>"子板块列表",
    "css"=>array('style/index.css'));
?>

<?php include_once 'inc/header.inc.php'; ?>

<?php
if (isset($_POST['submit'])){
    foreach ($_POST['sort'] as $key=>$val){
        if (!is_numeric($key) || !is_numeric($val)){
            AlertSort("danger","#","Failure","");
        }
        $query[]="update sm_son_module set sort={$val} WHERE id={$key}";
    }
    if (execute_multi($link,$query,$error)){
        AlertSort("success","father_module.php",'Success','Successfully');
    }else{
        AlertSort("danger","#","Failure","");
    };
}
?>


    <div class="container-fluid ">
        <div class="row ">
            <div class="col-sm-1 col-md-10 " id="main">
                <div class="title">子板块列表</div>
                <form method="post">
                <table class="list">
                    <tr>
                        <th>排序</th>
                        <th>版块名称</th>
                        <th>所属父版块</th>
                        <th>版主</th>
                        <th>操作</th>
                    </tr>

                    <?php
                    $query='select ssm.sort,ssm.id,ssm.module_name,ssm.member_id,afm.module_name father_module_name from  sm_son_module ssm,am_father_module afm WHERE ssm.father_module_id=afm.id ORDER BY afm.id';
                    $result=execute($link,$query);
                    while ($data=mysqli_fetch_assoc($result)){
                        $DeUrl=urlencode("son_module_delete.php?id={$data['id']}");
                        $RtUrl=urlencode($_SERVER['REQUEST_URI']);
                        $Message="{$data['module_name']}";
                        $Plate="子";
                        $Confirm_url="confirm.php?DeUrl={$DeUrl}&RtUrl={$RtUrl}&Message={$Message}&Plate={$Plate}";
                        $Update_url="son_module_update.php?id={$data['id']}&Message={$Message}";
                        $Fsort=<<<A
                <tr>
                    <td><input class="sort" type="text" name="sort[{$data['id']}]" value="{$data['sort']}" /></td>
                    <td>{$data['module_name']}[id:{$data['id']}]</td>
                    <td>{$data['father_module_name']}</td>
                    <td>{$data['member_id']}</td>
                    <td>
                        <a href="#">[访问]</a>&nbsp;
                        <a  href="{$Update_url}">[编辑]</a>&nbsp;
                        <a  data-toggle="modal" data-target="#ConModal"  href="$Confirm_url">[删除]</a>
                    </td>
                </tr>
A;

                        echo $Fsort;
                    };
                    ?>
                </table>
                <input class="btn btn-primary btn-sm " type="submit" name="submit" value="排序" />
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ConModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>

    <div class="row">
        <div class="my_Alert" ></div>
    </div>

    <div class="row">
        <div id="Alert_sort" class="alert " >
            <a href="" id="sort_url" class="close" data-dismiss="alert">&times;</a>
            <strong id="sort_st"></strong> <span id="sort_sps"></span>
        </div>
    </div>


<?php include_once 'inc/footer.inc.php'?>