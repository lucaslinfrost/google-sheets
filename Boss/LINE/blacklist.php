<?php

//黑名單搜索
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi = getenv('googledataspi0');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
// 取得事件(只接受文字訊息)
foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
        // 讀入訊息
        $message = $event['message'];
        $source = $event['source'];
        $userId = $source['userId'];
        // 將Google表單轉成JSON資料
        $json = file_get_contents($googledataspi);
        $data = json_decode($json, true);   
        // 資料起始從feed.entry          
        foreach ($data['feed']['entry'] as $item) {
            // 將keywords欄位依,切成陣列
            $keywords = explode(',', $item['gsx$usermid']['$t']);
            // 查看是否黑名單
            foreach ($keywords as $keyword) {
                if (strcmp($userId, $keyword) = FALSE) {  
                $client->replyMessage(array(
                    'replyToken' => $event['replyToken'],
                    'messages' => array(
                        array(
                        'type' => 'text',
'text' => '你沒有使用老大的權限!
◥(ฅº￦ºฅ)◤',
                        )
                    ),
                )); 
            }
        } 
     }
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
