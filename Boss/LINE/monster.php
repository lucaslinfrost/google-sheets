<?php

//怪物搜尋介面 (文字版)

require_once('./LINEBotTiny.php');

$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi = getenv('googledataspi');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);

// 取得事件(只接受文字訊息)
foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
        // 讀入訊息
        $message = $event['message'];

        // 將Google表單轉成JSON資料
        $json = file_get_contents($googledataspi);
        $data = json_decode($json, true);   
        $store_text1 = ""; 
        $code = explode(' ', $message['text']);
        // 資料起始從feed.entry          
        foreach ($data['feed']['entry'] as $item) {
            // 將keywords欄位依,切成陣列
            $keywords = explode(',', $item['gsx$keywords']['$t']);

            // 以關鍵字比對文字內容，符合的話將店名/地址寫入
            foreach ($keywords as $keyword) {
                if (strcmp($code[1], $keyword) === 0) {   
                    
if($item['gsx$special']['$t'] === ""){
$a = "";
}else{
$a = "
--------  特殊攻擊  --------
".$item['gsx$special']['$t'];
}
if($item['gsx$maxhp']['$t'] === ""){
$b = "";
}else{
$b = "
--------  怪物血量  --------
".$item['gsx$maxhp']['$t'];
}
if($item['gsx$map']['$t'] === ""){
$c = "";
}else{
$c = "
--------  出沒地圖  --------
".$item['gsx$map']['$t'];
}
if($item['gsx$drop1']['$t'] === ""){
$d = "";
}else{
$d = "
--------  掉落物品  --------
".$item['gsx$drop1']['$t'];
}
if($item['gsx$drop2']['$t'] === ""){
$e = "";
}else{
$e = "
".$item['gsx$drop2']['$t'];
}    
if($item['gsx$drop3']['$t'] === ""){
$f = "";
}else{
$f = "
".$item['gsx$drop3']['$t'];
}   
if($item['gsx$drop4']['$t'] === ""){
$g = "";
}else{
$g = "
".$item['gsx$drop4']['$t'];
}   
                                        
                    
$store_text1 = "怪物名稱 : ".$item['gsx$name']['$t']."
等級 : ".$item['gsx$level']['$t']."
屬性 : ".$item['gsx$attribute']['$t']."
弱點 : ".$item['gsx$week']['$t']."".$b."".$a."".$c."".$d."".$e."".$f."".$g."";
                }
            }
        }    
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
