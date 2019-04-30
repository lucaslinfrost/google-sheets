<?php

//其他功能介面 (文字版)

require_once('./LINEBotTiny.php');

$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi = getenv('googledataspi5');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);

$local = ('./data/public.json');
curlDownload($googledataspi, $local);
function curlDownload($googledataspi, $local){
    $ch = curl_init($googledataspi);
    $fp = fopen($local, "wb");
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $res = curl_exec($ch);
    curl_close($ch);
    fclose($fp);    return $res;
}

// 取得事件(只接受文字訊息)
foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
        // 讀入訊息
        $message = $event['message'];

        // 將Google表單轉成JSON資料
        $json = file_get_contents('./data/public.json');
        $data = json_decode($json, true); 
        $data999 = "";
        $code = explode(' ', $message['text']);
        // 資料起始從feed.entry          
        foreach ($data['feed']['entry'] as $item) {
            // 將keywords欄位依,切成陣列
            $keywords = explode(',', $item['gsx$title']['$t']);

            // 以關鍵字比對文字內容
            foreach ($keywords as $keyword) {
                if($code[1] === Null) {$code[1] = "公告";}
                if (strcmp($code[1], $keyword) === 0) {
                    
if($item['gsx$history']['$t'] === ""){
$a = "";
}else{
$a = "

--------活動歷史--------
".$item['gsx$history']['$t'];
}
                    $data999 = "╭☆╭╧╮╭╧╮╭╧╮\n╰╮║公║║告║║欄║\n☆╰╘∞╛╘∞╛╘∞╛\n\n".$item['gsx$message']['$t']."".$a."\n\n(ノ・ω・)ノ發佈者\n".$item['gsx$name']['$t']."\nヾ(・ω・ヾ)發佈時間\n".$item['gsx$date']['$t'];
               }
            }
        }    
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
