<?php
//挖礦搜尋介面(文字版)
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
        $json = file_get_contents('./data/drill.json');
        $data = json_decode($json, true); 
        $c = new utf8_chinese;
        $message['text'] = $c->gb2312_big5($message['text']);
        $code = explode(' ', $message['text']);
        $alltext = "";
        $mline = "\n--------  分°Д°行  --------\n";
        // 資料起始從feed.entry          
        foreach ($data['feed']['entry'] as $item) {
            // 將keywords欄位依,切成陣列
            $keywords = explode(',', $item['gsx$key']['$t']);
            // 以關鍵字比對文字內容，符合的話將店名/地址寫入
            foreach ($keywords as $keyword) {
                if (strcmp($code[1], $keyword) === 0) {  
                    
if($item['gsx$place']['$t'] === ""){
$a = "";
}else{
$a = "《".$item['gsx$place']['$t']."》";
}
                    
if($item['gsx$drill']['$t'] === ""){
$b = "";
}else{
$b = "
採礦點 : ".$item['gsx$drill']['$t'];
}
                    
if($item['gsx$item1']['$t'] === ""){
$c = "";
}else{
$c = "
採礦項目 : 
".$item['gsx$item1']['$t'];
}
                    
if($item['gsx$item2']['$t'] === ""){
$d = "";
}else{
if($item['gsx$item1']['$t'] === ""){
$d = "".$item['gsx$item2']['$t'];
}else{
$d = "
".$item['gsx$item2']['$t'];
}
}

if($item['gsx$item3']['$t'] === ""){
$e = "";
}else{
$e = "
".$item['gsx$item3']['$t'];
}

if($item['gsx$item4']['$t'] === ""){
$f = "";
}else{
$f = "
".$item['gsx$item4']['$t'];
}

if($item['gsx$item5']['$t'] === ""){
$g = "";
}else{
$g = "
".$item['gsx$item5']['$t'];
}
                    
$alltext = $alltext."".$a."".$b."".$c."".$d."".$e."".$f."".$g;
                $alltext = $alltext."".$mline;
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
