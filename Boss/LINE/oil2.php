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
        $data11 = $xPath->evaluate('string(//*[@id="gas-price"]/ul/li[1]/text()[3])');
        $datatime = $xPath->evaluate('string(//*[@id="main"]/p/time/text())');
        $data2 = preg_replace('/\s(?=)/', '', $data2);
        $data3 = preg_replace('/\s(?=)/', '', $data3);
        $data4 = preg_replace('/\s(?=)/', '', $data4);
        $data5 = preg_replace('/\s(?=)/', '', $data5);
        $data6 = preg_replace('/\s(?=)/', '', $data6);
        $data7 = preg_replace('/\s(?=)/', '', $data7);
        $data8 = preg_replace('/\s(?=)/', '', $data8);
        $data9 = preg_replace('/\s(?=)/', '', $data9);
        $data10 = preg_replace('/\s(?=)/', '', $data10);
        
$dataall = "最後更新時間\n".$datatime."\n\n".$data00."".$data0."".$data1."".$data01."".$data001."\n\n【今日中油油價】\n92 : ".$data2."\n95 : ".$data3."\n98 : ".$data4."\n柴油 : ".$data5."\n\n【今日台塑油價】\n92 : ".$data6."\n95 : ".$data7."\n98 : ".$data8."\n柴油 : ".$data9."\n\n【柴油預計調整】\n".$data10."".$data11;

        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
