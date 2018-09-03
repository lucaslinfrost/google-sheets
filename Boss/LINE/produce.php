<?php

//生產頁(旋轉木馬介面)

require_once('./LINEBotTiny.php');

$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi2 = getenv('googledataspi2');

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];

            $json = file_get_contents($googledataspi2);
            $data = json_decode($json, true);
            $result = array();

            foreach ($data['feed']['entry'] as $item) {
                $keywords = explode(',', $item['gsx$keyword']['$t']);

                foreach ($keywords as $keyword) {
                    if (strpos($message['text'], $keyword) !== false) {
                        $candidate = array(
                            'thumbnailImageUrl' => 'https://imgur.com/KQsuipD.png',
                            'title' => $item['gsx$pname']['$t'],
                            'text' => $item['gsx$ptype']['$t']."等級".$item['gsx$plv']['$t'],
                            'actions' => array(
                                array(
                                    'type' => 'message',
                                    'label' => '生產配方',
                                    'text' => "".$item['gsx$pname']['$t']."\n\n生產等級 : ".$item['gsx$keyword']['$t']."\n其他生產要求 : ".$item['gsx$others']['$t']."\n材料1 : ".$item['gsx$item1']['$t']."\n材料2 : ".$item['gsx$item2']['$t']."\n材料3 : ".$item['gsx$item3']['$t']."\n材料4 : ".$item['gsx$item4']['$t']."\n大成功A : ".$item['gsx$sua']['$t']."\n大成功B : ".$item['gsx$sub']['$t']."\n備註 :\n".$item['gsx$remark']['$t'],
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
