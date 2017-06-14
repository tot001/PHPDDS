<?php
include_once "../inc/config.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>404</title>
	<style type="text/css">
        body{
            margin: 0;
            background-color: #67ace4;
            font-family: "\5FAE\8F6F\96C5\9ED1";
        }
		.wrap{
			margin: 100px auto 0;
			width: 399px;
		}
        .text{
            text-align: center;
            padding-top: 20px;
        }
        .text strong {
            display: inline-block;
            font-size: 14px;
            font-weight: normal;
        }
        .text span{
            width: 128px;
            height: 29px;
        }
        .text a{
            line-height: 14px;
            color: #fff;
            text-decoration: none;
            padding: 6px 14px;
            margin: 1px 0 0 10px;
            border: 1px solid #fff;
            border-radius: 14px;
            user-select: none;
            -webkit-user-select: none;
            -webkit-tap-highlight-color: rgba(0,0,0,0);
            transition: 0.2s ease-out;
            -o-transition: 0.2s ease-out;
            -moz-transition: 0.2s ease-out;
            -webkit-transition: 0.2s ease-out;
        }
        .text a:hover{
            background: #95ccf9;
            color: #565353;
        }
        .animate{
            animation: 20s animate linear infinite alternate;
            -o-animation: 20s animate linear infinite alternate;
            -moz-animation: 20s animate linear infinite alternate;
            -webkit-animation: 20s animate linear infinite alternate;
        }
        .below, .above{position: absolute; bottom: 0; left: 0; z-index: -1; width: 100%;}
        .below{height: 173px; background: url(style/below.png) no-repeat;}
        .above{height: 149px; background: url(style/above.png) no-repeat -60px 0;
            animation-name: animate-above;
            -o-animation-name: animate-above;
            -moz-animation-name: animate-above;
            -webkit-animation-name: animate-above;
        }
        @keyframes animate{
            0%{background-position: 0 0;}
            10%{background-position: -10px 1px;}
            20%{background-position: -10px 3px;}
            30%{background-position: -20px 1px;}
            40%{background-position: -40px 2px;}
            50%{background-position: -60px 4px;}
            60%{background-position: -40px 2px;}
            70%{background-position: -20px 4px;}
            80%{background-position: -10px 3px;}
            90%{background-position: -10px 1px;}
            100%{background-position: 0 0;}
        }
        @-o-keyframes animate{
            0%{background-position: 0 0;}
            10%{background-position: -10px 1px;}
            20%{background-position: -10px 3px;}
            30%{background-position: -20px 1px;}
            40%{background-position: -40px 2px;}
            50%{background-position: -60px 4px;}
            60%{background-position: -40px 2px;}
            70%{background-position: -20px 4px;}
            80%{background-position: -10px 3px;}
            90%{background-position: -10px 1px;}
            100%{background-position: 0 0;}
        }
        @-moz-keyframes animate{
            0%{background-position: 0 0;}
            10%{background-position: -10px 1px;}
            20%{background-position: -10px 3px;}
            30%{background-position: -20px 1px;}
            40%{background-position: -40px 2px;}
            50%{background-position: -60px 4px;}
            60%{background-position: -40px 2px;}
            70%{background-position: -20px 4px;}
            80%{background-position: -10px 3px;}
            90%{background-position: -10px 1px;}
            100%{background-position: 0 0;}
        }
        @-webkit-keyframes animate{
            0%{background-position: 0 0;}
            10%{background-position: -10px 1px;}
            20%{background-position: -10px 3px;}
            30%{background-position: -20px 1px;}
            40%{background-position: -40px 2px;}
            50%{background-position: -60px 4px;}
            60%{background-position: -40px 2px;}
            70%{background-position: -20px 4px;}
            80%{background-position: -10px 3px;}
            90%{background-position: -10px 1px;}
            100%{background-position: 0 0;}
        }
        @keyframes animate-above{
            0%{background-position: -60px 0;}
            10%{background-position: -50px 8px;}
            20%{background-position: -35px 10px;}
            30%{background-position: -20px 10px;}
            40%{background-position: -30px 16px;}
            50%{background-position: -10px 20px;}
            60%{background-position: -20px 20px;}
            70%{background-position: -30px 12px;}
            80%{background-position: -40px 10px;}
            90%{background-position: -50px 10px;}
            100%{background-position: -60px 0;}
        }
        @-o-keyframes animate-above{
            0%{background-position: -60px 0;}
            10%{background-position: -50px 8px;}
            20%{background-position: -35px 10px;}
            30%{background-position: -20px 10px;}
            40%{background-position: -30px 16px;}
            50%{background-position: -10px 20px;}
            60%{background-position: -20px 20px;}
            70%{background-position: -30px 12px;}
            80%{background-position: -40px 10px;}
            90%{background-position: -50px 10px;}
            100%{background-position: -60px 0;}
        }
        @-moz-keyframes animate-above{
            0%{background-position: -60px 0;}
            10%{background-position: -50px 8px;}
            20%{background-position: -35px 10px;}
            30%{background-position: -20px 10px;}
            40%{background-position: -30px 16px;}
            50%{background-position: -10px 20px;}
            60%{background-position: -20px 20px;}
            70%{background-position: -30px 12px;}
            80%{background-position: -40px 10px;}
            90%{background-position: -50px 10px;}
            100%{background-position: -60px 0;}
        }
        @-webkit-keyframes animate-above{
            0%{background-position: -60px 0;}
            10%{background-position: -50px 8px;}
            20%{background-position: -35px 10px;}
            30%{background-position: -20px 10px;}
            40%{background-position: -30px 16px;}
            50%{background-position: -10px 20px;}
            60%{background-position: -20px 20px;}
            70%{background-position: -30px 12px;}
            80%{background-position: -40px 10px;}
            90%{background-position: -50px 10px;}
            100%{background-position: -60px 0;}
        }
	</style>
</head>
<body>
	<div class="wrap">
  		<div class="lens">
  			<img src="style/404.png" alt="404">
  		</div>
        <div class="text">
            <strong>
                <span></span>
<!--                <a href="father_module.php">返回首页</a>-->
                <a href="javascript:history.back()">返回上一页</a>
            </strong>
        </div>
 		 <div class="menu"></div>
	</div>
    <div class="animate below"></div>
    <div class="animate above"></div>
</body>
</html>