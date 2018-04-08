<?php
require './COMMON/function.php';

require './COMMON/zhanqun.php';

set_time_limit(0); //响应时间  

$date = $_POST;

$rebun =$date['rebun'];


$oldurl = curPageURL();

$zqurll = preg_replace('/one.php/','',$oldurl);


if($rebun == 2){

   $result = '1';

   $shuju = '数据获取成功';

   $newsdate = zqDate($date);

$godate = serialize($newsdate);

   if(empty($date['zqname'])){

          $zqname = '未定义';

   }else{

          $zqname = $date['zqname'];

   }

}else
{
$zqname = $date['zqname'];	

//生成数据	
$newsdate = zqDate($date);

$godate = serialize($newsdate);


//保存数据
$path = './CONFIG/';

$result = zqDkflies($newsdate,$path,$zqname);
	# code...

if($result){
	$shuju = '数据保存成功';
}else{
	$shuju = '数据保存不成功';
}


}

?>


<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>站群管理系统</title>
		<link rel="stylesheet" href="./../STYLE/css/index.css" />
	</head>

	<body>
		<div class="z_index">
			<h1>第二步、生成参数选择</h1>
			<form action="two.php" method="post" id="form">
				<div class="z_form">
					<ul>
						<li><span>*</span>数据是否记录成功：<?php  echo "<strong style='color:red; '>".$shuju."</strong>"; ?>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name = 'typename' value = '<?php echo $zqname ?>';  disabled="disabled"></li>
						<li><span>*</span>生成方式： <input type="radio" name="catalog" value="1" checked>文章
							<input type="radio" name="catalog" value="2" >目录  &nbsp;&nbsp;&nbsp;&nbsp;
						</li>
                        <li>
                            <span>*</span>数据源接口： <input type="text" name="z_api" value=""> 数据源接口地址 &nbsp;&nbsp;&nbsp;&nbsp;
                        </li>
						<li><span>*</span>生成层次： <input type="radio" name="arrangement" value="1" checked>1-2层
							<input type="radio" name="arrangement" value="2">1层
							<input type="radio" name="arrangement" value="3">2层
						</li>
						<li><span>*</span>标题选择：  <input type="radio" name="bttype" value="4" checked>7-3模式&nbsp;&nbsp;&nbsp;&nbsp;
						</li>
						<li><span>*</span>页面生成控制关键词：
							<input type="radio" name="keys" value="1" checked>带关键词
							<input type="radio" name="keys" value="2">不带关键词
						</li>
						<li><span>*</span>网站目录模板选择：
							<input type="radio" name="mulu" value="1" checked>目录模板1
							<input type="radio" name="mulu" value="2" >目录模板2
							&nbsp;&nbsp;&nbsp;&nbsp;（目录模板，每套对应2套模板,模板资源还未完善）
						</li>
						<li><span>*</span>网站文件模板选择：
							<input type="radio" name="wj" value="1" checked>文件模板1
							<input type="radio" name="wj" value="2" >文件模板2
							&nbsp;&nbsp;&nbsp;&nbsp;（文件模板，每套对应2套模板,模板资源还未完善）
						</li>
						<li><span>*</span>当前域名： <input type="text" name="zqurll" value="<?php echo $zqurll ?>" ></li>
						<li><span>*</span>文章生成数量 ：
							<input type="text" name="txtsub" value='10'>&nbsp;&nbsp;&nbsp;&nbsp;（目前最多10篇，不要随意更改，数量太长的话，对服务器压力很大。20*10 = 200篇 生成时间大约在60s）
						</li>

						<li class="z_sub">
							<input type="text" value='<?php echo $godate; ?>' name ='date' style="display: none;">
							<input type="submit" value="提交" />
						</li>
						<div style='margin-top:15px; color: red;'>温馨提示：功能还未成熟完善、代码未进行优化，数据接口功能还未开发，该版本处于测试阶段，如在使用过程中出现问题，请及时反馈，未经允许请不要随意转赠它人，违者必究。</div>
					</ul>
				</div>
			</form>
		</div>
	</body>

</html>

