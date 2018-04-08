<?php
//获取当前url路径
function curPageURL()
{
    $pageURL = 'http';

    if (@$_SERVER['HTTPS'] == 'on') {
        $pageURL .= "s";
    }
    $pageURL .= "://";

    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function curURL()
{
    $pageURL = 'http';

    if (@$_SERVER['HTTPS'] == 'on') {
        $pageURL .= "s";
    }
    $pageURL .= "://";

    $pageURL = $pageURL . $_SERVER['HTTP_HOST'] . '/';

    return $pageURL;

}


//读取文件夹内容
function readFiles($files, $path)
{

    $str = '';

    $file_path = $path . $files;
    // echo $file_path;
    if (file_exists($file_path)) {
        $str = file_get_contents($file_path);
        $str = mb_convert_encoding($str, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');

        $str = explode("\n", $str);//explode()函数以","为标识符进行拆分
        foreach ($str as $k => $v) {
            $val = trimall($v);
            if (empty($val)) {
                unset($str[$k]);
            } else {
                $date[$k]['content'] = $val;
            }

        }
        return $str;
    }

}

function zxqTXT($txt, $number, $pic = null)
{  //$txt 内容数据,$number内容篇数

    $content = array();

    for ($i = 0; $i < $number; $i++) {

        $nub = rand(30, 45);

        $bug = rand(4, $nub - 3);

        $result = getrand($nub, $txt);

        $cont = '';

        foreach ($result as $key => $value) {

            if (!empty($pic) && $key == 0) {

                $cont .= "<p style='text-aglin:center;'><img src='" . $pic[$i][0] . "'  alt='\$标题\$' rel='nofllow'></p>";

            }

            $cont .= '<p>' . $value . '</p>';

            if (!empty($pic) && $key == $bug) {

                $cont .= "<p style='text-aglin:center;'><img src='" . $pic[$i][1] . "'  alt='\$标题\$' rel='nofllow'></p>";

            }


            //  $cont .= '11'.$value.'11';

        }

        $content[$i] = $cont;

    }
    return $content;

}

//清楚空格等段落
function trimall($str)//删除空格
{
    $qian = array(" ", "　", "\t", "\n", "\r", '\0', '\t');
    $hou = array("", "", "", "", "", "", "", "");
    return str_replace($qian, $hou, $str);
}

//随机数

function randpw($len = 8, $format = 'ALL')
{
    $is_abc = $is_numer = 0;
    $password = $tmp = '';
    switch ($format) {
        case 'ALL':
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
        case 'CHAR':
            $chars = 'abcdefghijklmnopqrstuvwxyz';
            break;
        case 'NUMBER':
            $chars = '0123456789';
            break;
        default :
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
    }

    while (strlen($password) < $len) {
        $tmp = substr($chars, (mt_rand() % strlen($chars)), 1);
        if (($is_numer <> 1 && is_numeric($tmp) && $tmp > 0) || $format == 'CHAR') {
            $is_numer = 1;
        }
        if (($is_abc <> 1 && preg_match('/[a-zA-Z]/', $tmp)) || $format == 'NUMBER') {
            $is_abc = 1;
        }
        $password .= $tmp;
    }
    if ($is_numer <> 1 || $is_abc <> 1 || empty($password)) {
        $password = randpw($len, $format);
    }
    return $password;
}

//获取数据标题
function getrand($number, $date)
{

    shuffle($date);//利用shuffle()函数将产生的$num数组随机打乱顺序

    $result = array_slice($date, 0, $number);

    return $result;

}

//获取图片地址

function getrandpic($number, $date)
{

    $numb = $number * 2;

    shuffle($date);//利用shuffle()函数将产生的$num数组随机打乱顺序

    $result = array_slice($date, 0, $numb);

    $picresult = array();

    for ($i = 1; $i < $number + 1; $i++) {
        $k = 2 * $i - 2;
        $picresult[$i - 1]['0'] = $result[$k];
        $picresult[$i - 1]['1'] = $result[$k + 1];
        # code...
    }

    return $picresult;

}


//获取网站主标题
function getrandfbt($number, $date)
{

    shuffle($date);


    for ($i = 0; $i < $number; $i++) {

        if (empty($date[$i])) {

            $result[$i] = $date[$j];


        } else {

            $result[$i] = $date[$i];

            $j = $i;
        }

    }


    return $result;

}


//生成随机链接
function newUrl($url, $nub, $num, $zdml)
{ //$url 当前链接 $nub目录层次（1、随机，2、1层、3、2层）,$num 生成数量 $kqml 是否开启目录
    $newurl = array();

    if ($nub == 2) {


        for ($i = 0; $i < $num; $i++) {
            $cnub = rand(3, 6);

            if (!empty($zdml)) {
                $urlrand = $zdml . '/';
            } else {
                $urlrand = randpw($cnub, 'CHAR') . '/';
            }


            $files = randpw(4, 'NUMBER') . $i . $cnub . ".html";
            $result = $url . $urlrand . $files;
            $newurl['url'][$i] = $result;
            $newurl['dir'][$i] = './' . $urlrand;
            $newurl['files'][$i] = $files;
        }


    } elseif ($nub == 3) {

        for ($i = 0; $i < $num; $i++) {
            $cnub = rand(3, 6);

            if (!empty($zdml)) {
                $urlrand = $zdml . '/' . randpw($cnub, 'CHAR') . '/';
            } else {
                $urlrand = randpw($cnub, 'CHAR') . '/' . randpw($cnub, 'CHAR') . '/';
            }


            $files = randpw(4, 'NUMBER') . $i . $cnub . ".html";
            $result = $url . $urlrand . $files;
            $newurl['url'][$i] = $result;
            $newurl['dir'][$i] = './' . $urlrand;
            $newurl['files'][$i] = $files;
        }

    } else {

        for ($i = 0; $i < $num; $i++) {
            $cnub = rand(3, 6);
            if ($cnub < 5) {

                if (!empty($zdml)) {
                    $urlrand = $zdml . '/';
                } else {
                    $urlrand = randpw($cnub, 'CHAR') . '/';
                }


                $files = randpw(4, 'NUMBER') . $i . $cnub . ".html";
                $result = $url . $urlrand . $files;

                $newurl['url'][$i] = $result;
                $newurl['dir'][$i] = './' . $urlrand;
                $newurl['files'][$i] = $files;

            } else {

                if (!empty($zdml)) {
                    $urlrand = $zdml . '/' . randpw($cnub, 'CHAR') . '/';
                } else {
                    $urlrand = randpw($cnub, 'CHAR') . '/' . randpw($cnub, 'CHAR') . '/';
                }

                $files = randpw(4, 'NUMBER') . $i . $cnub . ".html";
                $result = $url . $urlrand . $files;

                $newurl['url'][$i] = $result;
                $newurl['dir'][$i] = './' . $urlrand;
                $newurl['files'][$i] = $files;

            }

        }


    }

    return $newurl;

}

//生成随机链接
function newWlUrl($url, $nub, $num, $zdml)
{ //$url 当前链接 $nub目录层次（1、随机，2、1层、3、2层）,$num 生成数量 $kqml 是否开启目录
    $newurl = array();

    if ($nub == 2) {


        for ($i = 0; $i < $num; $i++) {
            $cnub = rand(3, 6);

            if (!empty($zdml)) {
                $urlrand = $zdml . '/';
            } else {
                $urlrand = randpw($cnub, 'CHAR') . '/';
            }

            $files = "index.html";
            $result = $url . $urlrand . $files;
            $result = $url . $urlrand . $files;
            $newurl['url'][$i] = $result;
            $newurl['dir'][$i] = './' . $urlrand;
            $newurl['files'][$i] = $files;
        }


    } elseif ($nub == 3) {

        for ($i = 0; $i < $num; $i++) {
            $cnub = rand(3, 6);

            if (!empty($zdml)) {
                $urlrand = $zdml . '/' . randpw($cnub, 'CHAR') . '/';
            } else {
                $urlrand = randpw($cnub, 'CHAR') . '/' . randpw($cnub, 'CHAR') . '/';
            }

            $files = "index.html";
            $result = $url . $urlrand . $files;
            $newurl['url'][$i] = $result;
            $newurl['dir'][$i] = './' . $urlrand;
            $newurl['files'][$i] = $files;
        }

    } else {

        for ($i = 0; $i < $num; $i++) {
            $cnub = rand(3, 6);
            if ($cnub < 5) {

                if (!empty($zdml)) {
                    $urlrand = $zdml . '/';
                } else {
                    $urlrand = randpw($cnub, 'CHAR') . '/';
                }
                $files = "index.html";
                $result = $url . $urlrand . $files;

                $newurl['url'][$i] = $result;
                $newurl['dir'][$i] = './' . $urlrand;
                $newurl['files'][$i] = $files;

            } else {

                if (!empty($zdml)) {
                    $urlrand = $zdml . '/' . randpw($cnub, 'CHAR') . '/';
                } else {
                    $urlrand = randpw($cnub, 'CHAR') . '/' . randpw($cnub, 'CHAR') . '/';
                }
                $files = "index.html";
                $result = $url . $urlrand . $files;

                $newurl['url'][$i] = $result;
                $newurl['dir'][$i] = './' . $urlrand;
                $newurl['files'][$i] = $files;

            }

        }


    }

    return $newurl;

}

/*'bt' => '';   //标题
   'jz' => '';   //句子
   'url' =>'';   //当前文章分配url
   'keywords' => ''; //当前关键词
   'yq'=>''; //友情链接
   'ml' => ''; //是否为目录
   'wmb' => ''; //文件模板
   'mmb' => '';  //目录模板
   'run' =>'';//开启自动生成
*/
function resourceNew($bt, $jz, $url, $keywords, $yq, $ml, $wmb, $mmb, $run, $index, $wq, $keys, $wl, $futitle, $ftitlet, $pic)
{

    foreach ($bt as $key => $value) {

        $result['resource'][$key]['bt'] = $value;
        $result['resource'][$key]['jz'] = $jz[$key];
        $result['resource'][$key]['url'] = $url['url'][$key];
        $result['resource'][$key]['keywords'] = $keywords[$key];
        $result['resource'][$key]['yq'] = $yq;
        $result['resource'][$key]['dir'] = $url['dir'][$key];
        $result['resource'][$key]['files'] = $url['files'][$key];
        $result['resource'][$key]['futitle'] = $futitle[$key];
        $result['resource'][$key]['ftitlet'] = $ftitlet[$key];
        $result['resource'][$key]['lpic'] = $pic[$key];


    }
    $result['ml'] = $ml;
    $result['wmb'] = $wmb;
    $result['mmb'] = $mmb;
    $result['run'] = $run;
    $result['index'] = $index;
    $result['wlyq'] = $wq;
    $result['keys'] = $keys;
    $result['wl'] = $wl;

    return $result;
}

//随机关键词

function zxqKw($txt, $number)
{  //$txt 内容数据,$number内容篇数

    $content = array();

    for ($i = 0; $i < $number; $i++) {

        $nub = rand(2, 4);

        $result = getrand($nub, $txt);

        $cont = '';

        foreach ($result as $key => $value) {

            //  $cont .= '<p>'.$value.'</p>';
            if ($key == 0) {
                $cont .= $value;
            } else {
                $cont .= ',' . $value;
            }

        }

        $content[$i] = $cont;

    }

    return $content;

}


function zxqYq($yq, $number)
{

    for ($i = 0; $i < $number; $i++) {

        $result = getrand(1, $yq);

        $content[$i] = $result;

    }

    return $content;
}

function zxqMb($files, $path)
{  //抓取模板数据，并生成相应的页面数据

    $str = '';
    $file_path = $path . $files;
    // echo $file_path;
    if (file_exists($file_path)) {
        $str = file_get_contents($file_path);
        $str = mb_convert_encoding($str, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');

        return $str;


    }
}

function zxqWjType($num)
{ //判断文件模板样式

    if ($num == 1) {
        $flies = 'mbwj1.txt';
    } else {
        $flies = 'mbwj2.txt';
    }

    return $flies;
}

function zxqMlType($num)
{ //判断目录模板样式

    if ($num == 1) {
        $flies = 'mbml1.txt';
    } else {
        $flies = 'mbml2.txt';
    }

    return $flies;
}

function zxqMoBan($subdate, $mbtype)
{  //文章栏目页面

    foreach ($subdate['resource'] as $key => $value) {


        //匹配句子

        $mbtypebt = preg_replace('/\$内容2\$/', $value['jz'], $mbtype);

        //匹配标题


        $mbtypebt = preg_replace('/\$标题\$/', $value['bt'], $mbtypebt);

        //匹配副标题

        $mbtypebt = preg_replace('/\$副站点名\$/', $value['futitle'], $mbtypebt);


        //匹配主标题

        $mbtypebt = preg_replace('/\$站点名\$/', $value['ftitlet'], $mbtypebt);


        //匹配关键词

        if ($subdate['keys'] == 1) {
            $mbtypebt = preg_replace('/\$关键词\$/', $value['keywords'], $mbtypebt);
        } else {
            $mbtypebt = preg_replace('/\$关键词\$/', '', $mbtypebt);
        }

        //当前url地址

        $mbtypebt = preg_replace('/\$当前链接\$/', $subdate['resource'][$key]['url'], $mbtypebt);

        //匹配时间

        $time = date('Y-m-d H:i:s', strtotime('+1minute'));

        $mbtypebt = preg_replace('/\$时间\$/', $time, $mbtypebt);


        //匹配图片

        if ($subdate['wmb'] == 1 && $subdate['ml'] == 1) {


            //匹配时间副标题
            for ($i = 1; $i < 7; $i++) {

                $fbt = '/\$副标题' . $i . '\$/';
                $fnl = '/\$内链' . $i . '\$/';

                $mbtypebt = preg_replace($fbt, $subdate['resource'][$i - 1]['bt'], $mbtypebt);
                $mbtypebt = preg_replace($fnl, $subdate['resource'][$i - 1]['url'], $mbtypebt);

            }
            //匹配时间随机时间


            for ($i = 1; $i < 7; $i++) {

                $min = '+' . $i . 'minute';

                $timesj = date('Y-m-d H:i:s', strtotime($min));

                $fsj = '/\$随机日期' . $i . '\$/';

                $mbtypebt = preg_replace($fsj, $timesj, $mbtypebt);


            }

            $pictxt = '';
            for ($i = 1; $i < 5; $i++) {

                $picnum = 5 + $i;

                $picbbt = $subdate['resource'][$picnum]['bt'];

                $picurl = $subdate['resource'][$picnum]['url'];

                $picpic = $subdate['resource'][$picnum]['lpic'][0];

                $pictxt .= "<dd>
         <a href='" . $picurl . "' target='_blank'><img src='" . $picpic . "' rel='nofllow' ><span>" . $picbbt . "</span></a>
          </dd>";

            }

            $mbtypebt = preg_replace('/\$图片列表\$/', $pictxt, $mbtypebt);


        } elseif ($subdate['wmb'] == 2 && $subdate['ml'] == 1) {


            //匹配时间副标题
            for ($i = 1; $i < 11; $i++) {

                $fbt = '/\$副标题' . $i . '\$/';
                $fnl = '/\$内链' . $i . '\$/';

                $mbtypebt = preg_replace($fbt, $subdate['resource'][$i - 1]['bt'], $mbtypebt);
                $mbtypebt = preg_replace($fnl, $subdate['resource'][$i - 1]['url'], $mbtypebt);

            }
            //匹配时间随机时间


            for ($i = 1; $i < 11; $i++) {

                $min = '+' . $i . 'minute';

                $timesj = date('Y-m-d H:i:s', strtotime($min));

                $fsj = '/\$随机日期' . $i . '\$/';

                $mbtypebt = preg_replace($fsj, $timesj, $mbtypebt);


            }

            //随机数据热点推荐

            //随机index数据

            $rdtopi = 10;

            $rdresult = zxqTopi($rdtopi);

            if ($rdresult) {

                $rd = '';

                for ($i = 0; $i < 6; $i++) {

                    $rd .= $rdresult[$i];

                }

                $mbtypebt = preg_replace('/\$热点推荐\$/', $rd, $mbtypebt);

            } else {

                //获取当前的url数据
                $rd = '';

                for ($i = 0; $i < 6; $i++) {

                    $rdbt = $subdate['resource'][$i]['bt'];

                    $rdurl = $subdate['resource'][$i]['url'];

                    $rdid = randpw($len = 4, $format = 'CHAR');


                    $rd .= " <li><a id='" . $rdid . "' href='" . $rdurl . "'>" . $rdbt . "</a></li>";

                }

                $mbtypebt = preg_replace('/\$热点推荐\$/', $rd, $mbtypebt);

            }


            //最新新闻

            $pictxt = '';
            for ($i = 1; $i < 5; $i++) {

                $picnum = 5 + $i;

                $picbbt = $subdate['resource'][$picnum]['bt'];

                $picurl = $subdate['resource'][$picnum]['url'];

                $picpic = $subdate['resource'][$picnum]['lpic'][0];

                $pictxt .= "<li>
         <a href='" . $picurl . "' target='_blank'><img src='" . $picpic . "' rel='nofllow' ><span style=' line-height:25px; height:50px;display:block; overflow:hidden;'>" . $picbbt . "</span></a>
          </li>";

            }

            $mbtypebt = preg_replace('/\$图片列表\$/', $pictxt, $mbtypebt);


            //实时报道

            $bdstopi = 10;

            $bdsresult = zxqTopi($bdstopi);

            if ($bdsresult) {

                $bds = '';

                for ($i = 0; $i < 6; $i++) {

                    $bds .= $bdsresult[$i];

                }

                $mbtypebt = preg_replace('/\$实时报道\$/', $bds, $mbtypebt);

            } else {

                //获取当前的url数据
                $bds = '';

                for ($i = 0; $i < 6; $i++) {

                    $bdsbt = $subdate['resource'][$i]['bt'];

                    $bdsurl = $subdate['resource'][$i]['url'];

                    $bdsid = randpw($len = 4, $format = 'CHAR');


                    $bds .= " <li><a id='" . $bdsid . "' href='" . $bdsurl . "'>" . $bdsbt . "</a></li>";

                }

                $mbtypebt = preg_replace('/\$实时报道\$/', $bds, $mbtypebt);

            }


        }


        //匹配图片

        if ($subdate['mmb'] == 1 && $subdate['ml'] == 2) {


            //匹配时间副标题
            for ($i = 1; $i < 7; $i++) {

                $fbt = '/\$副标题' . $i . '\$/';
                $fnl = '/\$内链' . $i . '\$/';

                $mbtypebt = preg_replace($fbt, $subdate['resource'][$i - 1]['bt'], $mbtypebt);
                $mbtypebt = preg_replace($fnl, $subdate['resource'][$i - 1]['url'], $mbtypebt);

            }
            //匹配时间随机时间


            for ($i = 1; $i < 7; $i++) {

                $min = '+' . $i . 'minute';

                $timesj = date('Y-m-d H:i:s', strtotime($min));

                $fsj = '/\$随机日期' . $i . '\$/';

                $mbtypebt = preg_replace($fsj, $timesj, $mbtypebt);


            }

            $pictxt = '';
            for ($i = 1; $i < 5; $i++) {

                $picnum = 5 + $i;

                $picbbt = $subdate['resource'][$picnum]['bt'];

                $picurl = $subdate['resource'][$picnum]['url'];

                $picpic = $subdate['resource'][$picnum]['lpic'][0];

                $pictxt .= "<dd>
         <a href='" . $picurl . "' target='_blank'><img src='" . $picpic . "' rel='nofllow' ><span>" . $picbbt . "</span></a>
          </dd>";

            }

            $mbtypebt = preg_replace('/\$图片列表\$/', $pictxt, $mbtypebt);


        } elseif ($subdate['wmb'] == 2 && $subdate['ml'] == 2) {

            //匹配时间副标题
            for ($i = 1; $i < 11; $i++) {

                $fbt = '/\$副标题' . $i . '\$/';
                $fnl = '/\$内链' . $i . '\$/';

                $mbtypebt = preg_replace($fbt, $subdate['resource'][$i - 1]['bt'], $mbtypebt);
                $mbtypebt = preg_replace($fnl, $subdate['resource'][$i - 1]['url'], $mbtypebt);

            }
            //匹配时间随机时间


            for ($i = 1; $i < 11; $i++) {

                $min = '+' . $i . 'minute';

                $timesj = date('Y-m-d H:i:s', strtotime($min));

                $fsj = '/\$随机日期' . $i . '\$/';

                $mbtypebt = preg_replace($fsj, $timesj, $mbtypebt);


            }

            //随机数据热点推荐

            //随机index数据

            $rdtopi = 10;

            $rdresult = zxqTopi($rdtopi);

            if ($rdresult) {

                $rd = '';

                for ($i = 0; $i < 6; $i++) {

                    $rd .= $rdresult[$i];

                }

                $mbtypebt = preg_replace('/\$热点推荐\$/', $rd, $mbtypebt);

            } else {

                //获取当前的url数据
                $rd = '';

                for ($i = 0; $i < 6; $i++) {

                    $rdbt = $subdate['resource'][$i]['bt'];

                    $rdurl = $subdate['resource'][$i]['url'];

                    $rdid = randpw($len = 4, $format = 'CHAR');


                    $rd .= " <li><a id='" . $rdid . "' href='" . $rdurl . "'>" . $rdbt . "</a></li>";

                }

                $mbtypebt = preg_replace('/\$热点推荐\$/', $rd, $mbtypebt);

            }


            //最新新闻

            $pictxt = '';
            for ($i = 1; $i < 5; $i++) {

                $picnum = 5 + $i;

                $picbbt = $subdate['resource'][$picnum]['bt'];

                $picurl = $subdate['resource'][$picnum]['url'];

                $picpic = $subdate['resource'][$picnum]['lpic'][0];

                $pictxt .= "<li>
         <a href='" . $picurl . "' target='_blank'><img src='" . $picpic . "' rel='nofllow' ><span style=' line-height:25px; height:50px; display:block;overflow:hidden;'>" . $picbbt . "</span></a>
          </li>";

            }

            $mbtypebt = preg_replace('/\$图片列表\$/', $pictxt, $mbtypebt);


            //实时报道

            $bdstopi = 10;

            $bdsresult = zxqTopi($bdstopi);

            if ($bdsresult) {

                $bds = '';

                for ($i = 0; $i < 6; $i++) {

                    $bds .= $bdsresult[$i];

                }

                $mbtypebt = preg_replace('/\$实时报道\$/', $bds, $mbtypebt);

            } else {

                //获取当前的url数据
                $bds = '';

                for ($i = 0; $i < 6; $i++) {

                    $bdsbt = $subdate['resource'][$i]['bt'];

                    $bdsurl = $subdate['resource'][$i]['url'];

                    $bdsid = randpw($len = 4, $format = 'CHAR');


                    $bds .= " <li><a id='" . $bdsid . "' href='" . $bdsurl . "'>" . $bdsbt . "</a></li>";

                }

                $mbtypebt = preg_replace('/\$实时报道\$/', $bds, $mbtypebt);

            }


        }

        //匹配外链
//     <a id='$干扰字符$' href='$外链16$'>$副标题16$</a>$随机日期16$</br>
        if ($subdate['wl'] == 1) { //外链wq等于1的时候生成外链

            $waili = '';

            $yqsub = $subdate['wlyq'] + 1;

            for ($i = 1; $i < $yqsub; $i++) {

                $wlmin = '+' . $i . 'minute';

                $wltimesj = date('Y-m-d H:i:s', strtotime($wlmin));

                $randid = randpw($len = 4, $format = 'CHAR');

                $randurl = $value['yq'][$i - 1];


                $randtitle = $subdate['resource'][$i - 1]['bt'];

                $waili .= "<a id='" . $randid . "' href='" . $randurl . "'>" . $randtitle . "</a>" . $wltimesj . "</br>";


            }

            $mbtypebt = preg_replace('/\$外链\$/', $waili, $mbtypebt);

        } else {

            $waili = '';

            $mbtypebt = preg_replace('/\$外链\$/', $waili, $mbtypebt);
        }

        //匹配干扰符号

        $ganraonum = preg_match_all('/\$干扰字符\$/', $mbtypebt, $ganraonum);

        for ($i = 0; $i < $ganraonum; $i++) {

            $ganrao = randpw($len = 4, $format = 'ALL');

            $mbtypebt = preg_replace('/\$干扰字符\$/', $ganrao, $mbtypebt, 1);

        }

        //推荐文章


        //随机index数据

        $topi = 6;

        $suijiresult = zxqTopi($topi);

        if ($suijiresult) {

            $suiji = '';

            for ($i = 0; $i < 6; $i++) {

                $suiji .= $suijiresult[$i];

            }

            $mbtypebt = preg_replace('/\$随机看看\$/', $suiji, $mbtypebt);

        } else {

            //获取当前的url数据
            $suiji = '';

            for ($i = 0; $i < 6; $i++) {

                $suijibt = $subdate['resource'][$i]['bt'];

                $suijiurl = $subdate['resource'][$i]['url'];

                $suijiid = randpw($len = 4, $format = 'CHAR');


                $suiji .= " <li><a id='" . $suijiid . "' href='" . $suijiurl . "'>" . $suijibt . "</a></li>";

            }

            $mbtypebt = preg_replace('/\$随机看看\$/', $suiji, $mbtypebt);

        }

        //匹配url域名指向首页

        $mbtypebt = preg_replace('/\$域名\$/', $subdate['index'], $mbtypebt);


        $result[$key]['mb'] = $mbtypebt;

        $result[$key]['url'] = $subdate['resource'][$key]['url'];
        $result[$key]['dir'] = $subdate['resource'][$key]['dir'];
        $result[$key]['files'] = $subdate['resource'][$key]['files'];

        $wmin = '+' . $key . 'minute';

        $ztimesj = date('Y-m-d H:i:s', strtotime($wmin));

        $result[$key]['index']['bt'] = $value['bt'];
        $result[$key]['index']['url'] = $subdate['resource'][$key]['url'];
        $result[$key]['index']['time'] = $ztimesj;

    }

    $result = serialize($result);

    return $result;


}

function zxqGwj($result)
{ //判断文件是否存在，如果不存在则创建


    $result = unserialize($result);

    foreach ($result as $key => $value) {
        $url = $value['url'];
        $dir = $value['dir'];
        $files = $value['files'];
        $paths = $dir . $files;

        $succdir = mkdirs_1($dir);

        if ($succdir == 1) {

            $myfile = fopen($paths, "w");

            $write = fwrite($myfile, $value['mb']) or die("Unable to open file!");

            if ($write) {

                $zhurl[$key] = $url;

            } else {

                $zhurl[$key] = 0;
            }

        }

    }
    fclose($myfile);

    return $zhurl;


}

function zxqGmb($result)
{ //判断文件是否存在，如果不存在则创建


    $result = unserialize($result);

    foreach ($result as $key => $value) {
        $url = $value['url'];
        $dir = $value['dir'];
        $files = $value['files'];
        $paths = $dir . $files;

        $succdir = mkdirs_1($dir);

        if ($succdir == 1) {

            $myfile = fopen($paths, "w");

            $write = fwrite($myfile, $value['mb']) or die("Unable to open file!");

            if ($write) {

                $zhurl[$key] = $url;

            } else {

                $zhurl[$key] = 0;
            }

        }

    }
    fclose($myfile);

    return $zhurl;


}


function mkdirs_1($path, $mode = 0777)
{ //创建目录
    if (is_dir($path)) {
        return 1;
    } else {
        if (mkdir($path, $mode, true)) {
            return 1;
        } else {
            return 0;
        }
    }
}


function mkFlies($sitemap, $date)
{

    $olddate = implode("\r\n", $date);

    $newdate = $olddate . " \r\n";

    $myfile = fopen($sitemap, "a");

    $write = fwrite($myfile, $newdate) or die("Unable to open file!");

    fclose($myfile);

    if ($write) {

        return 1;
    } else {

        return 0;
    }


}

function mkDirl($sitemap, $date)
{

    $olddate = implode("\r\n", $date);

    $newdate = $olddate . " \r\n";

    $date = preg_replace('/index.html/', '', $newdate);

    $myfile = fopen($sitemap, "a");

    $write = fwrite($myfile, $date) or die("Unable to open file!");

    fclose($myfile);

    if ($write) {

        return 1;
    } else {

        return 0;
    }


}


function zxqIndex($date)
{  //首页模板生成index.txt
    $date = unserialize($date);
    $result = '';
    //整理数据
    foreach ($date as $key => $value) {

        $url = $value['index']['url'];
        $title = $value['index']['bt'];
        $time = $value['index']['time'];

        $result .= "<li><a href='" . $url . "'>" . $title . "</a><span>" . $time . "</span></li> \r\n";

    }


    $paths = './index.txt';

    $myfile = fopen($paths, "a");

    $write = fwrite($myfile, $result) or die("Unable to open file!");

    fclose($myfile);

    if ($write) {

        return 1;
    } else {

        return 0;
    }

}

function zxqIndexdir($date)
{  //首页模板生成index.txt
    $date = unserialize($date);
    $result = '';
    //整理数据
    foreach ($date as $key => $value) {

        $url = $value['index']['url'];
        $title = $value['index']['bt'];
        $time = $value['index']['time'];

        $result .= "<li><a href='" . $url . "'>" . $title . "</a><span>" . $time . "</span></li> \r\n";

    }

    $result = preg_replace('/index.html/', '', $result);
    $paths = './index.txt';

    $myfile = fopen($paths, "a");

    $write = fwrite($myfile, $result) or die("Unable to open file!");

    fclose($myfile);

    if ($write) {

        return 1;
    } else {

        return 0;
    }

}

//抓取首页数据

function zxqTopi($num)
{


    $files = 'index.txt';
    $path = './';

    if (is_file($files)) {

        $index = readFiles($files, $path);

        $result = getrand($num, $index);

        return $result;

    } else {

        return 0;

    }


}


function zxqHtml($addresswj)
{

    $path = $addresswj;

    $files = 'index.txt';

    $index = zxqMb($files, $path);

    $pathi = './';

    $filesi = 'index.txt';

    $indexi = readFiles($filesi, $pathi);

    $olddate = getrand(120, $indexi);

    $newsdate = '';

    foreach ($olddate as $key => $value) {
        $newsdate .= $value;
    }

    $date = preg_replace('/\$首页链接\$/', $newsdate, $index);


    $indexpaths = './index-1.html';

    $myfile = fopen($indexpaths, "w");

    $write = fwrite($myfile, $date) or die("Unable to open file!");

    if ($write) {

        $result = 1;

    } else {

        $result = 0;
    }

    fclose($myfile);

    return $result;

}

function runTime($date)
{

    $date = serialize($date);

    $paths = './config.php';

    $myfile = fopen($paths, "w");

    $write = fwrite($myfile, $date) or die("Unable to open file!");

    fclose($myfile);

    if ($write) {

        return $result = 1;

    } else {

        return $result = 0;
    }


}


/*
*跳转
*@param $url 目标地址
*@param $info 提示信息
*@param $sec 等待时间
*return void
*/
function jump($url, $info = null, $sec = 3)
{
    if (is_null($info)) {
        header("Location:$url");
    } else {
        // header("Refersh:$sec;URL=$url");
        echo "<meta http-equiv=\"refresh\" content=" . $sec . ";URL=" . $url . ">";
        echo $info;
    }
    die;
}

//百度内容整理

function baiduCon($baidutitle)
{

    $baiducontent = array();
    foreach ($baidutitle as $key => $v) {

        $content = '';
        $match = array();

        $v = trimall($v);

        $bdurl = "http://www.baidu.com/s?wd=" . $v;//查询关键词的地址

        $source = file_get_contents($bdurl);//获取百度首页源码

        $source = strtolower($source);//全部转为小写

        $preg = '#<div class="c-abstract">(.*?)</div>#';//提取简介匹配规则

        preg_match_all($preg, $source, $match);//正则提取简介

        for ($i = 0; $i < 10; $i++) {
            if (empty($match[0][$i])) {
                break;
            }
            $content = $content . $match[0][$i];

        }

        $content = preg_replace("/(<a[^>]*>(.+?)<\/a>)/", "", $content);//删除超链接

        $baiducontent[$key] = $content;
    }

    return $baiducontent;

}

//curl数据提交

function post_date($url, $sl_data)
{

//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url);//要访问的地址
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//执行结果是否被返回，0是返回，1是不返回
//curl_setopt($ch, CURLOPT_POST, 1);// 发送一个常规的POST请求
//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($sl_data));

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $sl_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return = curl_exec($ch);

    if (curl_errno($ch)) {
        echo curl_error($ch);
    }

    curl_close($ch);
    return $return;

}


//判断对象
function object_array($array)
{
    if (is_object($array)) {
        $array = (array)$array;
    }
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            $array[$key] = object_array($value);
        }
    }
    return $array;
}


?>