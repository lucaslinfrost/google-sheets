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
        $opts = array('http' => array(
        'method' => "GET",
        'header' => "User-Agent Mozilla/5.0 (Windows NT 6.1; WOW64; rv:24.0) Gecko/20100101 Firefox/24.0\r\n"
        . "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n"
        . "Accept-Encoding:gzip, deflate\r\n"
        . "Accept-Language:cs,en-us;q=0.7,en;q=0.3\r\n"
        . "Connection:keep-alive\r\n"
        . "Host:your.domain.com\r\n"
        ));
        $context = stream_context_create($opts);
        $json = file_get_contents($googledataspi, FALSE, $context);

        $data = json_decode($json, true);
        $c = new utf8_chinese;
        $message['text'] = $c->gb2312_big5($message['text']);
        $code = explode(' ', $message['text']);
        // 資料起始從feed.entry          
        foreach ($data['feed']['entry'] as $item) {
            // 將keywords欄位依,切成陣列
            $keywords = explode(',', $item['gsx$key']['$t']);

            // 以關鍵字比對文字內容
            foreach ($keywords as $keyword) {
                if (strpos($code[1], $keyword) !== false) {
                    $dataall = $item['gsx$data0']['$t']." ".$item['gsx$data1']['$t']."\n\n".$item['gsx$data2']['$t']."\n".$item['gsx$data3']['$t']."\n\n".$item['gsx$data4']['$t']."\n".$item['gsx$data5']['$t']."\n\n".$item['gsx$data6']['$t']."\n".$item['gsx$data7']['$t']."\n\n".$item['gsx$data8']['$t']."\n".$item['gsx$data9']['$t'];
              }
            }
        }       
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
