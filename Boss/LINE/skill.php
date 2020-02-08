<?php

//技能搜索介面(旋轉木馬版)

require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $json = file_get_contents('./data/s.json');
            $data = json_decode($json, true);
            $code = explode(' ', $message['text']);
            $result = array();
            $altText = "關於 ".$message['text']." 的資料";
            foreach ($data['feed']['entry'] as $item) {
                $keywords = explode(',', $item['gsx$job']['$t']);
                foreach ($keywords as $keyword) {
                        if (strcmp($code[1], $keyword) === 0) {
                        $candidate = array(
                            'thumbnailImageUrl' => 'https://imgur.com/KQsuipD.png',
                            'title' => $item['gsx$job']['$t'],
                            'text' => $item['gsx$job']['$t'],
                            'actions' => array(
                                array(
                                    'type' => 'message',
                                    'label' => $item['gsx$equip']['$t'],
                                    'text' => "老大D ".$item['gsx$equip']['$t'],
                                    ),
                       		array(
                            	    'type' => 'message',
                                    'label' => $item['gsx$equip']['$t'],
                                    'text' => "老大D ".$item['gsx$equip']['$t'],
                                    ),
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

            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};