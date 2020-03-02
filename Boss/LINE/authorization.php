<?php
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$owner = getenv('Owner');
$bot = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($bot->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
$source = $event['source'];
$userId = $source['userId'];
if($source['type'] == "group"){$groupId = $source['groupId'];}
if($source['type'] == "room"){$roomId = $source['roomId'];}

break;
default:
break;
}};
