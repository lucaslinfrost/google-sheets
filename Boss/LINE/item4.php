<?php
//所有頁(素材搜索介面)
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            
            
            $json2 = file_get_contents('./data/production.json');
            
            $json4 = file_get_contents('./data/rock.json');
            $json5 = file_get_contents('./data/seed.json');
            $json6 = file_get_contents('./data/drill.json');
            
            
            $data2 = json_decode($json2, true);
            
            $data4 = json_decode($json4, true);
            $data5 = json_decode($json5, true);
            $data6 = json_decode($json6, true);
            $code = explode(' ', $message['text']);
            $alltext = "";
            $a = "";
            $b = "";
            $c = "";
            $d = "";
            $e = "";
            $f = "";
            $g = "";
            
//怪物關鍵字
$json0 = file_get_contents('./data/m&d.json');
$data0 = json_decode($json0, true);
foreach ($data0['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$keywords']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$a = "[搜尋怪物] m指令\n";
unset($json0, $data0, $keywords, $keyword);
}
}
}

//掉落物關鍵字
$json1 = file_get_contents('./data/m&d.json');
$data1 = json_decode($json1, true);
foreach ($data1['feed']['entry'] as $item) {
$keywords = explode('、', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$b = "[搜尋物品] d指令\n";
unset($json1, $data1, $keywords, $keyword);
}
}
}
            
//生產關鍵字         
foreach ($data2['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$keyword']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$c = "[搜尋生產] p指令\n";
unset($json2, $data2, $keywords, $keyword);
}
}
}
            
//裝備關鍵字
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
            
//石頭關鍵字         
foreach ($data4['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$e = "[搜尋寶石] r指令\n";
unset($json4, $data4, $keywords, $keyword);
}
}
}
            
//栽培關鍵字            
foreach ($data5['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$f = "[搜尋栽培] 栽培指令\n";
unset($json5, $data5, $keywords, $keyword);
}
}
}
            
//採礦關鍵字           
foreach ($data6['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$g = "[搜尋挖礦] 挖礦指令\n";
unset($json6, $data6, $keywords, $keyword);
}
}
}            
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
