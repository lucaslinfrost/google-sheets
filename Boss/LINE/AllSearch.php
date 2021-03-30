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
            $a = "";
            $b = "";
            $c = "";
            $d = "";
            $e = "";
            $f = "";
            $g = "";
            $countno = 0;
            $TitleName = "";
            $RealName = "";
            $TextCode = "";
            $result = array();
            $altText = "關於 ".$message['text']." 的資料";
            $candidate = array('type' => 'bubble','size' => 'micro','hero' => array('type' => 'image','url' => 'https://imgur.com/KQsuipD.png','size' => 'full','aspectMode' => 'fit','aspectRatio' => '320:213'),'body' => array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'text','text' => $TitleName,'weight' => 'bold','size' => 'sm','wrap' => true,'align' => 'center'),array('type' => 'box','layout' => 'baseline','contents' => array(array('type' => 'text','text' => '--------------------','size' => 'xs','color' => '#8c8c8c','margin' => 'md','align' => 'center'))),array('type' => 'box','layout' => 'vertical','contents' => array(array('type' => 'box','layout' => 'baseline','spacing' => 'sm','contents' => array(array('type' => 'text','text' => $RealName,'wrap' => true,'color' => '#252dba','size' => 'sm','align' => 'center','action' => array('type' => 'message','label' => 'action','text' => $TextCode,))))))),'spacing' => 'sm','paddingAll' => '13px','backgroundColor' => '#edece8','justifyContent' => 'space-evenly'));
            
//怪物關鍵字
if ($countno === 0) {
$json0 = file_get_contents('./data/m&d.json');
$data0 = json_decode($json0, true);
foreach ($data0['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$keywords']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$TitleName = "怪物資訊";
$RealName = $item['gsx$name']['$t'];
$TextCode = "老大M ".$RealName;
$candidate = $candidate;
array_push($result, $candidate);
unset($json0, $data0, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}

//掉落物關鍵字
if ($countno === 1) {
$json1 = file_get_contents('./data/m&d.json');
$data1 = json_decode($json1, true);
foreach ($data1['feed']['entry'] as $item) {
$keywords = explode('、', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$TitleName = "掉落資訊";
$RealName = $code[1];
$TextCode = "老大D ".$RealName;
$candidate = $candidate;
array_push($result, $candidate);
unset($json1, $data1, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}
            
//生產關鍵字
if ($countno === 2) {
$json2 = file_get_contents('./data/production.json');
$data2 = json_decode($json2, true);
foreach ($data2['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$keyword']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$c = "[搜尋生產] p指令\n";
unset($json2, $data2, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
} 
            
//裝備關鍵字
if ($countno === 3) {
$json3 = file_get_contents('./data/equip.json');
$data3 = json_decode($json3, true);
foreach ($data3['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$d = "[搜尋裝備] e指令\n";
unset($json3, $data3, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}
            
//石頭關鍵字  
if ($countno === 4) {
$json4 = file_get_contents('./data/rock.json');
$data4 = json_decode($json4, true);            
foreach ($data4['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$e = "[搜尋寶石] r指令\n";
unset($json4, $data4, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}
            
//栽培關鍵字
if ($countno === 5) {
$json5 = file_get_contents('./data/seed.json');
$data5 = json_decode($json5, true);
foreach ($data5['feed']['entry'] as $item) {
$keywords = explode('、', $item['gsx$key2']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$f = "[搜尋栽培] 栽培指令\n";
unset($json5, $data5, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}
            
//採礦關鍵字   
if ($countno === 6) {
$json6 = file_get_contents('./data/drill.json');
$data6 = json_decode($json6, true);
foreach ($data6['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$g = "[搜尋挖礦] 挖礦指令\n";
unset($json6, $data6, $keywords, $keyword);
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