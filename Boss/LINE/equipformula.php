<?php
//裝備公式
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $code = explode(' ', $message['text']);
            $alltext = "";
            $a = "";
            $b = "";
            $countno = 0;

if ($countno === 0) {
$json0 = file_get_contents('./data/equip.json');
$data0 = json_decode($json0, true);
foreach ($data0['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
$a = "公式 :
".$item['gsx$equipformula']['$t'];
unset($json0, $data0, $keywords, $keyword);
}
}
}
$countno = $countno+1;   
}


if ($countno === 1 {
$json1 = file_get_contents('./data/autoformula.json');
$data1 = json_decode($json1, true);
foreach ($data1'feed']['entry'] as $item) {
$keywords = $item['gsx$autonum']['$t'];
foreach ($keywords as $keyword) {
if (strpos($code[1], $keyword) !== false) {
$a = "公式 :
".$item['gsx$equipformula']['$t'];
unset($json0, $data0, $keywords, $keyword);
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
