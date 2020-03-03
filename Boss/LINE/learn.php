<?php
require_once('./LINEBotTiny.php');
$access_token = getenv('LINE_CHANNEL_ACCESSTOKEN');
$secret = getenv('LINE_CHANNEL_SECRET');
$bot = new LINEBotTiny($access_token, $secret);

foreach ($bot->parseEvents() as $event) {
switch ($event['type']) {
case 'message':
$message = $event['message'];
$code = explode('#', $message['text']);

$file = fopen("./exampleJson/test.json", "w+");
$upfile = json_decode($file, true);
$update = array ('learn' => array ($code[1]),'reply' => array ($code[2]),),
array_push($upfile, $update);
$upfile = json_encode($upfile);
fwrite($file, $update);
$talkreply = "我學會了!~";
fclose($file); 
        
    break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
