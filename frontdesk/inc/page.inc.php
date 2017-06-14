<?php
/*
调用：$page=page(100,10,9);
返回值：array('limit','html')

$count：总记录数
$page_num：每页显示的记录数
$num_btn：要展示的页码按钮数目
$page：分页的get参数
*/
function page($count,$page_num,$num_btn=5,$page='page'){
    if (!isset($_GET[$page]) || !is_numeric($_GET[$page]) || $_GET[$page]<1){
        $_GET[$page]=1;
    };
    if($count==0){
        $data=array(
            'limit'=>'',
            'html'=>''
        );
        return $data;
    }
    //总页数
    $page_all=ceil($count/$page_num);
    if ($_GET[$page]>$page_all){
        $_GET[$page]=$page_all;
    }
    $start=($_GET[$page]-1)*$page_num;
    $limit="limit {$start},{$page_num}";
    //url
    $current_url=$_SERVER['REQUEST_URI'];//获取当前url地址
    $current_arr=parse_url($current_url);//将当前url拆分到数组里面
    $current_path=$current_arr['path'];//将文件路径部分保存起来
    $url='';
    if (isset($current_arr['query'])){
        parse_str($current_arr['query'],$arr_query);
        unset($arr_query[$page]);
        if (empty($arr_query)){
            $url="{$current_path}?{$page}=";
        }else{
            $other=http_build_query($arr_query);
            $url="{$current_path}?{$other}&{$page}=";
        }
    }else{
        $url="{$current_path}?{$page}=";
    }
    $html=array();
    if ($num_btn>=$page_all){
        //把所有的页码按钮全部显示
       for ($i=1;$i<=$page_all;$i++){
           //这边的$page_num_all是限制循环次数以控制显示按钮数目的变量,$i是记录页码号
           if ($i==$_GET[$page]){
               $html[$i]="<li class='disabled'><a>{$i}</a></li>";
           }else{
               $html[$i]="<li><a href='{$url}{$i}'>{$i}</a></li>";
           }
       }
    }else{
        $num_left=floor(($num_btn-1)/2);
        $start=$_GET[$page]-$num_left;
        $end=$start+($num_btn-1);
        if ($start<1){
            $start=1;
        }
        if ($end>$page_all){
            $start=$page_all-($num_btn-1);
        }
        for ($i=0;$i<$num_btn;$i++){
            if ($_GET[$page]==$start){
                $html[$start]="<li class='disabled'><a>{$start}</a></li>";
            }else{
                $html[$start]="<li><a href='{$url}{$start}'>{$start}</a></li>";
            }
            $start++;
        }
    }
    //如果按钮数目大于等于3的时候做省略号效果
    if (count($html)>=3){
        reset($html);
        $key_first=key($html);
        end($html);
        $key_end=key($html);
        if ($key_first!=1){
            array_shift($html);//删除数组第一个值
            array_unshift($html,"<li><a href='{$url}1'>1...</a></li>");
        }
        if ($key_end!=$page_all){
            array_pop($html);
            array_push($html,"<li><a href='{$url}{$page_all}'>...{$page_all}</a></li>");
        }
    }
    //上下页
    if($_GET[$page]!=1){
        $prev=$_GET[$page]-1;
        array_unshift($html,"<li class='previous'><a href='{$url}{$prev}'>&laquo; Older</a></li>");
    }else{
        $prev=1;
        array_unshift($html,"<li class='previous'><a href='{$url}{$prev}'>&laquo; Older&nbsp;&nbsp;</a></li>");
    }

    if($_GET[$page]!=$page_all){
        $next=$_GET[$page]+1;
        array_push($html,"<li class='next'><a href='{$url}{$next}'>&nbsp;&nbsp;Newer &raquo;</a></li>");
    }else{
        $next=$page_all;
        array_unshift($html,"<li class='next'><a href='{$url}{$next}'>&nbsp;&nbsp;Newer &raquo;</a></li>");
    }
    $html=implode(' ',$html);
    $data=array(
        'limit'=>$limit,
        'html'=>$html
    );
    return $data;
}
?>