<?php
//生產頁(文字介面)
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
            $code = explode(' ', $message['text']);
            $alltext = "";
            $mline = "\n--------  分°Д°行  --------\n";
            foreach ($data['feed']['entry'] as $item) {
                $keywords = explode(',', $item['gsx$keyword']['$t']);
                foreach ($keywords as $keyword) {
                    if (strcmp($code[1], $keyword) === 0) {
                    
                    $alltext = $alltext."".$item['gsx$pname']['$t']."\n
                    生產等級 : ".$item['gsx$newlv']['$t']."
                    其他生產要求 : ".$item['gsx$others']['$t']."
                    材料1 : ".$item['gsx$item1']['$t']."
                    材料2 : ".$item['gsx$item2']['$t']."
                    材料3 : ".$item['gsx$item3']['$t']."
                    材料4 : ".$item['gsx$item4']['$t']."
                    大成功A : ".$item['gsx$sua']['$t']."
                    大成功B : ".$item['gsx$sub']['$t']."
                    備註 :\n".$item['gsx$remark']['$t'];
                    $alltext = $alltext."".$mline;
                    }
                }
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
