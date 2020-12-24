<?php
//星座功能介面 (文字版)
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
        $snum = '999';
        if (strpos($code[1], '白羊') !== false||strpos($code[1], '牡羊') !== false||strpos($code[1], '牧羊') !== false||strpos($code[1], '♈') !== false){$snum = '0';}
        if (strpos($code[1], '金牛') !== false||strpos($code[1], '牡牛') !== false||strpos($code[1], '牧牛') !== false||strpos($code[1], '♉') !== false){$snum = '1';}
        if (strpos($code[1], '雙子') !== false||strpos($code[1], '♊') !== false){$snum = '2';}
        if (strpos($code[1], '巨蟹') !== false||strpos($code[1], '♋') !== false){$snum = '3';}
        if (strpos($code[1], '獅子') !== false||strpos($code[1], '♌') !== false){$snum = '4';}
        if (strpos($code[1], '處女') !== false||strpos($code[1], '♍') !== false){$snum = '5';}
        if (strpos($code[1], '天秤') !== false||strpos($code[1], '天平') !== false||strpos($code[1], '♎') !== false){$snum = '6';}
        if (strpos($code[1], '天蠍') !== false||strpos($code[1], '♏') !== false){$snum = '7';}
        if (strpos($code[1], '射手') !== false||strpos($code[1], '♐') !== false){$snum = '8';}
        if (strpos($code[1], '魔羯') !== false||strpos($code[1], '山羊') !== false||strpos($code[1], '摩羯') !== false||strpos($code[1], '♑') !== false){$snum = '9';}
        if (strpos($code[1], '水瓶') !== false||strpos($code[1], '寶瓶') !== false||strpos($code[1], '♒') !== false){$snum = '10';}
        if (strpos($code[1], '雙魚') !== false||strpos($code[1], '♓') !== false){$snum = '11';}
        
        $url = 'https://astro.click108.com.tw/daily_0.php?iAstro='.$snum;
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
        
        $data0 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data0);
        $data1 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data1);
        $data2 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data2);
        $data3 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data3);
        $data4 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data4);
        $data5 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data5);
        $data6 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data6);
        $data7 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data7);
        $data8 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data8);
        $data9 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data9);
        $data10 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data10);
        $data11 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data11);
        $data12 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data12);
        $data13 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data13);
        $data14 = iconv("UTF-8", "ISO-8859-1//IGNORE", $data14);
        
if ($snum === "999"){
$dataall = "沒有這個星座的運勢資訊。";
}else{
$dataall = $data0." (".$datatime.")\n\n".$data1."\n".$data2."\n\n".$data3."\n".$data4."\n\n".$data5."\n".$data6."\n\n".$data7."\n".$data8."\n\n今日短評：\n".$data9."\n\n幸運數字：".$data10."\n\n幸運顏色：".$data11."\n\n開運方位：".$data12."\n\n今日吉時：".$data13."\n\n幸運星座：".$data14;
}
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
