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
        @$dom->loadHTML($html);
        // create domxpath instance
        $xPath = new DOMXPath($dom);
        // get all elements with a particular id and then loop through and print the href attribute
        $elements = $xPath->evaluate('string(//*[@id="newsList"]/li[1]/a/time/@datetime)');
        $elements1 = $xPath->evaluate('string(//*[@id="newsList"]/li[1]/a/text())');
        $dataall = $elements." ".$elements1;
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
