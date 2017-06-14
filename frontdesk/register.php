<?php
include_once '../inc/config.inc.php';
include_once '../inc/msql.inc.php';
include_once '../inc/tool.inc.php';
include_once 'Text input.php';
$link=connect();
$template=array("title"=>"注册会员",
    "keywords"=>"注册会员",
    "description"=>"注册会员",
    "css"=>array('style/public.css','style/register.css'),
    "js"=>array('js/register.js'));

if ($member_id=is_login($link)){
    skip('index.php','你已经登陆');exit();
}
if(isset($_POST['submit'])){
    include_once 'inc/register_check.inc.php';
    $query="insert into sm_member(name,pw,register_time) values('{$_POST['name']}',md5('{$_POST['pw']}'),now())";
    execute($link,$query);
    if (mysqli_affected_rows($link)==1){
        setcookie('member[name]',$_POST['name']);
        setcookie('member[pw]',sha1(md5($_POST['pw'])));
        skip('index.php','注册成功');
    }
}
?>
<?php include_once'inc/desk_header.inc.php' ?>
    <script>
        $(document).ready(function () {
            register_ajax();
        })
    </script>

<div class="container">
        <div id="register" class=" col-xs-12">
            <h2>欢迎注册成为 Admin会员</h2>
            <form id="reg_form" method="post" class="form-horizontal" action="#">
                <div class="form-group">
                    <label for="name" class=" col-sm-3 control-label">账号</label>
                    <div class="col-sm-3">
                        <input type="text"  class="form-control" id="name" name="name" placeholder="Usename" >
                    </div>
                  <span  id="userinfo">*账号不得为空，并且长度不得超过32个字符</span>
                </div>
                <div class="form-group">
                    <label for="pw" class=" col-sm-3 control-label">密码</label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control" id="pw" name="pw" placeholder="Password" >
                    </div>
                    <span>*密码不得少于6位</span>
                </div>
                <div class="form-group">
                    <label for="confirm_pw" class=" col-sm-3 control-label">确认密码</label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control" id="confirm_pw" name="confirm_pw" placeholder="Confirm" >
                    </div>
                    <span>*请输入与上面一致</span>
                </div>
                <div class="form-group">
                    <label for="pw" class=" col-sm-3 control-label">验证码</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control " id="vocode" name="vocode" placeholder="Vocode">
                    </div>
                    <span id="codeinfo">*请输入验证码</span>
                </div>
                <div class="form-group">
                    <div  class="col-sm-offset-3 col-sm-3">
                        <img class="vcode " src="show_vcode.php" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-3">
                        <input class="btn btn-primary btn-sm"  name="submit" type="submit" value="确定注册" />
                    </div>
                </div>
            </form>
        </div>
        <div id="footer" class=" col-xs-12">
            <div class="bottom">
                <a>Admin</a>
            </div>
            <div class="copyright">Powered by Admin ©2015 Admin.com</div>
        </div>
</div>


<?php include_once 'inc/desk_footer.inc.php'?>