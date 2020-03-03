<?php
require_once('./LINEBotTiny.php');
$access_token = getenv('LINE_CHANNEL_ACCESSTOKEN');
$secret = getenv('LINE_CHANNEL_SECRET');
$bot = new LINEBotTiny($access_token, $secret);

foreach ($bot->parseEvents() as $event) {
switch ($event['type']) {
case 'message':
$message = $event['message'];
$json = file_get_contents('./exampleJson/learn.json');
$data = json_decode($json, true);
$talkreply = "";

foreach($data as $DataChack){
		foreach($DataChack['learn'] as $learn){
			if(stristr($message, $learn) != false){
			$talkreply = $DataChack['reply'][Dice(count($DataChack['reply']))-1];
			break;
			}
		}
	} 

  break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
