<?php

//怪物搜尋介面 (文字最初版)

require_once('./LINEBotTiny.php');

$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi = getenv('googledataspi');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);

// 取得事件(只接受文字訊息)
foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
        // 讀入訊息
        $message = $event['message'];

        // 將Google表單轉成JSON資料
        $json = file_get_contents($googledataspi);
        $data = json_decode($json, true);           
        $store_text1 = "找不到"; 
        $code = explode(' ', $message['text']);
        // 資料起始從feed.entry          
        foreach ($data['feed']['entry'] as $item) {
            // 將keywords欄位依,切成陣列
            $keywords = explode(',', $item['gsx$keywords']['$t']);

            // 以關鍵字比對文字內容，符合的話將店名/地址寫入
            foreach ($keywords as $keyword) {
                if (strpos($code[1], $keyword) !== false) {                      
                    $store_text1 = $item['gsx$title1']['$t']."".$item['gsx$name']['$t']."".$item['gsx$title2']['$t']."".$item['gsx$level']['$t']."\n".$item['gsx$special']['$t']."".$item['gsx$title3']['$t']."".$item['gsx$map']['$t']."".$item['gsx$title5']['$t']."".$item['gsx$attribute']['$t']."".$item['gsx$title6']['$t']."".$item['gsx$week']['$t']."".$item['gsx$title4']['$t']."".$item['gsx$drop1']['$t']."\n".$item['gsx$drop2']['$t']."\n".$item['gsx$drop3']['$t']."\n".$item['gsx$drop4']['$t'];
                    $store_text4 = $item['gsx$photo']['$t']; 
                }
            }
        }       
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
