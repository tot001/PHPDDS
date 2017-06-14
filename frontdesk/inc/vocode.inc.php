<?php
function vcode($width=120,$height=40,$fontSize=20,$countLine=2){
    header('Content-type:image/jpeg');
    $img=imagecreatetruecolor($width,$height);
    $element=array('a','b','c','d','e','f','g','h','i','j','k','n','m','o','p','q','l','y','z');
    $str='';
    for ($i=0;$i<rand(4,5);$i++){
        $str.=$element[rand(0,count($element)-1)];
    }

    //rand()随机
//    $colorBg=imagecolorallocate($img,rand(200,255),rand(200,255),rand(200,255));
    $colorBg=imagecolorallocate($img,25,25,29);
    $colorCg=imagecolorallocate($img,rand(80,200),rand(50,170),rand(70,200));
    $colorSl=imagecolorallocate($img,rand(50,200),rand(40,180),rand(54,171));

    imagefill($img,0,0,$colorBg);

    //imagerectangle($img,10,10,50,20,$colorCg);//imagerectangle()画一个矩形

    for ($i=0;$i<100;$i++){
        imagesetpixel($img,rand(0,$width-1),rand(0,$height-1),$colorSl);//画一像素
    }
    for($i=0;$i<$countLine;$i++){
        imageline($img,rand(0,$width/2),rand(0,$height),rand($width/2,$width),rand(0,$height),$colorSl);
    }
    //imagestring($img,15,rand($width/5,$width/3),rand($height/3,$height/4),'asdf',$colorCg);

    imagettftext($img,$fontSize,rand(5,5),rand($width/6,$width/5),rand($height-5,$height*0.8),$colorCg,'font/ManyGifts.ttf',$str);

    imagejpeg($img);
    imagedestroy($img);
    return $str;
}
?>