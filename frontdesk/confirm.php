<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
$_GET['Message']=htmlspecialchars($_GET['Message']);
if (!isset($_GET['Message'])||!isset($_GET['RtUrl'])||!isset($_GET['DeUrl'])||!isset($_GET['action'])){
    exit();
}
?>
<style>
    button.btn-danger a{
        color: #ffffff!important;
    }
    .modal-body{
        text-align: center;
        font-size: 16px;
    }
    .modal-body p{
        padding: 40px 60px 20px 60px;
        vertical-align: middle;
        min-width: 9em;
    }
    .modal-footer{
        padding-bottom: 20px;
        text-align: center;
        border: none;
    }
    .modal-footer button{
        margin: 0 10px;
        width: 70px;
    }
</style>


<div class="modal-header " style="border-bottom: 1px solid #ddd; ">
    <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">
        &times;
    </button>
    <h3 class="modal-title" id="myModalLabel" style="font-size: 17px;font-weight: bold">
       Define <?php echo $_GET['action']?>
    </h3>
</div>
<div class="modal-body">
    <p>是否删除: <?php echo $_GET['Message']?></p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default myAlert " data-dismiss="modal">
        <a  href="#" >确定</a>
    </button>
    <script>
        $(function(){
            var str="<?php echo $_GET['DeUrl']?>",
                n_data_v=$('.n-data-v').html(),
                Num=parseInt(str.match(/\d+/g));
            $('.myAlert').on('click',function () {
                $.ajax({
                    type:'GET',
                    dataType:'json',
                    url:"<?php echo $_GET['DeUrl']?>",
                    cache:false,
                    timeout: 2000,
                    success:function (msg) {
                        var p_n=$('.p-n');
                        if(msg.status == true){
                            $('#item'+Num).remove();
                            $('.n-data-v').html(parseInt(n_data_v)-1);
                        }
                        $('.prompt').show(function () {
                            p_n.html(msg.msgs);
                        });
                    }
                })
            });
        });
    </script>
    <button type="button" class="btn btn-danger " data-dismiss="modal">
        <a href="<?php echo $_GET['RtUrl']?>">关闭</a>
    </button>
</div>


