<?php
require_once('./LINEBotTiny.php');
$access_token = getenv('LINE_CHANNEL_ACCESSTOKEN');
$secret = getenv('LINE_CHANNEL_SECRET');
$bot = new LINEBotTiny($access_token, $secret);

function trim_value($value){
$value = trim($value);
$value = preg_replace('/\s(?=)/', "", $value);
}

foreach ($bot->parseEvents() as $event) {
switch ($event['type']) {
case 'message':

$message = $event['message'];
$message['text'] = trim_value($message['text']);
$code = explode('#', $message['text']);
$forbid = array("老大", "幹", "機掰", "雞掰", "");
$firstcheck = in_array($code[1], $forbid);
  
if ($firstcheck) {
$talkreply = "你輸入的內容包含禁止使用文字。";
}else{
$json = file_get_contents('./exampleJson/textReply.json');
$file = fopen("./exampleJson/textReply.json", "w+");
$upfile = json_decode($json, true);
$update = array ('chack' => array ($code[1]),'text' => array ($code[2]),);
array_push($upfile, $update);
$upfile = json_encode($upfile, JSON_UNESCAPED_UNICODE);
fwrite($file, $upfile);
$talkreply = "我學會了!~";
fclose($file); 
}

    break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
