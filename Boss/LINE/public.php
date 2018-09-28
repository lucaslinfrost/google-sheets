<?php

//其他功能介面 (文字版)

require_once('./LINEBotTiny.php');

$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi = getenv('googledataspi5');
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
            $keywords = explode(',', $item['gsx$title']['$t']);

            // 以關鍵字比對文字內容
            foreach ($keywords as $keyword) {
                if (strpos($message['text'], $keyword) !== false) {
                    if (strpos($item['gsx$groupid']['$t'], $groupId) !== false) {
                    $data999 = "╭☆ ╭╧╮╭╧╮╭╧╮╭☆\n╰╮ ║夢│║想│║家│╰╮\n☆╰ ╘∞╛╘∞╛╘∞╛☆╮\n\n".$item['gsx$message']['$t']."\n\n(ノ・ω・)ノ發佈者ヾ(・ω・ヾ)\n".$item['gsx$name']['$t'];             
                    }
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
                            'text' => ''.$data999.'',
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
