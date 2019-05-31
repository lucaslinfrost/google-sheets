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
