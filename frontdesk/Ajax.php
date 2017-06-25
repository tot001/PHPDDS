<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$member_id=is_login($link);
$action=$_GET['action'];

if ($action=='member') {
    $value=escape($link,htmlspecialchars(trim($_POST['val'])));
    $query="UPDATE sm_member SET signature = '{$value}' WHERE id={$_GET['id']}";
     execute($link,$query);

}elseif ($action=='delete'){
    $query="select member_id from sm_content WHERE id={$_GET['id']}";
    $result_con=execute($link,$query);
    if(mysqli_num_rows($result_con)==1) {
        $data_con = mysqli_fetch_assoc($result_con);
        if (check_user($member_id, $data_con['member_id'])) {
            $query = "delete from sm_content WHERE id={$_GET['id']}";
            execute($link, $query);
            if (mysqli_affected_rows($link) == 1) {
                $arr['msgs']='成功删除!';
                $arr['status']=true;
                echo json_encode($arr);
            }else {
                $arr['msgs']='删除失败!';
                $arr['status']=false;
                echo json_encode($arr);
            }
        }else{
            $arr['msgs']='没有权限!';
            $arr['status']=false;
            $arr['id']=$_GET['id'];
            echo json_encode($arr);
        }
    }else{
        skip($_GET['RtUrl'],'帖子不存在!');
    }
}

?>
