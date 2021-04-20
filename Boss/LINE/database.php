<?php

//數據統計介面 (文字版)

require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$url = getenv('database');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);

// 取得事件(只接受文字訊息)
foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
        // 讀入訊息
        $message = $event['message'];

        // 將Google表單轉成JSON資料
        $json = file_get_contents($url);
        $data = json_decode($json, true);

        // 資料起始從feed.entry          
        foreach ($data['feed']['entry'] as $item) {
        $keywords = explode(',', $item['gsx$屬性']['$t']);

            // 以關鍵字比對文字內容
            foreach ($keywords as $keyword) {
                if (strcmp('database', $keyword) === 0) {                       
                    $datall = $item['gsx$弱點']['$t'];
              }
            }


        }       
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
