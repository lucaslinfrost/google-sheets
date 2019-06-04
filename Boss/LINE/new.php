<?php
//其他功能介面 (文字版)
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
// 取得事件(只接受文字訊息)
foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
        // 讀入訊息
        $altText = "最新公告~~!!";
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
        $data3 = $xPath->evaluate('string(//*[@id="newsList"]/li[2]/a/text())'); //第二筆文字
        $data4 = $xPath->evaluate('string(//*[@id="newsList"]/li[2]/a/time/@datetime)'); //第二筆日期
        $data5 = $xPath->evaluate('string(//*[@id="newsList"]/li[2]/a/@href)'); //第二筆網址
        $data6 = $xPath->evaluate('string(//*[@id="newsList"]/li[3]/a/text())'); //第三筆文字
        $data7 = $xPath->evaluate('string(//*[@id="newsList"]/li[3]/a/time/@datetime)'); //第三筆日期
        $data8 = $xPath->evaluate('string(//*[@id="newsList"]/li[3]/a/@href)'); //第三筆網址

        $result = array(array(
                            'thumbnailImageUrl' => 'https://imgur.com/KQsuipD.png',
                            'title' => $data0,
                            'text' => $data1,
                            'actions' => array(
                                array(
                                    'type' => 'uri',
                                    'label' => '詳細資訊',
                                    'uri' => $data2
                                     )
                             )
                         ),
                         array(
                            'thumbnailImageUrl' => 'https://imgur.com/KQsuipD.png',
                            'title' => $data3,
                            'text' => $data4,
                            'actions' => array(
                                array(
                                    'type' => 'uri',
                                    'label' => '詳細資訊',
                                    'uri' => $data5
                                     )
                             )
                         ),
                         array(
                            'thumbnailImageUrl' => 'https://imgur.com/KQsuipD.png',
                            'title' => $data6,
                            'text' => $data7,
                            'actions' => array(
                                array(
                                    'type' => 'uri',
                                    'label' => '詳細資訊',
                                    'uri' => $data8
                                     )
                             )
                         ));
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
