<?php
//栽培搜尋介面(文字版)
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
        // 將Google表單轉成JSON資料
        $json = file_get_contents('./data/seed.json');
        $data = json_decode($json, true); 
        $c = new utf8_chinese;
        $message['text'] = $c->gb2312_big5($message['text']);
        $code = explode(' ', $message['text']);
        $alltext = "";
        // 資料起始從feed.entry          
        foreach ($data['feed']['entry'] as $item) {
            // 將keywords欄位依,切成陣列
            $keywords = explode(',', $item['gsx$key']['$t']);
            // 以關鍵字比對文字內容，符合的話將店名/地址寫入
            foreach ($keywords as $keyword) {
                if (strcmp($code[1], $keyword) === 0) {  
                    
if($item['gsx$name']['$t'] === ""){
$a = "";
}else{
$a = "【".$item['gsx$name']['$t']."】";
}                   
if($item['gsx$time']['$t'] === ""){
$b = "";
}else{
$b = "
收成次數 : ".$item['gsx$time']['$t'];
}                    
if($item['gsx$date1']['$t'] === ""){
$c = "";
}else{
$c = "
--------  收°Д°成  -------- 
▸".$item['gsx$date1']['$t']."◂";
}              
if($item['gsx$got1']['$t'] === ""){
$d = "";
}else{
$d = "
".$item['gsx$got1']['$t'];
}

if($item['gsx$date2']['$t'] === ""){
$e = "";
}else{
$e = "

▸".$item['gsx$date2']['$t']."◂";
}
if($item['gsx$got2']['$t'] === ""){
$f = "";
}else{
$f = "
".$item['gsx$got2']['$t'];
}
if($item['gsx$pt']['$t'] === ""){
$g = "";
}else{
$g = "
收成可獲得".$item['gsx$pt']['$t']."PT小島點數。";
}
                    
$alltext = $a."".$b."".$g."".$c."".$d."".$e."".$f;
$pic = $item['gsx$pic']['$t'];
}
}
}
// END Google Sheet Keyword Decode
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
