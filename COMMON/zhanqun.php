<?php

//20网站数据处理

function zqDate($date)
{

    unset($date['resours']);

    unset($date['zqname']);

    unset($date['rebun']);

    $j = 1;
    $i = 0;

    foreach ($date as $key => $value) {

        # code...
        $dateurl[$i][$key] = $value;

        if ($j == 3) {
            $j = 0;
            $i++;
        }

        $j++;


    }

    return $dateurl;

}

//判断文件是否存在，不存在则存入数据

function zqDkflies($date, $path, $files = null)
{

    if (empty($files)) {

        $files = 'date.php';

    } else {
        $files = $files . '.php';
    }
    $paths = $path . $files;

    $date = serialize($date);

    $myfile = fopen($paths, "w");

    $write = fwrite($myfile, $date) or die("Unable to open file!");

    fclose($myfile);

    if ($write) {

        return $result = 1;

    } else {

        return $result = 0;
    }

}

//生成高级单站url站群链接

//1级栏目 http://127.0.0.1/随机目录/suiji数.html

//2级栏目 http://127.0.0.1/随机目录/随机目录/suiji数.html

//域名：$urlindex

//域名目录：$indexml

//自定义目录  $indexadd

//url数量  $zqnum

//目录层次 $zqnub

function zqUrlnews($urlindex, $indexml, $indexadd, $zqnum, $zqnub, $zqml)
{


    $newurl = array();

    if ($zqnub == 2) {


        for ($i = 0; $i < $zqnum; $i++) {
            $cnub = rand(3, 6);

            if (!empty($indexadd)) {
                $urlrand = $indexadd . '/';
            } else {
                $urlrand = randpw($cnub, 'CHAR') . '/';
            }

            if ($zqml == 2) {

                $files = "index.html";

            } else {

                $files = randpw(4, 'NUMBER') . $i . $cnub . ".html";
            }

            $result = 'http://' . $urlindex . '/' . $indexml . '/' . $urlrand . $files;

            $newurl[$i]['url'] = $result;
            $newurl[$i]['yuming'] = $urlindex;
            $newurl[$i]['dir'] = './' . $indexml . '/' . $urlrand;
            $newurl[$i]['files'] = $files;
            $newurl[$i]['indexdir'] = $indexml;

        }


    } elseif ($zqnub == 3) {

        for ($i = 0; $i < $zqnum; $i++) {
            $cnub = rand(3, 6);

            if (!empty($indexadd)) {
                $urlrand = $indexadd . '/' . randpw($cnub, 'CHAR') . '/';
            } else {
                $urlrand = randpw($cnub, 'CHAR') . '/' . randpw($cnub, 'CHAR') . '/';
            }


            if ($zqml == 2) {

                $files = "index.html";

            } else {

                $files = randpw(4, 'NUMBER') . $i . $cnub . ".html";
            }


            $result = 'http://' . $urlindex . '/' . $indexml . '/' . $urlrand . $files;
            $newurl[$i]['url'] = $result;
            $newurl[$i]['yuming'] = $urlindex;
            $newurl[$i]['dir'] = './' . $indexml . '/' . $urlrand;
            $newurl[$i]['files'] = $files;
            $newurl[$i]['indexdir'] = $indexml;
        }

    } else {

        for ($i = 0; $i < $zqnum; $i++) {
            $cnub = rand(3, 6);
            if ($cnub < 5) {

                if (!empty($indexadd)) {
                    $urlrand = $indexadd . '/';
                } else {
                    $urlrand = randpw($cnub, 'CHAR') . '/';
                }

                if ($zqml == 2) {

                    $files = "index.html";

                } else {

                    $files = randpw(4, 'NUMBER') . $i . $cnub . ".html";
                }

                $result = 'http://' . $urlindex . '/' . $indexml . '/' . $urlrand . $files;

                $newurl[$i]['url'] = $result;
                $newurl[$i]['yuming'] = $urlindex;
                $newurl[$i]['dir'] = './' . $indexml . '/' . $urlrand;
                $newurl[$i]['files'] = $files;
                $newurl[$i]['indexdir'] = $indexml;

            } else {

                if (!empty($indexadd)) {
                    $urlrand = $indexadd . '/' . randpw($cnub, 'CHAR') . '/';
                } else {
                    $urlrand = randpw($cnub, 'CHAR') . '/' . randpw($cnub, 'CHAR') . '/';
                }

                if ($zqml == 2) {

                    $files = "index.html";

                } else {

                    $files = randpw(4, 'NUMBER') . $i . $cnub . ".html";
                }


                $result = 'http://' . $urlindex . '/' . $indexml . '/' . $urlrand . $files;

                $newurl[$i]['url'] = $result;
                $newurl[$i]['yuming'] = $urlindex;
                $newurl[$i]['dir'] = './' . $indexml . '/' . $urlrand;
                $newurl[$i]['files'] = $files;
                $newurl[$i]['indexdir'] = $indexml;

            }

        }


    }

    return $newurl;


}

//生成20条网站数据

function zqUrlindex($zadate, $zqnum, $zqnub, $zqtype, $zqml, $zqwj, $keys)
{ //$zadate 数据,$zqnub 层次,$zqml ,$zqml

    $result = array();

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
        10 => 'k',
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

    foreach ($zadate as $key => $value) {
        # code...
        $aa = 'zqurl' . $zimu[$key];
        $cc = 'zqadd' . $zimu[$key];
        $dd = 'zqgen' . $zimu[$key];

        $urlindex = $value[$aa];

        $indexml = $value[$cc];

        $indexadd = $value[$dd];

        if (empty($urlindex)) {
            break;
        }
        if (empty($indexml)) {
            break;
        }

        $url = zqUrlnews($urlindex, $indexml, $indexadd, $zqnum, $zqnub, $zqml);

        $result[$key]['url'] = $url;


    }

    return $result;

}

//资源整合


function zqresourceNew($title, $futitle, $ftitlet, $pic, $content, $keywords, $zqnum, $zqnub, $zqtype, $zqml, $zqwj, $keys, $zqurll, $baiducontent)
{

    foreach ($title as $key => $value) {

        $result[$key]['bt'] = $title[$key];
        $result[$key]['jz'] = $content[$key];
        $result[$key]['keywords'] = $keywords[$key];
        $result[$key]['futitle'] = $futitle[$key];
        $result[$key]['ftitlet'] = $ftitlet[$key];
        $result[$key]['lpic'] = $pic[$key];
        $result[$key]['zqnum'] = $zqnum; //目录数据数量
        $result[$key]['zqnub'] = $zqnub; //目录层次
        $result[$key]['zqtype'] = $zqtype;  //生成类型
        $result[$key]['zqml'] = $zqml; //模板目录
        $result[$key]['zqwj'] = $zqwj; //模板文章
        $result[$key]['keys'] = $keys; //模板关键词
        $result[$key]['zqurll'] = $zqurll; //模板关键词
        $result[$key]['baiducontent'] = $baiducontent[$key]; //模板关键词

    }


    return $result;
}

function zqMaoban($result, $mbtype, $resulturl)
{

    foreach ($resulturl as $k => $v) {


        foreach ($result['resource'] as $key => $value) {

            //匹配句子
            $zqjuzi = $value['baiducontent'] . $value['jz'];

            $mbtypebt = preg_replace('/\$内容2\$/', $zqjuzi, $mbtype);

            //匹配标题


            $mbtypebt = preg_replace('/\$标题\$/', $value['bt'], $mbtypebt);

            //匹配副标题

            $mbtypebt = preg_replace('/\$副站点名\$/', $value['futitle'], $mbtypebt);


            //匹配主标题

            $mbtypebt = preg_replace('/\$站点名\$/', $value['ftitlet'], $mbtypebt);


            //匹配关键词

            if ($result['resource'][$key]['keys'] == 1) {

                $mbtypebt = preg_replace('/\$关键词\$/', $value['keywords'], $mbtypebt);
            } else {
                $mbtypebt = preg_replace('/\$关键词\$/', '', $mbtypebt);
            }

            //匹配样式

            $mbtypebt = preg_replace('/\$原始域名\$/', $value['zqurll'], $mbtypebt);

            //匹配时间

            $time = date('Y-m-d H:i:s', time() + 280 * $key);

            $mbtypebt = preg_replace('/\$时间\$/', $time, $mbtypebt);

            //当前链接

            $mbtypebt = preg_replace('/\$当前链接\$/', $resulturl[$k]['url'][$key]['url'], $mbtypebt);


            //匹配干扰符号

            $ganraonum = preg_match_all('/\$干扰字符\$/', $mbtypebt, $ganraonum);

            for ($i = 0; $i < $ganraonum; $i++) {

                $ganrao = randpw($len = 4, $format = 'ALL');

                $mbtypebt = preg_replace('/\$干扰字符\$/', $ganrao, $mbtypebt, 1);

            }
            /*---------------------------------------开始---------------------------------*/

            //匹配右侧模板一 文件类型

            if ($value['zqtype'] == 1 && $value['zqwj'] == 1) {


                //匹配时间副标题
                for ($i = 1; $i < 7; $i++) {

                    $fbt = '/\$副标题' . $i . '\$/';
                    $fnl = '/\$内链' . $i . '\$/';

                    $mbtypebt = preg_replace($fbt, $result['resource'][$i - 1]['bt'], $mbtypebt);
                    $mbtypebt = preg_replace($fnl, $resulturl[$k]['url'][$i - 1]['url'], $mbtypebt);

                }

                //匹配时间随机时间


                for ($i = 1; $i < 7; $i++) {

                    $min = '+' . $i . 'minute';

                    $timesj = date('Y-m-d H:i:s', time() + 280 * $i);

                    $fsj = '/\$随机日期' . $i . '\$/';

                    $mbtypebt = preg_replace($fsj, $timesj, $mbtypebt);


                }

                $pictxt = '';
                for ($i = 1; $i < 5; $i++) {

                    $picnum = 5 + $i;

                    $picbbt = $result['resource'][$picnum]['bt'];

                    $picurl = $resulturl[$k]['url'][$picnum]['url'];

                    $picpic = $result['resource'][$picnum]['lpic'][0];

                    $pictxt .= "<dd>
         <a href='" . $picurl . "' target='_blank'><img src='" . $picpic . "' rel='nofllow' ><span>" . $picbbt . "</span></a>
          </dd>";

                }

                $mbtypebt = preg_replace('/\$图片列表\$/', $pictxt, $mbtypebt);


                //随便看看


                //随机index数据

                $topi = 6;

                $indexpath = './' . $resulturl[$k]['url'][$key]['indexdir'] . '/';

                $suijiresult = zqTopidir($topi, $indexpath);

                if ($suijiresult) {

                    $suiji = '';

                    for ($i = 0; $i < 6; $i++) {

                        $suiji .= $suijiresult[$i];

                    }

                    $mbtypebt = preg_replace('/\$随机看看\$/', $suiji, $mbtypebt);

                } else {

                    //获取当前的url数据
                    $suiji = '';

                    for ($i = 0; $i < $topi; $i++) {

                        $suijibt = $result['resource'][$i]['bt'];

                        $suijiurl = $resulturl[$k]['url'][$i]['url'];

                        $suijiid = randpw($len = 4, $format = 'CHAR');


                        $suiji .= " <li><a id='" . $suijiid . "' href='" . $suijiurl . "'>" . $suijibt . "</a></li>";

                    }

                    $mbtypebt = preg_replace('/\$随机看看\$/', $suiji, $mbtypebt);

                }


            }
            //匹配右侧模板二 文件类型
            if ($value['zqtype'] == 1 && $value['zqwj'] == 2) {
                # code...
                //匹配时间副标题
                for ($i = 1; $i < 11; $i++) {

                    $fbt = '/\$副标题' . $i . '\$/';
                    $fnl = '/\$内链' . $i . '\$/';

                    $mbtypebt = preg_replace($fbt, $result['resource'][$i - 1]['bt'], $mbtypebt);
                    $mbtypebt = preg_replace($fnl, $resulturl[$k]['url'][$i - 1]['url'], $mbtypebt);

                }

                //匹配时间随机时间


                for ($i = 1; $i < 11; $i++) {

                    $min = '+' . $i . 'minute';

                    $timesj = date('Y-m-d H:i:s', time() + 280 * $i);

                    $fsj = '/\$随机日期' . $i . '\$/';

                    $mbtypebt = preg_replace($fsj, $timesj, $mbtypebt);


                }


                //随机热点推荐

                $rnewstopi = 6;

                $rnewspath = './' . $resulturl[$k]['url'][$key]['indexdir'] . '/';

                $rnewsresult = zqTopidir($rnewstopi, $rnewspath);

                if ($rnewsresult) {

                    $rnews = '';

                    for ($i = 0; $i < 6; $i++) {

                        $rnews .= $rnewsresult[$i];

                    }


                    $mbtypebt = preg_replace('/\$热点推荐\$/', $rnews, $mbtypebt);

                } else {

                    //获取当前的url数据
                    $rnews = '';

                    for ($i = 0; $i < $rnewstopi; $i++) {

                        $rnewsbt = $result['resource'][$i]['bt'];

                        $rnewsurl = $resulturl[$k]['url'][$i]['url'];

                        $rnewsid = randpw($len = 4, $format = 'CHAR');


                        $rnews .= " <li><a id='" . $rnewsid . "' href='" . $rnewsurl . "'>" . $rnewsbt . "</a></li>";

                    }

                    $mbtypebt = preg_replace('/\$热点推荐\$/', $rnews, $mbtypebt);

                }


                //实时报道

                $shishitopi = 10;

                $shishipath = './' . $resulturl[$k]['url'][$key]['indexdir'] . '/';

                $shishiresult = zqTopidir($shishitopi, $shishipath);


                if ($shishiresult) {

                    $shishi = '';

                    for ($i = 0; $i < $shishitopi; $i++) {

                        $shishi .= $shishiresult[$i];

                    }

                    $mbtypebt = preg_replace('/\$实时报道\$/', $shishi, $mbtypebt);

                } else {

                    //获取当前的url数据
                    $shishi = '';

                    for ($i = 0; $i < 6; $i++) {

                        $shishibt = $result['resource'][$i]['bt'];

                        $shishiurl = $resulturl[$k]['url'][$i]['url'];

                        $shishiid = randpw($len = 4, $format = 'CHAR');


                        $shishi .= " <li><a id='" . $shishiid . "' href='" . $shishiurl . "'>" . $shishibt . "</a></li>";

                    }

                    $mbtypebt = preg_replace('/\$实时报道\$/', $shishi, $mbtypebt);

                }

                //最新新闻

                $pictxt = '';
                for ($i = 1; $i < 5; $i++) {

                    $picnum = 5 + $i;

                    $picbbt = $result['resource'][$i - 1]['bt'];

                    $picurl = $resulturl[$k]['url'][$i - 1]['url'];

                    $picpic = $result['resource'][$i - 1]['lpic'][0];

                    $pictxt .= "<li>
         <a href='" . $picurl . "' target='_blank'><img src='" . $picpic . "' rel='nofllow' ><span style=' line-height:25px; height:50px;display:block; overflow:hidden;'>" . $picbbt . "</span></a>
          </li>";

                }

                $mbtypebt = preg_replace('/\$图片列表\$/', $pictxt, $mbtypebt);


            }
            /*---------------------------------------目录i---------------------------------*/

            //匹配右侧模板一 文件类型

            if ($value['zqtype'] == 2 && $value['zqml'] == 1) {


                //匹配时间副标题
                for ($i = 1; $i < 7; $i++) {

                    $fbt = '/\$副标题' . $i . '\$/';
                    $fnl = '/\$内链' . $i . '\$/';

                    $mbtypebt = preg_replace($fbt, $result['resource'][$i - 1]['bt'], $mbtypebt);
                    $mbtypebt = preg_replace($fnl, $resulturl[$k]['url'][$i - 1]['url'], $mbtypebt);

                }

                //匹配时间随机时间


                for ($i = 1; $i < 7; $i++) {

                    $min = '+' . $i . 'minute';

                    $timesj = date('Y-m-d H:i:s', time() + 280 * $i);

                    $fsj = '/\$随机日期' . $i . '\$/';

                    $mbtypebt = preg_replace($fsj, $timesj, $mbtypebt);


                }

                $pictxt = '';
                for ($i = 1; $i < 5; $i++) {

                    $picnum = 5 + $i;

                    $picbbt = $result['resource'][$picnum]['bt'];

                    $picurl = $resulturl[$k]['url'][$picnum]['url'];

                    $picpic = $result['resource'][$picnum]['lpic'][0];

                    $pictxt .= "<dd>
         <a href='" . $picurl . "' target='_blank'><img src='" . $picpic . "' rel='nofllow' ><span>" . $picbbt . "</span></a>
          </dd>";

                }

                $mbtypebt = preg_replace('/\$图片列表\$/', $pictxt, $mbtypebt);


                //随便看看


                //随机index数据

                $topi = 6;

                $indexpath = './' . $resulturl[$k]['url'][$picnum]['indexdir'] . '/';

                $suijiresult = zqTopidir($topi, $indexpath);

                if ($suijiresult) {

                    $suiji = '';

                    for ($i = 0; $i < 6; $i++) {

                        $suiji .= $suijiresult[$i];

                    }

                    $mbtypebt = preg_replace('/\$随机看看\$/', $suiji, $mbtypebt);

                } else {

                    //获取当前的url数据
                    $suiji = '';

                    for ($i = 0; $i < $topi; $i++) {

                        $suijibt = $result['resource'][$i]['bt'];

                        $suijiurl = $resulturl[$k]['url'][$i]['url'];

                        $suijiid = randpw($len = 4, $format = 'CHAR');


                        $suiji .= " <li><a id='" . $suijiid . "' href='" . $suijiurl . "'>" . $suijibt . "</a></li>";

                    }

                    $mbtypebt = preg_replace('/\$随机看看\$/', $suiji, $mbtypebt);

                }


            }

            if ($value['zqtype'] == 2 && $value['zqml'] == 2) {


                # code...
                //匹配时间副标题
                for ($i = 1; $i < 11; $i++) {

                    $fbt = '/\$副标题' . $i . '\$/';
                    $fnl = '/\$内链' . $i . '\$/';

                    $mbtypebt = preg_replace($fbt, $result['resource'][$i - 1]['bt'], $mbtypebt);
                    $mbtypebt = preg_replace($fnl, $resulturl[$k]['url'][$i - 1]['url'], $mbtypebt);

                }

                //匹配时间随机时间


                for ($i = 1; $i < 11; $i++) {

                    $min = '+' . $i . 'minute';

                    $timesj = date('Y-m-d H:i:s', time() + 280 * $i);

                    $fsj = '/\$随机日期' . $i . '\$/';

                    $mbtypebt = preg_replace($fsj, $timesj, $mbtypebt);


                }


                //随机热点推荐

                $rnewstopi = 6;

                $rnewspath = './' . $resulturl[$k]['url'][$key]['indexdir'] . '/';

                $rnewsresult = zqTopidir($rnewstopi, $rnewspath);

                if ($rnewsresult) {

                    $rnews = '';

                    for ($i = 0; $i < 6; $i++) {

                        $rnews .= $rnewsresult[$i];

                    }


                    $mbtypebt = preg_replace('/\$热点推荐\$/', $rnews, $mbtypebt);

                } else {

                    //获取当前的url数据
                    $rnews = '';

                    for ($i = 0; $i < $rnewstopi; $i++) {

                        $rnewsbt = $result['resource'][$i]['bt'];

                        $rnewsurl = $resulturl[$k]['url'][$i]['url'];

                        $rnewsid = randpw($len = 4, $format = 'CHAR');


                        $rnews .= " <li><a id='" . $rnewsid . "' href='" . $rnewsurl . "'>" . $rnewsbt . "</a></li>";

                    }

                    $mbtypebt = preg_replace('/\$热点推荐\$/', $rnews, $mbtypebt);

                }


                //实时报道

                $shishitopi = 10;

                $shishipath = './' . $resulturl[$k]['url'][$key]['indexdir'] . '/';

                $shishiresult = zqTopidir($shishitopi, $shishipath);


                if ($shishiresult) {

                    $shishi = '';

                    for ($i = 0; $i < $shishitopi; $i++) {

                        $shishi .= $shishiresult[$i];

                    }

                    $mbtypebt = preg_replace('/\$实时报道\$/', $shishi, $mbtypebt);

                } else {

                    //获取当前的url数据
                    $shishi = '';

                    for ($i = 0; $i < 6; $i++) {

                        $shishibt = $result['resource'][$i]['bt'];

                        $shishiurl = $resulturl[$k]['url'][$i]['url'];

                        $shishiid = randpw($len = 4, $format = 'CHAR');


                        $shishi .= " <li><a id='" . $shishiid . "' href='" . $shishiurl . "'>" . $shishibt . "</a></li>";

                    }

                    $mbtypebt = preg_replace('/\$实时报道\$/', $shishi, $mbtypebt);

                }

                //最新新闻

                $pictxt = '';
                for ($i = 1; $i < 5; $i++) {

                    $picnum = 5 + $i;

                    $picbbt = $result['resource'][$i - 1]['bt'];

                    $picurl = $resulturl[$k]['url'][$i - 1]['url'];

                    $picpic = $result['resource'][$i - 1]['lpic'][0];

                    $pictxt .= "<li>
         <a href='" . $picurl . "' target='_blank'><img src='" . $picpic . "' rel='nofllow' ><span style=' line-height:25px; height:50px;display:block; overflow:hidden;'>" . $picbbt . "</span></a>
          </li>";

                }

                $mbtypebt = preg_replace('/\$图片列表\$/', $pictxt, $mbtypebt);


            }

            /*---------------------------------------结束---------------------------------*/


            $mbsult[$k][$key]['mb'] = $mbtypebt;
            $mbsult[$k][$key]['url'] = $v['url'][$key]['url'];
            $mbsult[$k][$key]['dir'] = $v['url'][$key]['dir'];
            $mbsult[$k][$key]['files'] = $v['url'][$key]['files'];
            $mbsult[$k][$key]['bt'] = $value['bt'];
            $mbsult[$k][$key]['time'] = $time;
            $mbsult[$k][$key]['indexdir'] = $v['url'][$key]['indexdir'];


            # code...


        }

        # code...
    }


    $mbsult = serialize($mbsult);

    return $mbsult;


}


function zqMkdir($newtype)
{ //判断文件是否存在，如果不存在则创建

    $zhurl = array();

    $result = unserialize($newtype);

    foreach ($result as $k => $v) {

        foreach ($v as $key => $value) {


            $url = $value['url'];

            $dir = $value['dir'];

            $files = $value['files'];

            $paths = $dir . $files;


            $succdir = mkdirs_1($dir);

            if ($succdir == 1) {

                $myfile = fopen($paths, "w");

                $write = fwrite($myfile, $value['mb']) or die("Unable to open file!");

                if ($write) {

                    $zhurl[$k][$key] = $url;


                } else {

                    $zhurl[$k][$key] = 0;
                }

            }
            fclose($myfile);

        }


    }

    return $zhurl;
}


function zqmkFlies($date)
{


    foreach ($date as $key => $value) {
        # code...
        $newdate = '';

        foreach ($value['url'] as $k => $v) {
            # code...
            $newdate .= $v['url'] . "\r\n";

        }


        $sitemap = './' . $value['url'][0]['indexdir'] . '/zqsitemap.txt';


        $myfile = fopen($sitemap, "a");

        $write = fwrite($myfile, $newdate) or die("Unable to open file!");

        fclose($myfile);


        if ($write) {

            $result[$key] = '域名【' . $value['url'][0]['yuming'] . '】—— 域名根目录 ——【' . $value['url'][0]['indexdir'] . "】zqsitemap.txt创建成功</br>";

        } else {

            $result[$key] = '域名【' . $value['url'][0]['yuming'] . '】—— 域名根目录 ——【' . $value['url'][0]['indexdir'] . "】zqsitemap.txt创建失败</br>";

        }


    }


    return $result;


}


function zqmkIndexdir($date)
{  //首页模板生成index.txt
    $date = unserialize($date);

    $res = array();
    //整理数据
    foreach ($date as $key => $value) {

        $result = '';

        foreach ($value as $k => $v) {
            # code...
            $url = $v['url'];
            $title = $v['bt'];
            $time = $v['time'];
            $result .= "<li><a href='" . $url . "'>" . $title . "</a><span>" . $time . "</span></li> \r\n";


        }

        $result = preg_replace('/index.html/', '', $result);

        $paths = './' . $value[0]['indexdir'] . '/index.txt';

        $myfile = fopen($paths, "a");

        $write = fwrite($myfile, $result) or die("Unable to open file!");

        fclose($myfile);

        if ($write) {

            $res[$key] =  '—— 域名根目录 ——【' . $value[0]['indexdir'] . "】index.txt创建成功</br>";

        } else {

            $res[$key] = '—— 域名根目录 ——【' . $value[0]['indexdir'] . "】index.txt创建失败</br>";

        }

    }

    return $res;

}


function zqHtmldir($resulturl, $zqurll)
{

    foreach ($resulturl as $key => $value) {

        $path = './MOBAN/';

        $files = 'index.txt';

        $index = zxqMb($files, $path);

        $pathi = './' . $value['url'][0]['indexdir'] . '/';

        $filesi = 'index.txt';

        $indexi = readFiles($filesi, $pathi);

        $olddate = getrand(120, $indexi);

        $newsdate = '';

        foreach ($olddate as $k => $v) {
            $newsdate .= $v;
        }

        $date = preg_replace('/\$首页链接\$/', $newsdate, $index);

        //匹配样式

        $date = preg_replace('/\$原始域名\$/', $zqurll, $date);

        $indexpaths = './' . $value['url'][0]['indexdir'] . './indextop.html';

        $myfile = fopen($indexpaths, "w");

        $write = fwrite($myfile, $date) or die("Unable to open file!");

        if ($write) {

            $res[$key] = '域名【' . $value['url'][0]['yuming'] . '】—— 域名根目录 ——【' . $value['url'][0]['indexdir'] . "】indextop.html创建成功</br>";

        } else {

            $res[$key] = '域名【' . $value['url'][0]['yuming'] . '】—— 域名根目录 ——【' . $value['url'][0]['indexdir'] . "】indextop.html创建失败</br>";

        }

        fclose($myfile);


    }

    return $res;

}


//抓取首页当前数据


//抓取首页数据

function zqTopidir($num, $path)
{


    $files = 'index.txt';
    $path = $path;

    $paths = $path . $files;

    if (file_exists($paths)) {
        $index = readFiles($files, $path);

        $result = getrand($num, $index);


        if ($result) {
            return $result;
        } else {
            return 0;
        }


    } else {
        return 0;
    }


}

?>



