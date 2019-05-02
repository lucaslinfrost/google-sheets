<?php
//其他功能介面 (文字版)
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
header("Content-Type: text/html;charset=utf-8");  
// 取得事件(只接受文字訊息)
foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
        // 讀入訊息
        $message = $event['message'];
   
        $url = 'http://tw.iruna-online.com/index#news';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FILE, fopen('php://stdout', 'w'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        $html = curl_exec($ch); 
        curl_close($ch);
        // create document object model
        $dom = new DOMDocument();
        // load html into document object model
        @$dom->loadHTML('<?xml encoding="UTF-8">' . $html);
        // create domxpath instance
        $xPath = new DOMXPath($dom);
        // get all elements with a particular id and then loop through and print the href attribute
        $data0 = $xPath->evaluate('string(//*[@id="newsList"]/li[1]/a/text())'); //第一筆文字
        $data1 = $xPath->evaluate('string(//*[@id="newsList"]/li[1]/a/time/@datetime)'); //第一筆日期
        $data2 = $xPath->evaluate('string(//*[@id="newsList"]/li[1]/a/@href)'); //第一筆網址
        $dataall = array(
                            'thumbnailImageUrl' => 'https://imgur.com/KQsuipD.png',
                            'title' => $data0,
                            'text' => $data1,
                            'actions' => array(
                                array(
                                    'type' => 'uri',
                                    'linkUri' => $data2,
                                    'text' => "老大D ".$item['gsx$equip']['$t'],
                                    )
                                ),
                            );
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
