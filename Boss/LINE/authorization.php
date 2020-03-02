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
$roomId = $source['roomId'];
$groupId = $source['groupId'];
break;
default:
break;
}};
