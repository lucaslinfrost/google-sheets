<?php
ini_set('memory_limit', '512M');
//檢索頁(提示搜索)
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $code = explode('-', $message['text']);
            $wordsave = $code[1];
            $alltext = "";
            $dropswitch = "off";
            $productionswitch = "off";
            $equipswitch = "off";
            $rockswitch = "off";
            $seedswitch = "off";
            $drillswitch = "off";
            $checkswitch = "off";
            $mapswitch = "off";
            $countno = 0;
            $titlename = "";
            $realname = "";
            $textcode = "";
            $result = array();
            $altText = "關於 ".$message['text']." 的資料"; 
            
            
//怪物關鍵字
if ($countno === 0) {
$json0 = file_get_contents('./data/m&d.json');
$data0 = json_decode($json0, true);
foreach ($data0['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$keywords']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) { 
$titlename = "怪物資訊";
$realname = $item['gsx$name']['$t'];
$textcode = "老大M ".$code[1];
$candidate = array('type' => 'bubble','size' => 'micro','hero' => array('type' => 'image','url' => 'https://i.imgur.com/TnwYgP6.png','size' => 'full','aspectMode' => 'fit','aspectRatio' => '320:213'),'body' => array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'text','text' => $titlename,'weight' => 'bold','size' => 'sm','wrap' => true,'align' => 'center'),array('type' => 'box','layout' => 'baseline','contents' => array(array('type' => 'text','text' => "---------------",'size' => 'xs','color' => '#8c8c8c','margin' => 'md','align' => 'center'))),array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'box','layout' => 'baseline','spacing' => 'sm','contents' => array(array('type' => 'text','text' => $realname,'wrap' => true,'color' => '#252dba','size' => 'sm','align' => 'center','action' => array('type' => 'message','label' => 'action','text' => $textcode,))))))),'spacing' => 'sm','paddingAll' => '13px','backgroundColor' => '#edece8','justifyContent' => 'space-evenly'));
array_push($result, $candidate);
unset($json0, $data0, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}
            
//怪物關鍵字2
if ($countno === 1) {
$json0 = file_get_contents('./data/m&d.json');
$data0 = json_decode($json0, true);
$replacename = $code[1]."2";
foreach ($data0['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$keywords']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($replacename, $keyword) === 0) { 
$titlename = "怪物資訊";
$realname = $item['gsx$name']['$t'];
$textcode = "老大M ".$replacename;
$candidate = array('type' => 'bubble','size' => 'micro','hero' => array('type' => 'image','url' => 'https://i.imgur.com/TnwYgP6.png','size' => 'full','aspectMode' => 'fit','aspectRatio' => '320:213'),'body' => array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'text','text' => $titlename,'weight' => 'bold','size' => 'sm','wrap' => true,'align' => 'center'),array('type' => 'box','layout' => 'baseline','contents' => array(array('type' => 'text','text' => "---------------",'size' => 'xs','color' => '#8c8c8c','margin' => 'md','align' => 'center'))),array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'box','layout' => 'baseline','spacing' => 'sm','contents' => array(array('type' => 'text','text' => $realname,'wrap' => true,'color' => '#252dba','size' => 'sm','align' => 'center','action' => array('type' => 'message','label' => 'action','text' => $textcode,))))))),'spacing' => 'sm','paddingAll' => '13px','backgroundColor' => '#edece8','justifyContent' => 'space-evenly'));
array_push($result, $candidate);
unset($json0, $data0, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}
            
//怪物關鍵字3
if ($countno === 2) {
$json0 = file_get_contents('./data/m&d.json');
$data0 = json_decode($json0, true);
$replacename = $code[1]."3";
foreach ($data0['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$keywords']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($replacename, $keyword) === 0) { 
$titlename = "怪物資訊";
$realname = $item['gsx$name']['$t'];
$textcode = "老大M ".$replacename;
$candidate = array('type' => 'bubble','size' => 'micro','hero' => array('type' => 'image','url' => 'https://i.imgur.com/TnwYgP6.png','size' => 'full','aspectMode' => 'fit','aspectRatio' => '320:213'),'body' => array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'text','text' => $titlename,'weight' => 'bold','size' => 'sm','wrap' => true,'align' => 'center'),array('type' => 'box','layout' => 'baseline','contents' => array(array('type' => 'text','text' => "---------------",'size' => 'xs','color' => '#8c8c8c','margin' => 'md','align' => 'center'))),array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'box','layout' => 'baseline','spacing' => 'sm','contents' => array(array('type' => 'text','text' => $realname,'wrap' => true,'color' => '#252dba','size' => 'sm','align' => 'center','action' => array('type' => 'message','label' => 'action','text' => $textcode,))))))),'spacing' => 'sm','paddingAll' => '13px','backgroundColor' => '#edece8','justifyContent' => 'space-evenly'));
array_push($result, $candidate);
unset($json0, $data0, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}

//掉落物關鍵字
if ($countno === 3) {
$json1 = file_get_contents('./data/m&d.json');
$data1 = json_decode($json1, true);
$code[1] = str_replace(array("(",")","（","）"),"",$code[1]);
foreach ($data1['feed']['entry'] as $item) {
$keywords = explode('、', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
if (strcmp($dropswitch, "off") === 0) {
$titlename = "掉落資訊";
$realname = $code[1];
$textcode = "老大D ".$code[1];
$candidate = array('type' => 'bubble','size' => 'micro','hero' => array('type' => 'image','url' => 'https://i.imgur.com/zNKsFdI.png','size' => 'full','aspectMode' => 'fit','aspectRatio' => '320:213'),'body' => array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'text','text' => $titlename,'weight' => 'bold','size' => 'sm','wrap' => true,'align' => 'center'),array('type' => 'box','layout' => 'baseline','contents' => array(array('type' => 'text','text' => "---------------",'size' => 'xs','color' => '#8c8c8c','margin' => 'md','align' => 'center'))),array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'box','layout' => 'baseline','spacing' => 'sm','contents' => array(array('type' => 'text','text' => $realname,'wrap' => true,'color' => '#252dba','size' => 'sm','align' => 'center','action' => array('type' => 'message','label' => 'action','text' => $textcode,))))))),'spacing' => 'sm','paddingAll' => '13px','backgroundColor' => '#edece8','justifyContent' => 'space-evenly'));
array_push($result, $candidate);
$dropswitch = "on";
}
unset($json1, $data1, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}
            
//生產關鍵字
if ($countno === 4) {
$json2 = file_get_contents('./data/production.json');
$data2 = json_decode($json2, true);
$code[1] = str_replace(array("(",")","（","）","等"),"",$code[1]);
foreach ($data2['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$keyword']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
if (strcmp($productionswitch, "off") === 0) {
$titlename = "生產資訊";
$realname = $code[1];
$textcode = "老大P ".$code[1];
$candidate = array('type' => 'bubble','size' => 'micro','hero' => array('type' => 'image','url' => 'https://i.imgur.com/HIJxaIz.png','size' => 'full','aspectMode' => 'fit','aspectRatio' => '320:213'),'body' => array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'text','text' => $titlename,'weight' => 'bold','size' => 'sm','wrap' => true,'align' => 'center'),array('type' => 'box','layout' => 'baseline','contents' => array(array('type' => 'text','text' => "---------------",'size' => 'xs','color' => '#8c8c8c','margin' => 'md','align' => 'center'))),array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'box','layout' => 'baseline','spacing' => 'sm','contents' => array(array('type' => 'text','text' => $realname,'wrap' => true,'color' => '#252dba','size' => 'sm','align' => 'center','action' => array('type' => 'message','label' => 'action','text' => $textcode,))))))),'spacing' => 'sm','paddingAll' => '13px','backgroundColor' => '#edece8','justifyContent' => 'space-evenly'));
array_push($result, $candidate);
$productionswitch = "on";
}
unset($json2, $data2, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
} 
            
//裝備關鍵字
if ($countno === 5) {
$json3 = file_get_contents('./data/equip.json');
$data3 = json_decode($json3, true);
foreach ($data3['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
if (strcmp($equipswitch, "off") === 0) {
$titlename = "裝備資訊";
$realname = $item['gsx$name']['$t'];
$textcode = "老大E ".$code[1];
$candidate = array('type' => 'bubble','size' => 'micro','hero' => array('type' => 'image','url' => 'https://i.imgur.com/0tVlNCZ.png','size' => 'full','aspectMode' => 'fit','aspectRatio' => '320:213'),'body' => array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'text','text' => $titlename,'weight' => 'bold','size' => 'sm','wrap' => true,'align' => 'center'),array('type' => 'box','layout' => 'baseline','contents' => array(array('type' => 'text','text' => "---------------",'size' => 'xs','color' => '#8c8c8c','margin' => 'md','align' => 'center'))),array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'box','layout' => 'baseline','spacing' => 'sm','contents' => array(array('type' => 'text','text' => $realname,'wrap' => true,'color' => '#252dba','size' => 'sm','align' => 'center','action' => array('type' => 'message','label' => 'action','text' => $textcode,))))))),'spacing' => 'sm','paddingAll' => '13px','backgroundColor' => '#edece8','justifyContent' => 'space-evenly'));
array_push($result, $candidate);
$equipswitch = "on";
}
unset($json3, $data3, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}
            
//石頭關鍵字  
if ($countno === 6) {
$json4 = file_get_contents('./data/rock.json');
$data4 = json_decode($json4, true);   
$code[1] = str_replace(array("◇","▲","◆","□"),"",$code[1]);
foreach ($data4['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
if (strcmp($rockswitch, "off") === 0) {
$titlename = "石頭資訊";
$realname = $item['gsx$name']['$t'];
$textcode = "老大R ".$code[1];
$candidate = array('type' => 'bubble','size' => 'micro','hero' => array('type' => 'image','url' => 'https://i.imgur.com/JRcp8bV.png','size' => 'full','aspectMode' => 'fit','aspectRatio' => '320:213'),'body' => array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'text','text' => $titlename,'weight' => 'bold','size' => 'sm','wrap' => true,'align' => 'center'),array('type' => 'box','layout' => 'baseline','contents' => array(array('type' => 'text','text' => "---------------",'size' => 'xs','color' => '#8c8c8c','margin' => 'md','align' => 'center'))),array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'box','layout' => 'baseline','spacing' => 'sm','contents' => array(array('type' => 'text','text' => $realname,'wrap' => true,'color' => '#252dba','size' => 'sm','align' => 'center','action' => array('type' => 'message','label' => 'action','text' => $textcode,))))))),'spacing' => 'sm','paddingAll' => '13px','backgroundColor' => '#edece8','justifyContent' => 'space-evenly'));
array_push($result, $candidate);
$rockswitch = "on";
}
unset($json4, $data4, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}
            
//栽培關鍵字
if ($countno === 7) {
$json5 = file_get_contents('./data/seed.json');
$data5 = json_decode($json5, true);
foreach ($data5['feed']['entry'] as $item) {
$keywords = explode('、', $item['gsx$key2']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
if (strcmp($seedswitch, "off") === 0) {
$titlename = "栽培資訊";
$realname = $item['gsx$name']['$t'];
$textcode = "老大栽培 ".$realname;
$candidate = array('type' => 'bubble','size' => 'micro','hero' => array('type' => 'image','url' => 'https://i.imgur.com/1nKf5zE.png','size' => 'full','aspectMode' => 'fit','aspectRatio' => '320:213'),'body' => array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'text','text' => $titlename,'weight' => 'bold','size' => 'sm','wrap' => true,'align' => 'center'),array('type' => 'box','layout' => 'baseline','contents' => array(array('type' => 'text','text' => "---------------",'size' => 'xs','color' => '#8c8c8c','margin' => 'md','align' => 'center'))),array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'box','layout' => 'baseline','spacing' => 'sm','contents' => array(array('type' => 'text','text' => $realname,'wrap' => true,'color' => '#252dba','size' => 'sm','align' => 'center','action' => array('type' => 'message','label' => 'action','text' => $textcode,))))))),'spacing' => 'sm','paddingAll' => '13px','backgroundColor' => '#edece8','justifyContent' => 'space-evenly'));
array_push($result, $candidate);
$seedswitch = "on";
}
unset($json5, $data5, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}
            
//採礦關鍵字   
if ($countno === 8) {
$json6 = file_get_contents('./data/drill.json');
$data6 = json_decode($json6, true);
foreach ($data6['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
if (strcmp($drillswitch, "off") === 0) {
$titlename = "挖礦資訊";
$realname = $code[1];
$textcode = "老大挖 ".$code[1];
$candidate = array('type' => 'bubble','size' => 'micro','hero' => array('type' => 'image','url' => 'https://i.imgur.com/ZBbr9Q0.png','size' => 'full','aspectMode' => 'fit','aspectRatio' => '320:213'),'body' => array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'text','text' => $titlename,'weight' => 'bold','size' => 'sm','wrap' => true,'align' => 'center'),array('type' => 'box','layout' => 'baseline','contents' => array(array('type' => 'text','text' => "---------------",'size' => 'xs','color' => '#8c8c8c','margin' => 'md','align' => 'center'))),array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'box','layout' => 'baseline','spacing' => 'sm','contents' => array(array('type' => 'text','text' => $realname,'wrap' => true,'color' => '#252dba','size' => 'sm','align' => 'center','action' => array('type' => 'message','label' => 'action','text' => $textcode,))))))),'spacing' => 'sm','paddingAll' => '13px','backgroundColor' => '#edece8','justifyContent' => 'space-evenly'));
array_push($result, $candidate);
$drillswitch = "on";
}
unset($json6, $data6, $keywords, $keyword);
}
}
}   
$countno = $countno+1;   
}        


//物品用途(生產)
if ($countno === 9) {
$json2 = file_get_contents('./data/production.json');
$data2 = json_decode($json2, true);
$code[1] = str_replace(array("(",")","（","）"),"",$code[1]);
foreach ($data2['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$ppic']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
if (strcmp($checkswitch, "off") === 0) {
$titlename = "素材用途";
$realname = $code[1];
$textcode = "老大look#".$code[1];
$candidate = array('type' => 'bubble','size' => 'micro','hero' => array('type' => 'image','url' => 'https://i.imgur.com/e9nBSf9.png','size' => 'full','aspectMode' => 'fit','aspectRatio' => '320:213'),'body' => array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'text','text' => $titlename,'weight' => 'bold','size' => 'sm','wrap' => true,'align' => 'center'),array('type' => 'box','layout' => 'baseline','contents' => array(array('type' => 'text','text' => "---------------",'size' => 'xs','color' => '#8c8c8c','margin' => 'md','align' => 'center'))),array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'box','layout' => 'baseline','spacing' => 'sm','contents' => array(array('type' => 'text','text' => $realname,'wrap' => true,'color' => '#252dba','size' => 'sm','align' => 'center','action' => array('type' => 'message','label' => 'action','text' => $textcode,))))))),'spacing' => 'sm','paddingAll' => '13px','backgroundColor' => '#edece8','justifyContent' => 'space-evenly'));
array_push($result, $candidate);
$checkswitch = "on";
}
unset($json2, $data2, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
} 
            
//物品用途(裝備)
if ($countno === 10) {
$json3 = file_get_contents('./data/equip.json');
$data3 = json_decode($json3, true);
$code[1] = str_replace(array("(",")","（","）"),"",$code[1]);
foreach ($data3['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$search']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
if (strcmp($checkswitch, "off") === 0) {
$titlename = "素材用途";
$realname = $code[1];
$textcode = "老大look#".$code[1];
$candidate = array('type' => 'bubble','size' => 'micro','hero' => array('type' => 'image','url' => 'https://i.imgur.com/e9nBSf9.png','size' => 'full','aspectMode' => 'fit','aspectRatio' => '320:213'),'body' => array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'text','text' => $titlename,'weight' => 'bold','size' => 'sm','wrap' => true,'align' => 'center'),array('type' => 'box','layout' => 'baseline','contents' => array(array('type' => 'text','text' => "---------------",'size' => 'xs','color' => '#8c8c8c','margin' => 'md','align' => 'center'))),array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'box','layout' => 'baseline','spacing' => 'sm','contents' => array(array('type' => 'text','text' => $realname,'wrap' => true,'color' => '#252dba','size' => 'sm','align' => 'center','action' => array('type' => 'message','label' => 'action','text' => $textcode,))))))),'spacing' => 'sm','paddingAll' => '13px','backgroundColor' => '#edece8','justifyContent' => 'space-evenly'));
array_push($result, $candidate);
$checkswitch = "on";
}
unset($json3, $data3, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}
            
//地圖關鍵字  
if ($countno === 11) {
$json4 = file_get_contents('./data/map.json');
$data4 = json_decode($json4, true);   
foreach ($data4['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
if (strcmp($mapswitch, "off") === 0) {
$titlename = "地圖導航";
$realname = $item['gsx$mapn']['$t'];
$textcode = "老大導航#".$code[1];
$candidate = array('type' => 'bubble','size' => 'micro','hero' => array('type' => 'image','url' => 'https://i.imgur.com/JRcp8bV.png','size' => 'full','aspectMode' => 'fit','aspectRatio' => '320:213'),'body' => array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'text','text' => $titlename,'weight' => 'bold','size' => 'sm','wrap' => true,'align' => 'center'),array('type' => 'box','layout' => 'baseline','contents' => array(array('type' => 'text','text' => "---------------",'size' => 'xs','color' => '#8c8c8c','margin' => 'md','align' => 'center'))),array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'box','layout' => 'baseline','spacing' => 'sm','contents' => array(array('type' => 'text','text' => $realname,'wrap' => true,'color' => '#252dba','size' => 'sm','align' => 'center','action' => array('type' => 'message','label' => 'action','text' => $textcode,))))))),'spacing' => 'sm','paddingAll' => '13px','backgroundColor' => '#edece8','justifyContent' => 'space-evenly'));
array_push($result, $candidate);
$mapswitch = "on";
}
unset($json4, $data4, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}


            
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
