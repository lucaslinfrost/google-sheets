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
            $code = explode('#', $message['text']);
            $alltext = "";
            $a = "";
            $b = "";
            $mline = "\n--------  分°Д°行  --------\n";

$json0 = file_get_contents('./data/equip.json');
$data0 = json_decode($json0, true);
$json1 = file_get_contents('./data/autoformula.json');
$data1 = json_decode($json1, true);
            
foreach ($data0['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$key']['$t']);
foreach ($keywords as $keyword) {
    
if (strcmp($code[1], $keyword) === 0) {
$a = "【".$item['gsx$name']['$t']."】
公式 :
".$item['gsx$equipformula']['$t'];
}
    
foreach ($data1'feed']['entry'] as $item1) {
$keywords1 = $item1['gsx$autonum']['$t'];
foreach ($keywords1 as $keyword1) {
if (strpos($a, $keyword1) !== false) {
if (strpos($a, 'equipidAutoskill') !== false) {
$b = "

自動技能"."【".$item1['gsx$autoname']['$t']."】
".$item1['gsx$autoformula']['$t'];
$alltext = $alltext."".$a."".$b;
$alltext = $alltext."".$mline;
}
}else{
$alltext = $alltext."".$a;
$alltext = $alltext."".$mline;
}
}
}
    
    
}
}







            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
