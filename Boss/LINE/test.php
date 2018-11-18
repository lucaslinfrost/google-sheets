<?php
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi = getenv('googledataspi9');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $json = file_get_contents($googledataspi);
            $data = json_decode($json, true);
            $code = explode('#', $message['text']);
            foreach ($data['feed']['entry'] as $item) {
                $keywords = explode(',', $item['gsx$key']['$t']);
                foreach ($keywords as $keyword) {
                    if (strcmp($code[1], $keyword) === 0) {
                    $mappush1 = $item['gsx$mapn']['$t']; 
                    }else{
                    $mappush1 = $code[1];
                    }
                    if (strcmp($code[2], $keyword) === 0) {
                    $mappush2 = $item['gsx$mapn']['$t']; 
                    }else{
                    $mappush2 = $code[2];
                    }
                }
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
