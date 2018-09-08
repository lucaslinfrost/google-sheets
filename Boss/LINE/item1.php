<?php
//掉落物品搜尋介面(文字版)
require_once('./LINEBotTiny.php');
require_once('./utf8_chinese.class.php');
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
        $c = new utf8_chinese;
        $message['text'] = $c->gb2312_big5($message['text']);
        $code = explode(' ', $message['text']);
        $alltext = "";
        $mline = "\n--------  分°Д°行  --------\n";
        // 資料起始從feed.entry          
        foreach ($data['feed']['entry'] as $item) {
            // 將keywords欄位依,切成陣列
            $keywords = explode('、', $item['gsx$key']['$t']);
            // 以關鍵字比對文字內容，符合的話將店名/地址寫入
            foreach ($keywords as $keyword) {
                if (strcmp($code[1], $keyword) === 0) {    

                $alltext = $alltext."怪物 : ".$item['gsx$name']['$t']."\n等級 : ".$item['gsx$level']['$t']."\n地圖 :\n".$item['gsx$map']['$t']."\n掉落 :\n".$item['gsx$drop1']['$t']."\n".$item['gsx$drop2']['$t']."\n".$item['gsx$drop3']['$t']."\n".$item['gsx$drop4']['$t'];
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
