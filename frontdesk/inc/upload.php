<?php
/**
 * Created by PhpStorm.
 * User: TOT
 * Date: 2017/8/15
 * Time: 16:13
 */
header("Content-type:text/html;charset=utf-8");

function upload($upload_max_filesize){
    $data=array();

    $phpini=ini_get('upload_max_filesize');
    $phpini_unit=strtoupper(substr($phpini,-1));
    $phpini_num=substr($phpini,0,-1);
    $phpini_multiple=get_multiple($phpini_unit);
    $phpini_bytes=$phpini_multiple*$phpini_num;

    $custom_unit=strtoupper(substr($upload_max_filesize,-1));
    $custom_num=substr($upload_max_filesize,0,-1);
    $custom_multiple=get_multiple($custom_unit);
    $custom_bytes=$custom_multiple*$custom_num;

    if ($custom_bytes>$phpini_bytes){
        $data['error']='$upload_max_filesize大于PHP配置文件的值';
        $data['return']=false;
        return $data;
    }
    $data['return']=true;
    return $data;

}

function get_multiple($unit){
    switch ($unit){
        case 'K':
            $multiple=1024;
            return $multiple;
        case 'M':
            $multiple=1024*1024;
            return $multiple;
        case 'G':
            $multiple=1024*1024*1024;
            return $multiple;
        default:
            return false;
    }
}

upload('2M');

?>