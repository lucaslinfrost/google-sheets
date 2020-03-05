<?php
ini_set('memory_limit', '512M');
//物品功能搜索
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$alltext = "";
$alltext1 = "";
$alltext2 = "";
$countno = 0;
$productiontime = 0;
$equiptime = 0;
$productionspare = ""; 
$equipspare = "";

foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $value = trim($message['text']);
            $value = preg_replace("/\s(?=)/", "", $value);
            $code = explode('#', $value);
                          
//生產關鍵字
if ($countno === 0) {
$json2 = file_get_contents('./data/production.json');
$data2 = json_decode($json2, true);
foreach ($data2['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$ppic']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
if ($productiontime > 50) {
$productionspare = $productionspare."".$item['gsx$pname']['$t']." → ".$item['gsx$newlv']['$t']."\n";
}else{
$alltext1 = $alltext1."".$item['gsx$pname']['$t']." → ".$item['gsx$newlv']['$t']."\n";
$productiontime = $productiontime+1;
}
}
}
}
$countno = 1;   
} 
            
//裝備關鍵字
if ($countno === 1) {
$json3 = file_get_contents('./data/equip.json');
$data3 = json_decode($json3, true);
foreach ($data3['feed']['entry'] as $item) {
$keywords = explode(',', $item['gsx$search']['$t']);
foreach ($keywords as $keyword) {
if (strcmp($code[1], $keyword) === 0) {
if ($equiptime > 50) {
$equipspare = $equipspare."".$item['gsx$name']['$t']." 【".$item['gsx$part']['$t']."】 → ".$item['gsx$smith']['$t']."[".$item['gsx$smithtype']['$t']."]\n";
}else{
$alltext2 = $alltext2."".$item['gsx$name']['$t']." 【".$item['gsx$part']['$t']."】 → ".$item['gsx$smith']['$t']."[".$item['gsx$smithtype']['$t']."]\n";
$equiptime = $equiptime+1;
}
}
}
}
$countno = 2;   
}

            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
