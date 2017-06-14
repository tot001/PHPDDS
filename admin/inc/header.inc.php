<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="keywords" content="<?php echo $template['keywords']?>">
    <meta name="description" content="<?php echo $template['description']?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $template['title']?></title>
    <link rel="stylesheet" href="../dist/css/bootstrap.css">
    <?php
        foreach ($template['css'] as $val){
            echo "<link rel='stylesheet' type='text/css' href='{$val}'/>";
        }
    ?>
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/father_module.js"></script>

    <style>
        .navbar-brand{
            color:#ff877f!important;
            font-weight: bold;
        }
        .navbar-inverse ,
        .navbar-toggle{
            border-color: #ffffff!important;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row ">
        <nav  class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-nav-coll-1">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand " href="father_module.php" >Admin</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-nav-coll-1">
                <div class="nav navbar-nav navbar-right" >
                    <li><a href=""><span class="glyphicon glyphicon-log-out "></span> [注销] admin &nbsp;&nbsp;</a></li>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="#">Video</a></li>
                    <li><a href="#">Image</a></li>
                    <li><a href="#">Voice</a></li>
                </ul>
            </div>

        </nav>
    </div>
</div>
<div class="container-fluid">
<div class="row " style="padding-top: 60px;">
    <div class=" col-md-2 col-sm-2 col-xs-5 " id="sidebar">
        <ul class="sidebar_ul">
            <li class="sidebar_li">
                <div class="small_title">系统</div>
                <ul class="child">
                    <li><a class="current" href="#">系统信息</a></li>
                    <li><a href="#">管理员</a></li>
                    <li><a href="#">添加管理员</a></li>
                    <li><a href="#">站点设置</a></li>
                </ul>
            </li>

            <li class="sidebar_li">
                <div class="small_title">内容管理</div>
                <ul class="child">
                    <?php
                    function crent($name){
                        if (basename($_SERVER['SCRIPT_NAME']) == $name) {
                            echo "class='current'";
                        }
                    };
                    ?>
                    <li><a <?php crent('father_module.php')?> href="father_module.php">父板块列表</a></li>
                    <?php
                    if (basename($_SERVER['SCRIPT_NAME']) == 'father_module_update.php') {
                        echo '<li><a class="current">修改父板块列表</a></li>';
                    };
                    ?>
                    <li><a <?php crent('father_module_add.php')?> href="father_module_add.php">添加父板块</a></li>
                    <li><a <?php crent('son_module.php')?> href="son_module.php">子板块列表</a></li>
                    <?php
                    if (basename($_SERVER['SCRIPT_NAME']) == 'son_module_update.php') {
                        echo '<li><a class="current">修改子板块列表</a></li>';
                    };
                    ?>
                    <li><a <?php crent('son_module_add.php')?> href="son_module_add.php">添加子板块</a></li>
                    <li><a href="#">帖子管理</a></li>
                </ul>
            </li>

            <li class="sidebar_li">
                <div class="small_title">用户管理</div>
                <ul class="child">
                    <li><a href="#">用户列表</a></li>
                </ul>
            </li>
        </ul>

    </div>
</div>
</div>