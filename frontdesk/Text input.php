<?php
function skip($url,$str){
    $html=<<<A
<!DOCTYPE html>
<html>
<head>
	<title>正在跳转中</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="3;URL={$url}" />
<script id="jqbb" src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
	<style type="text/css">
@import url("http://fonts.googleapis.com/css?family=Inconsolata:700");
body {
  background-color: #111;
  color: #f5f5f5;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  height: 100vh;
}
p {
  font-family: Inconsolata, Source Code Pro, Consolas, monospace;
  margin-left: calc(50vw - 6em);
  font-size: 20px;
  font-weight: bold;
}
	</style>
</head>
<body>
	<script type="text/javascript">
var prefix = '';
var skills = [
    '{$str}'
].map(function (s) { return s + "."; });
var delay = 2;
var step = 1;
var tail = 5;
var timeout = 75;
var p = document.createElement('p');
document.body.appendChild(p);
var colors = [
    "rgb(110,64,170)",
    "rgb(150,61,179)",
    "rgb(191,60,175)",
    "rgb(228,65,157)",
    "rgb(254,75,131)",
    "rgb(255,94,99)",
    "rgb(255,120,71)",
    "rgb(251,150,51)",
    "rgb(226,183,47)",
    "rgb(198,214,60)",
    "rgb(175,240,91)",
    "rgb(127,246,88)",
    "rgb(82,246,103)",
    "rgb(48,239,130)",
    "rgb(29,223,163)",
    "rgb(26,199,194)",
    "rgb(35,171,216)",
    "rgb(54,140,225)",
    "rgb(76,110,219)",
    "rgb(96,84,200)",
];
function getRandomColor() {
    return colors[Math.floor(Math.random() * colors.length)];
}
function getRandomChar() {
    return String.fromCharCode(Math.random() * (127 - 33) + 33);
}
function getRandomColoredString(n) {
    var fragment = document.createDocumentFragment();
    for (var i = 0; i < n; i++) {
        var char = document.createElement('span');
        char.textContent = getRandomChar();
        char.style.color = getRandomColor();
        fragment.appendChild(char);
    }
    return fragment;
}
/** Global State */
var $ = {
    text: '',
    prefixP: -tail,
    skillI: 0,
    skillP: 0,
    direction: 'forward',
    delay: delay,
    step: step
};
function render() {
    var skill = skills[$.skillI];
    if ($.step) {
        $.step--;
    }
    else {
        $.step = step;
        if ($.prefixP < prefix.length) {
            if ($.prefixP >= 0) {
                $.text += prefix[$.prefixP];
            }
            $.prefixP++;
        }
        else {
            if ($.direction === 'forward') {
                if ($.skillP < skill.length) {
                    $.text += skill[$.skillP];
                    $.skillP++;
                }
                else {
                    if ($.delay) {
                        $.delay--;
                    }
                    else {
                        $.direction = 'backward';
                        $.delay = delay;
                    }
                }
            }
        }
    }
    p.textContent = $.text;
    p.appendChild(getRandomColoredString($.prefixP < prefix.length ?
        Math.min(tail, tail + $.prefixP) :
        Math.min(tail, skill.length - $.skillP)));
    setTimeout(render, timeout);
}
setTimeout(render, 500);
	</script>
</body>
</html>
A;
    echo $html;
    exit();
};

?>

