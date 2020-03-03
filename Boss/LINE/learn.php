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
$data = json_decode($file, true);  
$data = substr($data,0,-1);
$update = "{\"learn\":[\"".$code[1]."\"],\"reply\":[\"".$code[2]."\"]}\n]";
$data = $data."\n".$update;
fwrite($file, $data);
$talkreply = "我學會了!~";

        
    break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
