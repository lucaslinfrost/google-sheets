<?php

//其他功能介面 (文字版)

require_once('./LINEBotTiny.php');

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
        // 資料起始從feed.entry          
        foreach ($data['feed']['entry'] as $item) {
            // 將keywords欄位依,切成陣列
            $keywords = explode(',', $item['gsx$key1']['$t']);

            // 以關鍵字比對文字內容
            foreach ($keywords as $keyword) {
                if (strpos($message['text'], $keyword) !== false) {                      
                    $dataall0 = $item['gsx$data10']['$t']."\n\n".$item['gsx$data11']['$t'];
                    $dataall1 = $item['gsx$data12']['$t']."\n\n".$item['gsx$data13']['$t'];
                    $dataall2 = $item['gsx$data14']['$t']."\n\n".$item['gsx$data15']['$t'];
                }
            }
        }       



        switch ($message['type']) {
            case 'text':

                $client->replyMessage(array(
                    'replyToken' => $event['replyToken'],
                    'messages' => array(
                        array(
                            'type' => 'text',                                                                
                            'text' => ''.$dataall0.'',
                        ),
                        array(
                            'type' => 'text',                                                                
                            'text' => ''.$dataall1.'',
                        ),
                        array(
                            'type' => 'text',                                                                
                            'text' => ''.$dataall2.'',
                        )
                    ),
                ));               
                break;
            default:
                error_log("Unsupporeted message type: " . $message['type']);
                break;
        }
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};                            
