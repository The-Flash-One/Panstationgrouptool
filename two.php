<?php

require './COMMON/function.php';

require './COMMON/zhanqun.php';

header("Content-type: text/html; charset=utf-8");
date_default_timezone_set("Asia/Hong_Kong");
set_time_limit(0); //响应时间  
//1、接受数据

$date = $_POST;

//对数据进行规划处理 
$zadate = unserialize($date['date']);

//获取当前域名$zpurl，链接$zpadd，栏目$zqgen

// 一、开始生成数据,获取文章的数据信息 ----------------------------------------------------------------

//形成url链接地址

//1级栏目 http://127.0.0.1/随机目录/suiji数.html
//2级栏目 http://127.0.0.1/随机目录/随机目录/suiji数.html

$zqtype = $date['catalog'];  //开启文章还是目录 

$zqnub = $date['arrangement']; //生成的层次

$zqbttype = $date['bttype'];  //生成模式 7-3模式

$zqml = $date['mulu'];  //目录模板

$zqwj = $date['wj'];  //文件模板

$zqnum = $date['txtsub'];  //生成的文章数量

$keys = $date['keys'];  //关键词

$zqurll = $date['zqurll']; //url

$zqapi = $date['z_api'];

//1、获取文章标题和数据


$path = './RESOURCE/';

/*--------------------------------------------- */

//获取关键词

$flieskd = 'keywords.txt';

$kd = readFiles($flieskd, $path);

$keywords = zxqKw($kd, $zqnum);

//获取副标题

$fliesbfu = 'fbt.txt';

$btfu = readFiles($fliesbfu, $path);

$futitle = getrand($zqnum, $btfu);


//获取主标题

$fliesbzhu = 'tbt.txt';

$btzhu = readFiles($fliesbzhu, $path);

$ftitlet = getrandfbt($zqnum, $btzhu);


/*--------------------------------------------- */
//生成标题

if (!empty($zqapi)) {

    //获取数据
    $date = array(
        'id' => '1',
        'username' => 'admin',
        'password' => 'admin456',
        'num' => $zqnum,
    );
    $resources = post_date($zqapi, $date);
    $resources = json_decode($resources);
    $resources = object_array($resources);

    $oldt = $resources['title'];
    $oldc = $resources['content'];
    $oldi = $resources['images'];

    //获取关键词标题
    $oldtitle = getrand($zqnum, $kd);

//1、获取文章标题和数据
    for ($i = 1; $i <= $zqnum; $i++) {
        //获取文章标题
        $randnumb = rand(1, 10);
        if ($randnumb > 7) {
            $title[$i - 1] = $oldt[$i - 1];
        } else {
            $title[$i - 1] = $oldtitle[$i - 1];
        }
    }

    //2、获取匹配百度内容
    $baiducontent = baiduCon($oldt);

//3、获取图片地址
    $pic = $oldi;
//4、获取随机内容
    $content = $oldc;


} else {

    $title = array();
//获取标题数据

    $fliesbt = 'bt.txt';

    $bt = readFiles($fliesbt, $path);

    $oldtitle = getrand($zqnum, $bt);

    //获取关键词标题

    $oldtitle = getrand($zqnum, $kd);

    for ($i = 1; $i <= $zqnum; $i++) {

        //获取文章标题
        $randnumb = rand(1, 10);

        if ($randnumb > 7) {

            $title[$i - 1] = $oldtitle[$i - 1];

        } else {

            $title[$i - 1] = $oldtitle[$i - 1];

        }

    }
//2、获取匹配百度内容

    $baiducontent = baiduCon($oldtitle);

//获取图片地址

    $fliespic = 'pic.txt';

    $bpic = readFiles($fliespic, $path);

    $pic = getrandpic($zqnum, $bpic);

//获取随机内容

    $fliestx = 'txt.txt';

    $jz = readFiles($fliestx, $path);

//内容处理

    $content = zxqTXT($jz, $zqnum, $pic);


}


// print_r($keywords);

//获取网站的url 

//1级栏目 http://127.0.0.1/随机目录/suiji数.html
//2级栏目 http://127.0.0.1/随机目录/随机目录/suiji数.html

//域名：$urlindex

//域名目录：$indexml

//自定义目录  $indexadd

//url数量  $zqnum

//目录层次 $zqnub

//目录url
$result = array();

$resulturl = zqUrlindex($zadate, $zqnum, $zqnub, $zqtype, $zqml, $zqwj, $keys);

//资源整合


$zqresurce = zqresourceNew($title, $futitle, $ftitlet, $pic, $content, $keywords, $zqnum, $zqnub, $zqtype, $zqml, $zqwj, $keys, $zqurll, $baiducontent);

//数据合并

$result = $resulturl;

$result['resource'] = $zqresurce;


//判断对应目录模板

if ($zqtype == 2) {  //判断是目录


    $wjmb = zxqMlType($zqml); //判断目录模板


} else { //判断是文章


    $wjmb = zxqWjType($zqwj);

}


$addresswj = './MOBAN/'; //目录地址


$mbtype = zxqMb($wjmb, $addresswj); //抓取模板数据


$newtype = zqMaoban($result, $mbtype, $resulturl);


$mkdir = zqMkdir($newtype);


foreach ($mkdir as $key => $value) {


    foreach ($value as $k => $v) {

        if ($v !== 0) {
            echo $v . "创建成功<br/>";
        } else {
            echo $v . "创建失败<br/>";
        }

        # code...
    }

}

//创建sitemap.txt


$sitemap = zqmkFlies($resulturl);

foreach ($sitemap as $key => $value) {
    # code...

    echo $value;

}

//创建入口文件

$indextxt = zqmkIndexdir($newtype);

foreach ($indextxt as $key => $value) {
    # code...

    echo $value;

}

//生成index.html

$indexhtml = zqHtmldir($resulturl, $zqurll);

foreach ($indexhtml as $key => $value) {
    # code...

    echo $value;

}


//2、处理数据


//3、生成数据


//4、分析数据


//5、生成内容


//6、创建文档


//7、完成


?>