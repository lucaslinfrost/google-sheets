<?php
//油價功能介面 (文字版)
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
// 取得事件(只接受文字訊息)
foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
        // 讀入訊息
        $message = $event['message'];
        $code = explode(' ', $message['text']);
        $url = 'https://gas.goodlife.tw/';
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
        $data00 = $xPath->evaluate('string(//*[@id="gas-price"]/ul/li[3]/p/text()[1])');
        $data0 = $xPath->evaluate('string(//*[@id="gas-price"]/ul/li[3]/p/text()[2])');
        $data1 = $xPath->evaluate('string(//*[@id="gas-price"]/ul/li[3]/h2/text())');
        $data01 = $xPath->evaluate('string(//*[@id="gas-price"]/ul/li[3]/h2/em/text())');
        $data001 = $xPath->evaluate('string(//*[@id="gas-price"]/ul/li[3]/h2/text()[2])');
        $data2 = $xPath->evaluate('string(//*[@id="cpc"]/ul/li[1]/text()[2])');
        $data3 = $xPath->evaluate('string(//*[@id="cpc"]/ul/li[2]/text()[2])');
        $data4 = $xPath->evaluate('string(//*[@id="cpc"]/ul/li[3]/text()[2])');
        $data5 = $xPath->evaluate('string(//*[@id="cpc"]/ul/li[4]/text()[2])');
        $data6 = $xPath->evaluate('string(//*[@id="cpc"][2]/ul/li[1]/text()[2])');
        $data7 = $xPath->evaluate('string(//*[@id="cpc"][2]/ul/li[2]/text()[2])');
        $data8 = $xPath->evaluate('string(//*[@id="cpc"][2]/ul/li[3]/text()[2])');
        $data9 = $xPath->evaluate('string(//*[@id="cpc"][2]/ul/li[4]/text()[2])');
        $data10 = $xPath->evaluate('string(//*[@id="gas-price"]/ul/li[1]/text()[2])');
        $datatime = $xPath->evaluate('string(//*[@id="main"]/p/time/text())');
        $data2 = substr($data2,-5);
        $data3 = substr($data3,-5);
        $data4 = substr($data4,-5);
        $data5 = substr($data5,-5);
        $data6 = substr($data6,-5);
        $data7 = substr($data7,-5);
        $data8 = substr($data8,-5);
        $data9 = substr($data9,-5);
        $data10 = substr($data10,-5);
        
$dataall = "最後更新時間\n".$datatime."\n\n".$data00."".$data0."".$data1."".$data01."".$data001."\n\n今日中油油價\n92 : ".$data2."\n95 : ".$data3."\n98 : ".$data4."\n柴油 : ".$data5."\n\n今日台塑油價\n92 : ".$data6."\n95 : ".$data7."\n98 : ".$data8."\n柴油 : ".$data9."\n\n柴油預計調整\n".$data10;

        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
