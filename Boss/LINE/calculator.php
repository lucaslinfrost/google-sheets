<?php
//計算機
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
        $ans = "no";
        
if (strpos($code[1], 'x') !== false) { 
$ans = "yes";
$num = explode('x', $code[1]);
$alltext = $num[0] * $num[1];
}
if (strpos($code[1], '乘') !== false) { 
$ans = "yes";
$num = explode('乘', $code[1]);
$alltext = $num[0] * $num[1];
}      
if (strpos($code[1], '/') !== false) { 
$ans = "yes";
$num = explode('/', $code[1]);
$alltext = $num[0] / $num[1];
}           
if (strpos($code[1], '除') !== false) { 
$ans = "yes";
$num = explode('除', $code[1]);
$alltext = $num[0] / $num[1];
}       
if (strpos($code[1], '加') !== false) { 
$ans = "yes";
$num = explode('加', $code[1]);
$alltext = $num[0] + $num[1];
}           
if (strpos($code[1], '+') !== false) { 
$ans = "yes";
$num = explode('+', $code[1]);
$alltext = $num[0] + $num[1];
}   
if (strpos($code[1], '減') !== false) { 
$ans = "yes";
$num = explode('減', $code[1]);
$alltext = $num[0] - $num[1];
}           
if (strpos($code[1], '-') !== false) { 
$ans = "yes";
$num = explode('-', $code[1]);
$alltext = $num[0] - $num[1];
}             

// END Google Sheet Keyword Decode
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
