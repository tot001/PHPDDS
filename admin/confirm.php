<?php
include_once '../inc/config.inc.php';
include_once '../inc/tool.inc.php';
if (!isset($_GET['Message'])||!isset($_GET['DeUrl'])||!isset($_GET['RtUrl'])){
    exit();
}
?>
<style>
    button.btn-danger a{
        color: #ffffff!important;
    }
    .modal-body{
        color: #b92c28;
        font-size: 16px;
    }
</style>


<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">
        &times;
    </button>
    <h3 class="modal-title" id="myModalLabel" style="font-size: 17px;font-weight: bold">
        是否删除<?php echo $_GET['Plate']?>板块?
    </h3>
</div>
<div class="modal-body">
    板块名为: <?php echo $_GET['Message']?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default myAlert " data-dismiss="modal">
        <a  href="#" >确定</a>
    </button>
    <script>
        $(document).ready(function(){

            $('.myAlert').click(function () {

            $.ajax({
                type: "GET",
                url: "<?php echo $_GET['DeUrl']?>",
                dataType: "html",
                timeout: 2000,
                cache: false,
                success: function (data) {
                    var my_Alert = $('.my_Alert').html();
                    var pattern=/success/gi;
                    var DATA=data;
                    $('.my_Alert').html(my_Alert + data);
                    if (pattern.test(DATA)){
                        setTimeout(function () {
                            window.location.reload();
                        },500);
                    }
                }
                });
            });


        });
    </script>
    <button type="button" class="btn btn-danger " data-dismiss="modal">
        <a href="<?php echo $_GET['RtUrl']?>">关闭</a>
    </button>
</div>


