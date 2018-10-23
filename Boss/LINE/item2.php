<?php
//生產頁(素材搜索介面)
require_once('./LINEBotTiny.php');
require_once('./utf8_chinese.class.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi2 = getenv('googledataspi2');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $json = file_get_contents($googledataspi2);
            $data = json_decode($json, true);
            $c = new utf8_chinese;
            $message['text'] = $c->gb2312_big5($message['text']);
            $code = explode('#', $message['text']);
            $alltext = "";
            foreach ($data['feed']['entry'] as $item) {
                $keywords = explode(',', $item['gsx$ppic']['$t']);
                foreach ($keywords as $keyword) {
                    if (strcmp($code[1], $keyword) === 0) {
                    
$alltext = $alltext."".$item['gsx$pname']['$t']." → ".$item['gsx$newlv']['$t']."\n";
                    }
                }
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
