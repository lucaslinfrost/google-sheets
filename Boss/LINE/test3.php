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
$json = file_get_contents('./exampleJson/test.json');
$data = json_decode($json, true);

foreach($data as $DataChack){
		foreach($DataChack['learn'] as $learn){
			if (strcmp($code[1], $learn) != false) {	
			$talkreply = $DataChack['reply'][Dicefortalk(count($DataChack['reply']))-1];
			break;
			}
		}
	} 
function Dicefortalk($diceSided){
	return rand(1,$diceSided);
}
  break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
