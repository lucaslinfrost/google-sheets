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
                    }else{
                    if($code[2] === ""){
                    return buildTextMessage('資料庫沒有相關 資料喔。');
                    }else{
                    $starall = "《星能力一覽》\n\n請輸入:老大 星能 [能力]\n\n生命力\n精神力\n攻撃力\n物理防禦\n魔法防禦\n魔法力\n命中\n迴避\n亂舞\n速唱\n力士\n魔導\n體力\n神速\n巧技\n必殺\n高速使用\n高速冷卻\n自癒\n節能\n挑釁\n緩和\n治療\n藥學\n技術\n自動\n比例減輕\n癒受\n火的加護\n水的加護\n風的加護\n地的加護\n光的加護\n暗的加護\n物理貫通\n固定物理\n魔法狂化\n固定魔法\n魔法貫通\n範圍減輕\n反射\n夥伴\n收集家\n努力家";
                    return buildTextMessage(''.$starall.'');
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
