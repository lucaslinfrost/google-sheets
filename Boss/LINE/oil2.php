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
        $datatime = date("Y-m-d");
        $data0 = $xPath->evaluate('string(//*[@class="TODAY_CONTENT"]/h3/text())');
        $data1 = $xPath->evaluate('string(//*[@class="TODAY_CONTENT"]/p[1]/span/text())');
        $data2 = $xPath->evaluate('string(//*[@class="TODAY_CONTENT"]/p[2]/text())');
        $data3 = $xPath->evaluate('string(//*[@class="TODAY_CONTENT"]/p[3]/span/text())');
        $data4 = $xPath->evaluate('string(//*[@class="TODAY_CONTENT"]/p[4]/text())');
        $data5 = $xPath->evaluate('string(//*[@class="TODAY_CONTENT"]/p[5]/span/text())');
        $data6 = $xPath->evaluate('string(//*[@class="TODAY_CONTENT"]/p[6]/text())');
        $data7 = $xPath->evaluate('string(//*[@class="TODAY_CONTENT"]/p[7]/span/text())');
        $data8 = $xPath->evaluate('string(//*[@class="TODAY_CONTENT"]/p[8]/text())');
        $data9 = $xPath->evaluate('string(//*[@class="TODAY_WORD"]/p/text())');
        $data10 = $xPath->evaluate('string(//*[@class="LUCKY"]/h4/text())');
        $data11 = $xPath->evaluate('string(//*[@class="LUCKY"][2]/h4/text())');
        $data12 = $xPath->evaluate('string(//*[@class="LUCKY"][3]/h4/text())');
        $data13 = $xPath->evaluate('string(//*[@class="LUCKY"][4]/h4/text())');
        $data14 = $xPath->evaluate('string(//*[@class="LUCKY"][5]/h4/text())');
            

$dataall = $data0." (".$datatime.")\n\n".$data1."\n".$data2."\n\n".$data3."\n".$data4."\n\n".$data5."\n".$data6."\n\n".$data7."\n".$data8."\n\n今日短評：\n".$data9."\n\n幸運數字：".$data10."\n\n幸運顏色：".$data11."\n\n開運方位：".$data12."\n\n今日吉時：".$data13."\n\n幸運星座：".$data14;

        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
