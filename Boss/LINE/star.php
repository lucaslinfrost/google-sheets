<?php

//星能力搜索介面(旋轉木馬版)

require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi = getenv('googledataspi3');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $json = file_get_contents('./data/star.json');
            $data = json_decode($json, true);
            $code = explode(' ', $message['text']);
            $result = array();
            foreach ($data['feed']['entry'] as $item) {
                $keywords = explode(',', $item['gsx$keyword']['$t']);
                foreach ($keywords as $keyword) {
                    if (strcmp($code[2], $keyword) === 0) {
                        if (strpos($code[1], $item['gsx$key']['$t']) !== false) {
                        $candidate = array(
                            'thumbnailImageUrl' => 'https://imgur.com/KQsuipD.png',
                            'title' => $item['gsx$name']['$t'],
                            'text' => $item['gsx$map']['$t'],
                            'actions' => array(
                                array(
                                    'type' => 'message',
                                    'label' => $item['gsx$equip']['$t'],
                                    'text' => "老大D ".$item['gsx$equip']['$t'],
                                    )
                                ),
                            );
                        array_push($result, $candidate);
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
