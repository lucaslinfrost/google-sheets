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
foreach ($data['feed']['entry'] as $item) {
  $keywords = explode(',', $item['gsx$learn']['$t']);
  foreach ($keywords as $keyword) {
    if (strcmp($code[1], $keyword) === 0) {
      $talkreply = $item['gsx$reply']['$t'];
    }
  }
}

  break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
