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
            $json1 = file_get_contents('./data/m&d.json');
            $json2 = file_get_contents('./data/production.json');
            $json3 = file_get_contents('./data/equip.json');
            $json4 = file_get_contents('./data/rock.json');
            $json5 = file_get_contents('./data/seed.json');
            $json6 = file_get_contents('./data/drill.json');
            $data1 = json_decode($json1, true);
            $data2 = json_decode($json2, true);
            $data3 = json_decode($json3, true);
            $data4 = json_decode($json4, true);
            $data5 = json_decode($json5, true);
            $data6 = json_decode($json6, true);
            $code = explode(' ', $message['text']);
            $alltext = "";
       
foreach ($data1['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$keywords']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$alltext = $alltext."[搜尋怪物]m指令\n";
}
}
}

foreach ($data1['feed']['entry'] as $item) {
$keywords = explode('、', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$alltext = $alltext."[搜尋物品]d指令\n";
}
}
}
            
foreach ($data2['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$keyword']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$alltext = $alltext."[搜尋生產]p指令\n";
}
}
}
            
foreach ($data3['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$alltext = $alltext."[搜尋裝備]m指令\n";
}
}
}
            
foreach ($data4['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$alltext = $alltext."[搜尋寶石]m指令\n";
}
}
}
            
foreach ($data5['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$alltext = $alltext."[搜尋栽培]栽培指令\n";
}
}
}
            
foreach ($data6['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$alltext = $alltext."[搜尋挖礦]挖礦指令\n";
}
}
}            
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
