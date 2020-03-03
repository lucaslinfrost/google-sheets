<?php
require_once('./LINEBotTiny.php');
$access_token = getenv('LINE_CHANNEL_ACCESSTOKEN');
$secret = getenv('LINE_CHANNEL_SECRET');
$bot = new LINEBotTiny($access_token, $secret);

foreach ($bot->parseEvents() as $event) {
switch ($event['type']) {
case 'message':
$message = $event['message'];
$message = trim($message);
$message = preg_replace('/\s(?=)/', '', $message);
$code = explode('#', $message['text']);
$forbid = 
                
foreach ($forbid as $item) {
if (strcmp($code[1], $item) === 0) {
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
}
    break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
