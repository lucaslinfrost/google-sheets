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
        if (strpos($code[1], '白羊') !== false||strpos($code[1], '牡羊') !== false||strpos($code[1], '牧羊') !== false||strpos($code[1], '♈') !== false){$snum = 'Aries';$mainname = '牡羊座';$showpic = 'https://i.imgur.com/HjKDnWp.png';}
        if (strpos($code[1], '金牛') !== false||strpos($code[1], '牡牛') !== false||strpos($code[1], '牧牛') !== false||strpos($code[1], '♉') !== false){$snum = 'Taurus';$mainname = '金牛座';$showpic = 'https://i.imgur.com/Y9aQpKc.png';}
        if (strpos($code[1], '雙子') !== false||strpos($code[1], '♊') !== false){$snum = 'Gemini';$mainname = '雙子座';$showpic = 'https://i.imgur.com/OrwPHmq.png';}
        if (strpos($code[1], '巨蟹') !== false||strpos($code[1], '♋') !== false){$snum = 'Cancer';$mainname = '巨蟹座';$showpic = 'https://i.imgur.com/DNXkfLp.png';}
        if (strpos($code[1], '獅子') !== false||strpos($code[1], '♌') !== false){$snum = 'Leo';$mainname = '獅子座';$showpic = 'https://i.imgur.com/5pSq4HZ.png';}
        if (strpos($code[1], '處女') !== false||strpos($code[1], '♍') !== false){$snum = 'Virgo';$mainname = '處女座';$showpic = 'https://i.imgur.com/4CRA6ZY.png';}
        if (strpos($code[1], '天秤') !== false||strpos($code[1], '天平') !== false||strpos($code[1], '♎') !== false){$snum = 'Libra';$mainname = '天秤座';$showpic = 'https://i.imgur.com/1ZqjWfN.png';}
        if (strpos($code[1], '天蠍') !== false||strpos($code[1], '♏') !== false){$snum = 'Scorpio';$mainname = '天蠍座';$showpic = 'https://i.imgur.com/AWXaKZs.png';}
        if (strpos($code[1], '射手') !== false||strpos($code[1], '♐') !== false){$snum = 'Sagittarius';$mainname = '射手座';$showpic = 'https://i.imgur.com/2QcygQx.png';}
        if (strpos($code[1], '魔羯') !== false||strpos($code[1], '山羊') !== false||strpos($code[1], '摩羯') !== false||strpos($code[1], '♑') !== false){$snum = 'Capricorn';$mainname = '魔羯座';$showpic = 'https://i.imgur.com/lOpNv80.png';}
        if (strpos($code[1], '水瓶') !== false||strpos($code[1], '寶瓶') !== false||strpos($code[1], '♒') !== false){$snum = 'Aquarius';$mainname = '水瓶座';$showpic = 'https://i.imgur.com/ypqkWlz.png';}
        if (strpos($code[1], '雙魚') !== false||strpos($code[1], '♓') !== false){$snum = 'Pisces';$mainname = '雙魚座';$showpic = 'https://i.imgur.com/YG5jMGP.png';}
        
        $url = 'https://www.daily-zodiac.com/zodiac/'.$snum;
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
        $data0 = $xPath->evaluate('string(//*[@id="profile"]/div/div[1]/h3/text()[1])');
        $data1 = $xPath->evaluate('string(//*//*[@id="profile"]/div/div[1]/h3/text()[2])');
        $data2 = $xPath->evaluate('string(//*//*[@id="profile"]/div/div[1]/p[1]/text())');
        $data3 = $xPath->evaluate('string(//*[@id="profile"]/div/div[1]/h2/text()[2])');
        $data0 = trim($data0);
        $data1 = trim($data1);
        $data2 = trim($data2);
        $data3 = preg_replace('/\s(?=)/', '', $data3);
        
if ($snum === "999"){
$dataall = "沒有這個星座的運勢資訊。";
}else{
$dataall = $data3."\n".$data0."\n\n".$data1."\n\n".$data2."\n\n資料來自 : 唐綺陽占星幫。";
}
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
