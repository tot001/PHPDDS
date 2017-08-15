
<?php if (!$member_id){?>
<div class="modal fade" id="Modal_log" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">
                    &times;
                </button>
                <h3 class="modal-title" id="myModalLabel" style="font-size: 17px;font-weight: bold">
                    Login
                </h3>
            </div>
            <div class="modal-body">
                    <div class="head_content">
                        <div class="pos_con">
                            <form id="log_form" method="post" class="form-horizontal" action="">
                                <div class="row logAlert">
                                    <label  class="col-lg-4 col-sm-4 col-xs-0 control-label"></label>
                                    <div class="col-lg-4 col-sm-4 col-xs-12" style="text-align: center">
                                        <span id="logAlert" class="glyphicon glyphicon-remove-circle"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mename" class="col-lg-4 col-sm-4 col-xs-3 control-label">账号</label>
                                    <div class=" col-lg-5  col-sm-5 ">
                                        <input type="text"  class="form-control" id="mename" name="mename" placeholder="Usename" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mepw" class="col-lg-4 col-sm-4 col-xs-3 control-label">密码</label>
                                    <div class="col-lg-5 col-sm-5 ">
                                        <input type="password" class="form-control" id="mepw" name="mepw" placeholder="Password" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mevocode" class="col-lg-4 col-sm-4 col-xs-12 control-label">验证码</label>
                                    <div class="col-lg-3 col-sm-3 col-xs-7">
                                        <input type="text" maxlength="10" class="form-control " id="mevocode" name="mevocode" placeholder="Vocode">
                                    </div>
                                    <div >
                                        <img class="vcode " src="show_vcode.php" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox col-sm-offset-4">
                                        <label class="control-label remember checkbox-inline">
                                            <input  type="checkbox" id="metime" name="metime" value="259200"> Remember me
                                            <input  type="checkbox" id="metime1" name="metime" value="86400" style="display: none">
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-2 ">
                                        <input class="btn  center-block btn_xs"  name="mesubmit" type="submit" value="Login In" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php }?>
<script src="js/login.js"></script>



</body>
</html>
