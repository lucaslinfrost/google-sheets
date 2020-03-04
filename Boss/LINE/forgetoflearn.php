<?php
//忘記學習過的字
require_once('./LINEBotTiny.php');
$access_token = getenv('LINE_CHANNEL_ACCESSTOKEN');
$secret = getenv('LINE_CHANNEL_SECRET');
$bot = new LINEBotTiny($access_token, $secret);

foreach ($bot->parseEvents() as $event) {
switch ($event['type']) {
case 'message':
$message = $event['message'];
$value = trim($message['text']);
$value = preg_replace("/\s(?=)/", "", $value);
$code = explode("#", $value);
$data = file_get_contents('./exampleJson/textReply.json');
$json_arr = json_decode($data, true);
// get array index to delete
$arr_index = array();
$wordcheck = "\"".$code[1]."\"";
$n = array ($wordcheck);  
foreach ($json_arr as $key => $value) {
if ($value['chack'] == $n) {
$arr_index[] = $key;
break;
}
}
// delete data
foreach ($arr_index as $i) {
unset($json_arr[$i]);
$talkreply = "我已經將[".$code[1]."]忘記了。";
break;
}
// rebase array
$json_arr = array_values($json_arr);
// encode array to json and save to file
file_put_contents('./exampleJson/textReply.json', json_encode($json_arr, JSON_UNESCAPED_UNICODE));
    
   break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
