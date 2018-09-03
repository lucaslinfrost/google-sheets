<?php

//掉落物品搜尋介面(旋轉木馬試做版)

require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi = getenv('googledataspi');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $json = file_get_contents($googledataspi);
            $data = json_decode($json, true);
            $result = array();
            foreach ($data['feed']['entry'] as $item) {
                $keywords = explode('、', $item['gsx$key']['$t']);
                foreach ($keywords as $keyword) {
                    if (strpos($message['text'], $keyword) !== false) {
                        $candidate = array(
                            'thumbnailImageUrl' => 'https://imgur.com/KQsuipD.png',
                            'title' => $item['gsx$name']['$t'],
                            'text' => $item['gsx$type']['$t']."等級".$item['gsx$level']['$t'],
                            'actions' => array(
                                array(
                                    'type' => 'message',
                                    'label' => '詳細資訊',
                                    'text' => "怪物名稱 : ".$item['gsx$name']['$t']."\n等級 : ".$item['gsx$level']['$t']."\n--------  出沒地圖  --------\n".$item['gsx$map']['$t']."\n--------  掉落資訊  --------\n".$item['gsx$drop1']['$t']."\n".$item['gsx$drop2']['$t']."\n".$item['gsx$drop3']['$t']."\n".$item['gsx$drop4']['$t'],
                                    )
                                ),
                            );
                        array_push($result, $candidate);
                    }
                }
            }
            switch ($message['type']) {
                case 'text':
                    $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'template',
                                'altText' => '關於 '.$message['text'].' 的資料',
                                'template' => array(
                                    'type' => 'carousel',
                                    'columns' => $result,
                                )
                            ),
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
