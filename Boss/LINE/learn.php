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

$file = fopen("./exampleJson/test.json", "a+");
$file = substr($file,0,strlen($file)-1);
$update = "{\"learn\":[\"".$code[1]."\"],\"reply\":[\"".$code[2]."\"]}\n]";
fwrite($file, $update);
$updatelog = "採礦資料已更新。";

        
    break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
