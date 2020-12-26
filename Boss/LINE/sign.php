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
        if (strpos($code[1], '白羊') !== false||strpos($code[1], '牡羊') !== false||strpos($code[1], '牧羊') !== false||strpos($code[1], '♈') !== false){$snum = 'Aries';$mainname = '牡羊座';$mpic = '-19e4cfe308b9f9631a784ad6c4dff0f92ec690d9d729a3e11381b0749dc004e8.png';}
        if (strpos($code[1], '金牛') !== false||strpos($code[1], '牡牛') !== false||strpos($code[1], '牧牛') !== false||strpos($code[1], '♉') !== false){$snum = 'Taurus';$mainname = '金牛座';$mpic = '-9003a9c75b4c798997631bf1a868664017b3e0ebd01f0122d8edef1f0f3b9093.png';}
        if (strpos($code[1], '雙子') !== false||strpos($code[1], '♊') !== false){$snum = 'Gemini';$mainname = '雙子座';$mpic = '-6211c880788e0fa0aac82033a1670f305a0355568350ecdeb118dd1fa5eca80b.png';}
        if (strpos($code[1], '巨蟹') !== false||strpos($code[1], '♋') !== false){$snum = 'Cancer';$mainname = '巨蟹座';$mpic = '-35feaccf17b943f7982dfcb38c53888d97c7fe212a877844be566f966ccb841f.png';}
        if (strpos($code[1], '獅子') !== false||strpos($code[1], '♌') !== false){$snum = 'Leo';$mainname = '獅子座';$mpic = '-df7b9fbbe1b7e33c0b666b8e0e8e8a79acf11761f53b16f1bc039e01261ad023.png';}
        if (strpos($code[1], '處女') !== false||strpos($code[1], '♍') !== false){$snum = 'Virgo';$mainname = '處女座';$mpic = '-315cc8ed1161a91b053ae430c11f6ac341f34793d406143a1eb3c95607776fa3.png';}
        if (strpos($code[1], '天秤') !== false||strpos($code[1], '天平') !== false||strpos($code[1], '♎') !== false){$snum = 'Libra';$mainname = '天秤座';$mpic = '-2e32d580e9b04ca270d28aaed2ed9257d0110af6fcec82e519767e9cd8047ef9.png';}
        if (strpos($code[1], '天蠍') !== false||strpos($code[1], '♏') !== false){$snum = 'Scorpio';$mainname = '天蠍座';$mpic = '-abf39b594e52293130d4624f44d3780991e10ca22ddddde8ea24b830f2fb55d2.png';}
        if (strpos($code[1], '射手') !== false||strpos($code[1], '♐') !== false){$snum = 'Sagittarius';$mainname = '射手座';$mpic = '-9b9c53a96f77ddb95d44fc9e8cd2409a897bc3ba7cbb0be26f9d32313628f43d.png';}
        if (strpos($code[1], '魔羯') !== false||strpos($code[1], '山羊') !== false||strpos($code[1], '摩羯') !== false||strpos($code[1], '♑') !== false){$snum = 'Capricorn';$mainname = '魔羯座';$mpic = '-c275f6cb9d674a336c3619c1a8761c85cb96d7597dc75eb5a63567005bef8dd9.png';}
        if (strpos($code[1], '水瓶') !== false||strpos($code[1], '寶瓶') !== false||strpos($code[1], '♒') !== false){$snum = 'Aquarius';$mainname = '水瓶座';$mpic = '-bb68d292e4af2b3f97b2e58fa1d07a80a5dbb87dad7742f8f488b2a5d10db048.png';}
        if (strpos($code[1], '雙魚') !== false||strpos($code[1], '♓') !== false){$snum = 'Pisces';$mainname = '雙魚座';$mpic = '-9496c34f5fa73dce4c15dff2e99cfd6bcbf283bd4e44c724989d116fe917f582.png';}
        
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
	    $showpic = "https://www.daily-zodiac.com/assets/".$mainname.$mpic;
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
