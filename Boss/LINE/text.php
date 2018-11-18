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
        $code1 = "拜倫"; 
        $code2 = "洛庫"; 
        foreach ($data['feed']['entry'] as $item) {
            $keywords = explode(',', $item['gsx$key']['$t']);
            foreach ($keywords as $keyword) {
                if (strcmp($code1, $keyword) === 0) {                      
                $mappush1 = $item['gsx$mapname']['$t'];     
                }else{       
                $mappush1 = $code[1];      
                }
                if (strcmp($code2, $keyword) === 0) {                      
                $mappush2 = $item['gsx$mapname']['$t'];     
                }else{       
                $mappush2 = $code[2];      
                }
}
}
error_log("第1圖".$mappush1."   第2圖".$mappush2."");
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
