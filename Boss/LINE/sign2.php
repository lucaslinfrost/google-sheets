<?php
//星座功能介面 (文字版)
require_once('./LINEBotTiny.php');
require_once('./utf8_chinese.class.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
// 取得事件(只接受文字訊息)
foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
        // 讀入訊息
        $message = $event['message'];
        $c = new utf8_chinese;
        $message['text'] = $c->gb2312_big5($message['text']);
        $code = explode(' ', $message['text']);
        
        if (strpos($code[1], '白羊') !== false||strpos($code[1], '牡羊') != false){$snum = '0';}
        if (strpos($code[1], '金牛') !== false||strpos($code[1], '牡牛') != false){$snum = '1';}
        if (strpos($code[1], '白羊') !== false||strpos($code[1], '牡羊') != false){$snum = '2';}
        if (strpos($code[1], '白羊') !== false||strpos($code[1], '牡羊') != false){$snum = '3';}
        if (strpos($code[1], '白羊') !== false||strpos($code[1], '牡羊') != false){$snum = '4';}
        if (strpos($code[1], '白羊') !== false||strpos($code[1], '牡羊') != false){$snum = '5';}
        if (strpos($code[1], '白羊') !== false||strpos($code[1], '牡羊') != false){$snum = '6';}
        if (strpos($code[1], '白羊') !== false||strpos($code[1], '牡羊') != false){$snum = '7';}
        if (strpos($code[1], '白羊') !== false||strpos($code[1], '牡羊') != false){$snum = '8';}
        if (strpos($code[1], '白羊') !== false||strpos($code[1], '牡羊') != false){$snum = '9';}
        if (strpos($code[1], '白羊') !== false||strpos($code[1], '牡羊') != false){$snum = '10';}
        if (strpos($code[1], '白羊') !== false||strpos($code[1], '牡羊') != false){$snum = '11';}
        
        $url = 'http://astro.click108.com.tw/daily_0.php?iAstro=';
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
        
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
