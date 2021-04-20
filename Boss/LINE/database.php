<?php

//數據統計介面 (文字版)

require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$url = "https://spreadsheets.google.com/feeds/list/1DF1BBZUPVGWHLN6V4W_2G2ZzfIo3iU67Mr1Fu85ZMMg/on92vnb/public/values?alt=json";
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

                   
                    $datall = $item['gsx$屬性']['$t'][];


        }       
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
