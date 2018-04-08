
<?php
require './COMMON/function.php';

set_time_limit(0); //响应时间  

if(empty($_POST['resours'])){
      exit;
}

$datename = $_POST['resours'];

$flies = $datename.'.php';

$path = './CONFIG/';

$oldresult = zxqMb($flies,$path);

if($oldresult){

$oldresult = unserialize($oldresult);

$str = '';

$zimu = array(
	0 => 'a',
	1 => 'b',
	2 => 'c',
	3 => 'd',
	4 => 'e',
	5 => 'f',
	6 => 'g',
	7 => 'h',
	8 => 'i',
	9 => 'j',
	10=> 'k',
	11 => 'l',
	12 => 'm',
	13 => 'n',
	14 => 'o',
	15 => 'p',
	16 => 'q',
	17 => 'r',
	18 => 's',
	19 => 't',
);

foreach ($oldresult as $key => $value) {
	$aa = 'zqurl'.$zimu[$key];
	$cc = 'zqadd'.$zimu[$key];
	$dd = 'zqgen'.$zimu[$key];

	# code...
	$str .= "<li><span>*</span>网站生成".$key."：域名：<input type='text' name='".$aa."' value='".$value[$aa]."'>&nbsp;&nbsp;|&nbsp;&nbsp;网站域名目录地址：<input type='text' name='".$cc."' value='".$value[$cc]."'>&nbsp;&nbsp;|&nbsp;&nbsp;网站根：<input type='text' name='".$dd."' value='".$value[$dd]."'></li>";
}

$str .= '</ul>';

$result['resultDate'] = $str;
$result['resultCode'] = 200;
$result['resours'] = $datename;

$result =  json_encode($result);

echo $result;

}else{
	
$result['resultCode'] = '输入的数据文档不存在';

echo $result;

}




?>