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
            echo "<link rel='stylesheet' type='text/css' href='{$val}'/></br>";
        }
    ?>
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--    <script src="../dist/js/bootstrap.min.js"></script>-->
<!--    <script>-->
<!--        lless = {env: "development", async: false, fileAsync: false,poll: 1000, functions: {}, dumpLineNumbers: "comments", relativeUrls: false, rootpath: ""};-->
<!--    </script>-->
<!--    <script src="http://cdn.bootcss.com/less.js/1.7.0/less.min.js"></script>-->
    <?php
    if (isset($template['js'])){
        foreach ($template['js'] as $val){
            echo "<script src='{$val}'></script>";
        }
    }
    ?>

</head>
<body>
<div class=" navbar navbar-default navbar-fixed-top  navbar-inverse" role="navigation">
    <div class="container">
            <nav id="header">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-nav-coll-2">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php" >Admin</a>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">首页</a></li>
                    </ul>
                </div>
                <div class=" collapse navbar-collapse " id="bs-nav-coll-2" >
                    <form class="nav navbar-nav navbar-form navbar-left ">
                        <div class="form-group">
                            <input class="form-control keyword" type="text" name="keyword" placeholder="搜索其实很简单" />
                            <button class=" submit" type="submit" name="submit" value="" >
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (!is_login($link)){?>
                            <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> 注册</a></li>
                            <li><a href="" id="login" data-toggle="modal" data-target="#Modal_log"><span  class="glyphicon glyphicon-log-in "></span> 登录</a></li>
                        <?php } else{?>
                            <li><a href="member.php?id=<?php echo $member_id?>" class="Avatar"><img src="style/photo.jpg"></a></li>
                            <li><a href="index.php" id="logout"><span  class="glyphicon glyphicon-log-in "></span> Logout</a></li>
                        <?php }?>
                    </ul>
                </div>
            </nav>
    </div>
</div>
<div style="margin-top:30px;"></div>

