<?php
header("content-type:text/html;charset=utf-8");
$dns="mysql:host=127.0.0.1;dbname=mm";
$pdo=new PDO($dns,"root","root");
$pdo->query('set names utf8');
$curl = curl_init();
// 设置你需要抓取的URL
curl_setopt($curl, CURLOPT_URL, 'http://www.ifeng.com');
// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// 运行cURL，请求网页
$strCon = curl_exec($curl);
// 关闭URL请求
curl_close($curl);
$arr=array();
$ary=array();
$reg='#<div id="headLineDefault">(.*)</div>#isU';
preg_match_all($reg,$strCon,$arr);
//print_r($arr);
$r='#<a href="(.*)" target="_blank">(.*)</a>#isU';
preg_match_all($r,$arr[1][0],$ary);
foreach($ary[1] as $k=>&$v){
    $sql="insert into cc set title='{$ary[2][$k]}',url='{$v}'";
    $ar=$pdo->exec($sql);
    if(!$ar){
        echo '错误';
    }
}
//ddddddddkdhkdldldpdpdpe
?>