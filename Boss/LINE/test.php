<?php
//裝備查詢頁(文字介面)
require_once('./LINEBotTiny.php');
require_once('./utf8_chinese.class.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi = getenv('googledataspi6');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $json = file_get_contents($googledataspi);
            $data = json_decode($json, true);
            $c = new utf8_chinese;
            $message['text'] = $c->gb2312_big5($message['text']);
            $code = explode(' ', $message['text']);
            $alltext = "";
            $mline = "\n--------  分°Д°行  --------\n";
            foreach ($data['feed']['entry'] as $item) {
                $keywords = explode(',', $item['gsx$key']['$t']);
                foreach ($keywords as $keyword) {
                    if (strcmp($code[1], $keyword) === 0) {
if($item['gsx$atk']['$t'] === ""){
$a = "";
}else{
$a = "
ATK : ".$item['gsx$atk']['$t'];
}
if($item['gsx$def']['$t'] === ""){
$b = "";
}else{                        
$b = "
DEF : ".$item['gsx$def']['$t'];
}
if($item['gsx$slot']['$t'] === ""){
$c = "";
}else{
$c = "
※最少都有".$item['gsx$slot']['$t']."洞";
}
if($item['gsx$remark']['$t'] === ""){
$d = "";
}else{
$d = "
".$item['gsx$remark']['$t'];
}

                    
$alltext = $alltext."".$item['gsx$name']['$t']." 【".$item['gsx$part']['$t']."】
".$a."".$b."".$c."
".$d;
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
