<?php
//鐵匠總覽(文字介面)
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $json = file_get_contents('./data/equip.json');
            $data = json_decode($json, true);
            $code = explode('#', $message['text']);
            $alltext = "";
            foreach ($data['feed']['entry'] as $item) {
                $keywords = explode(',', $item['gsx$smith']['$t']);
                foreach ($keywords as $keyword) {
                    if (strcmp($code[1], $keyword) === 0) {
$alltext = $alltext."".$item['gsx$name']['$t']." 【".$item['gsx$part']['$t']."】[".$item['gsx$smithtype']['$t']."]";
                    $alltext = $alltext."\n";
                    }
                }
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
