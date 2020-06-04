<?php

//星座功能介面 (文字版)

require_once('./LINEBotTiny.php');
require_once('./utf8_chinese.class.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi = getenv('googledataspi4');
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
        $c = new utf8_chinese;
        $message['text'] = $c->gb2312_big5($message['text']);
        $code = explode(' ', $message['text']);
        $datatime = date("Y-m-d");
        // 資料起始從feed.entry          
        foreach ($data['feed']['entry'] as $item) {
            // 將keywords欄位依,切成陣列
            $keywords = explode(',', $item['gsx$key']['$t']);

            // 以關鍵字比對文字內容
            foreach ($keywords as $keyword) {
                if (strpos($code[1], $keyword) === 0) {
                $dataall = $item['gsx$data1']['$t']." (".$datatime.")\n\n".$item['gsx$data2']['$t']."\n".$item['gsx$data3']['$t']."\n\n".$item['gsx$data4']['$t']."\n".$item['gsx$data5']['$t']."\n\n".$item['gsx$data6']['$t']."\n".$item['gsx$data7']['$t']."\n\n".$item['gsx$data8']['$t']."\n".$item['gsx$data9']['$t'];
                }else{
                $dataall = "沒有這個星座的運勢資訊。";
                }
            }
        }       
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};