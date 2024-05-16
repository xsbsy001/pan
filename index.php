<?php
/**
 * @author FosiPlayer
 * @date 2022-08-30
 * @version 1.1.0
 */
#########以下为执行代码，不懂代码切勿修改，以免出错！###########
error_reporting(0);
require_once 'config.php';
require_once 'function.php';
if($_GET['url'] == ''){
    exit('<html><meta name="robots" content="noarchive"><head><title>'.$playtittle.'</title></head><style>h1{color:#00A0E8; text-align:center; font-family: Microsoft Jhenghei;}p{color:#f90; font-size: 1.2rem;text-align:center;font-family: Microsoft Jhenghei;}</style><body bgcolor="#000000"><table width="100%" height="100%" align="center"><td align="center"><h1>'.$playtittle.'</h1><p>欢迎使用本解析服务，如有任何问题请联系管理员</p></table></body></html>');
}
playuareferer($webua,$webreferer,$tiaozhuanurl1);
playkey($playkey,$playqidong,$tiaozhuanurl1);
if($playtype=='muiplayer'){
    print_r(muiplayer($playtittle,$jiazhaiarray[mt_rand(0,(count($jiazhaiarray)-1))],$background,time(),$zhekey,$contextmenu,$contextlink,$themeColor,$dragSpotShape,$zantingguanggaoqidong,$zantingguanggaourl,$zantingguanggaolianjie));
}else if($playtype=='dplayer'){
    print_r(dplayer($playtittle,$jiazhaiarray[mt_rand(0,(count($jiazhaiarray)-1))],$background,time(),$zhekey,$contextmenu,$contextlink,$zantingguanggaoqidong,$zantingguanggaourl,$zantingguanggaolianjie));
}else if($playtype=='artplayer'){
    print_r(artplayer($playtittle,$jiazhaiarray[mt_rand(0,(count($jiazhaiarray)-1))],$background,time(),$zhekey,$contextmenu,$contextlink,$themeColor,$zantingguanggaoqidong,$zantingguanggaourl,$zantingguanggaolianjie));
}else{ 
    print_r(muiplayer($playtittle,$jiazhaiarray[mt_rand(0,(count($jiazhaiarray)-1))],$background,time(),$zhekey,$contextmenu,$contextlink,$themeColor,$dragSpotShape,$zantingguanggaoqidong,$zantingguanggaourl,$zantingguanggaolianjie));
}
#########以下为播放器函数，不懂代码切勿修改，以免出错！########### 
function muiplayer($playtittle,$jiazhai,$background,$time,$zhekey,$contextmenu,$contextlink,$themeColor,$dragSpotShape,$zantingguanggaoqidong,$zantingguanggaourl,$zantingguanggaolianjie){
     return 
     '<!DOCTYPE html>
<html>
<head>
    <title>'.$playtittle.'</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="referrer" content="no-referrer">
    <meta http-equiv="Access-Control-Allow-Origin" content="*" />
    <meta http-equiv="Access-Control-Allow-Credentials" content="*" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" href="muiplayer/css/mui-player.min.css?v=1.1.0">
    <link rel="stylesheet" href="muiplayer/css/muiplayer.css?v=1.1.0">
<style>
    body,html {
    	font: 24px "Microsoft YaHei", Arial, Lucida Grande, Tahoma, sans-serif;
    	width: 100%;
    	height: 100%;
    	padding: 0;
    	margin: 0;
    	overflow-x: hidden;
    	overflow-y: hidden;
    	background-color: black;
    }
    #loading {
        background:url('.$jiazhai.');
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        position: absolute;
        z-index: 10000000001;
        background-size: 100% 100%;
    }
    #error{
        background:url('.$background.');
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        text-align:center;
        display:table; 
        position: absolute;
        z-index: 10000000001;
        background-size: 100% 100%; 
    }
    h1 {
        color: #ffffff;
        font-size: 1.2rem;
        margin:0;
        padding:0;
        vertical-align:middle;
        display:table-cell;
        font-family: Microsoft Jhenghei;
    }
    #player_pic {
        position: relative;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }
    .player_pic_box {
        position: relative;
        width: 50%;
    }
    .player_pic_link {
        pointer-events: auto;
        cursor: pointer;
    }
    .player_pic_link img {
        margin: 0 auto;
        width: 100%;
        height: 100%;
    }
    .close-player_pic {
        position: absolute;
        right: 10px;
        top: 10px;
        width: 30px;
        height: 30px;
        background: #000;
        border-radius: 50px;
        line-height: 30px;
        text-align: center;
        font-size: 18px;
        color: #fff;
        font-weight: 700;
        border: 3px solid #fff;
        cursor: pointer;
        pointer-events: auto;
    }
    </style>
    <script src="muiplayer/js/jquery.min.js?v=1.1.0"></script>
    <script src="muiplayer/js/mui-player.min.js?v=1.1.0"></script>
    <script src="muiplayer/js/mui-player-desktop-plugin.min.js?v=1.1.0"></script>
    <script src="muiplayer/js/mui-player-mobile-plugin.min.js?v=1.1.0"></script>
    <script src="muiplayer/js/jquery.xctips.js?v=1.1.0"></script>
    <script src="muiplayer/js/hls.min.js?v=1.1.0"></script>
    <script src="muiplayer/js/flv.min.js?v=1.1.0"></script>
    <script src="muiplayer/js/setting.js?v=1.1.0"></script>
</head>
<body>
    <div id="loading"  align="center"></div>
    <script type="text/javascript">
        var config = {
            "url": "'.playerurl()['url'].'",
            "title": "'.playerurl()['title'].'",
            "time": "'.$time.'", 
            "key": "'.getapikey($time,$zhekey).'",
            "vkey": "'.md5(playerurl()['url']).'",
            "next":"'.playerurl()['next'].'",
            "contextmenu": "'.$contextmenu.'",
            "contextlink":"'.$contextlink.'",
            "background":"'.$background.'",
            "themeColor":"'.$themeColor.'",
            "dragSpotShape":"'.$dragSpotShape.'",
            "zantingguanggaoqidong":"'.$zantingguanggaoqidong.'",
            "zantingguanggaourl":"'.$zantingguanggaourl.'",
            "zantingguanggaolianjie":"'.$zantingguanggaolianjie.'"
        };
        player(config);
    </script>
</body>
</html>';
 }
function dplayer($playtittle,$jiazhai,$background,$time,$zhekey,$contextmenu,$contextlink,$zantingguanggaoqidong,$zantingguanggaourl,$zantingguanggaolianjie){
     return 
     '<!DOCTYPE html>
<html>
<head>
    <title>'.$playtittle.'</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="referrer" content="no-referrer">
    <meta http-equiv="Access-Control-Allow-Origin" content="*" />
    <meta http-equiv="Access-Control-Allow-Credentials" content="*" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" href="dplayer/css/DPlayer.min.css?v=1.1.0">
<style>
    body,html {
    	font: 24px "Microsoft YaHei", Arial, Lucida Grande, Tahoma, sans-serif;
    	width: 100%;
    	height: 100%;
    	padding: 0;
    	margin: 0;
    	overflow-x: hidden;
    	overflow-y: hidden;
    	background-color: black;
    }
    #loading {
        background:url('.$jiazhai.');
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        position: absolute;
        z-index: 10000000001;
        background-size: 100% 100%;
    }
        #dplayer{
        background:url('.$background.');
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
    }
    #error{
        background:url('.$background.');
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        text-align:center;
        display:table; 
        position: absolute;
        z-index: 10000000001;
        background-size: 100% 100%; 
    }
    h1 {
        color: #ffffff;
        font-size: 1.2rem;
        margin:0;
        padding:0;
        vertical-align:middle;
        display:table-cell;
        font-family: Microsoft Jhenghei;
    }
    #player_pic {
        position:fixed;
        left:0px;
        top:0px;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }
    .player_pic_box {
        position: relative;
        width: 50%;
    }
    .player_pic_link {
        pointer-events: auto;
        cursor: pointer;
    }
    .player_pic_link img {
        margin: 0 auto;
        width: 100%;
        height: 100%;
    }
    .close-player_pic {
        position: absolute;
        right: 10px;
        top: 10px;
        width: 30px;
        height: 30px;
        background: #000;
        border-radius: 50px;
        line-height: 30px;
        text-align: center;
        font-size: 18px;
        color: #fff;
        font-weight: 700;
        border: 3px solid #fff;
        cursor: pointer;
        pointer-events: auto;
    }
    </style>
    <script src="dplayer/js/jquery.min.js?v=1.1.0"></script>
    <script src="dplayer/js/DPlayer.min.js?v=1.1.0"></script>
    <script src="dplayer/js/hls.min.js?v=1.1.0"></script>
    <script src="dplayer/js/flv.min.js?v=1.1.0"></script>
    <script src="dplayer/js/setting.js?v=1.1.0"></script>
</head>
<body>
    <div id="loading"  align="center"></div>
    <script type="text/javascript">
        var config = {
            "url": "'.playerurl()['url'].'",
            "title": "'.playerurl()['title'].'",
            "time": "'.$time.'", 
            "key": "'.getapikey($time,$zhekey).'",
            "vkey": "'.md5(playerurl()['url']).'",
            "next":"'.playerurl()['next'].'",
            "contextmenu": "'.$contextmenu.'",
            "contextlink":"'.$contextlink.'",
            "zantingguanggaoqidong":"'.$zantingguanggaoqidong.'",
            "zantingguanggaourl":"'.$zantingguanggaourl.'",
            "zantingguanggaolianjie":"'.$zantingguanggaolianjie.'"
        };
        player(config);
    </script>
</body>
</html>';
 }
 function artplayer($playtittle,$jiazhai,$background,$time,$zhekey,$contextmenu,$contextlink,$themeColor,$zantingguanggaoqidong,$zantingguanggaourl,$zantingguanggaolianjie){
     return 
     '<!DOCTYPE html>
<html>
<head>
    <title>'.$playtittle.'</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="referrer" content="no-referrer">
    <meta http-equiv="Access-Control-Allow-Origin" content="*" />
    <meta http-equiv="Access-Control-Allow-Credentials" content="*" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<style>
   body,html {
       font: 24px "Microsoft YaHei", Arial, Lucida Grande, Tahoma, sans-serif;
       width: 100%;
       height: 100%;
       padding: 0;
       margin: 0;
       overflow-x: hidden;
       overflow-y: hidden;
       background-color: black;
   }
   #loading {
        background:url('.$jiazhai.');
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        position: absolute;
        z-index: 10000000001;
        background-size: 100% 100%;
    }
    #error{
        background:url('.$background.');
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        text-align:center;
        display:table; 
        position: absolute;
        z-index: 10000000001;
        background-size: 100% 100%; 
    }
    h1 {
        color: #ffffff;
        font-size: 1.2rem;
        margin:0;
        padding:0;
        vertical-align:middle;
        display:table-cell;
        font-family: Microsoft Jhenghei;
    }
    #player_pic {
        position:fixed;
        left:0px;
        top:0px;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }
    .player_pic_box {
        position: relative;
        width: 50%;
    }
    .player_pic_link {
        pointer-events: auto;
        cursor: pointer;
    }
    .player_pic_link img {
        margin: 0 auto;
        width: 100%;
        height: 100%;
    }
    .close-player_pic {
        position: absolute;
        right: 10px;
        top: 10px;
        width: 30px;
        height: 30px;
        background: #000;
        border-radius: 50px;
        line-height: 30px;
        text-align: center;
        font-size: 18px;
        color: #fff;
        font-weight: 700;
        border: 3px solid #fff;
        cursor: pointer;
        pointer-events: auto;
    }
   </style>
    <script src="artplayer/js/jquery.min.js?v=1.1.0"></script>
    <script src="artplayer/js/artplayer.js?v=1.1.0"></script>
    <script src="artplayer/js/hls.min.js?v=1.1.0"></script>
    <script src="artplayer/js/flv.min.js?v=1.1.0"></script>
    <script src="artplayer/js/setting.js?v=1.1.0"></script>
</head>
<body>
    <div id="loading"  align="center"></div>
    <script type="text/javascript">
        var config = {
            "url": "'.playerurl()['url'].'",
            "title": "'.playerurl()['title'].'",
            "time": "'.$time.'", 
            "key": "'.getapikey($time,$zhekey).'",
            "vkey": "'.md5(playerurl()['url']).'",
            "next":"'.playerurl()['next'].'",
            "contextmenu": "'.$contextmenu.'",
            "contextlink":"'.$contextlink.'",
            "background":"'.$background.'",
             "themeColor":"'.$themeColor.'",
            "zantingguanggaoqidong":"'.$zantingguanggaoqidong.'",
            "zantingguanggaourl":"'.$zantingguanggaourl.'",
            "zantingguanggaolianjie":"'.$zantingguanggaolianjie.'"
        };
        player(config);
    </script>
</body>
</html>';
 }
?>
