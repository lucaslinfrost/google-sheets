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
        $data2 = $xPath->evaluate('string(//*[@id="cpc"]/ul/li[1]/text())');
        $data3 = $xPath->evaluate('string(//*[@id="cpc"]/ul/li[2]/text())');
        $data4 = $xPath->evaluate('string(//*[@id="cpc"]/ul/li[3]/text())');
        $data5 = $xPath->evaluate('string(//*[@id="cpc"]/ul/li[4]/text())');
        $data6 = $xPath->evaluate('string(//*[@id="cpc"]/ul[2]/li[1]/text())');
        $data7 = $xPath->evaluate('string(//*[@id="cpc"]/ul[2]/li[2]/text())');
        $data8 = $xPath->evaluate('string(//*[@id="cpc"]/ul[2]/li[3]/text())');
        $data9 = $xPath->evaluate('string(//*[@id="cpc"]/ul[2]/li[4]/text())');
        $data10 = $xPath->evaluate('string(//*[@id="gas-price"]/ul/li[1]/text())');
        $datatime = $xPath->evaluate('string(//*[@id="main"]/p/time/text())');
            
$dataall = "最後更新時間\n".$datatime."\n\n".$data00."".$data0."".$data1."".$data01."".$data001."\n\n今日中油油價\n92 : ".$data2."\n95 : ".$data3."\n98 : ".$data4."\n柴油 : ".$data5."\n\n今日台塑油價\n92 : ".$data6."\n95 : ".$data7."\n98 : ".$data8."\n柴油 : ".$data9."\n\n柴油預計調整\n".$data10;

        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
