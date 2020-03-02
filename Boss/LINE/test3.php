<?php
require_once('./LINEBotTiny.php');
$access_token = getenv('LINE_CHANNEL_ACCESSTOKEN');
$secret = getenv('LINE_CHANNEL_SECRET');
$bot = new LINEBotTiny($access_token, $secret);
$newjson = file_get_contents('https://spreadsheets.google.com/feeds/list/1DF1BBZUPVGWHLN6V4W_2G2ZzfIo3iU67Mr1Fu85ZMMg/od6/public/values?alt=json');
$newdata = json_decode($newjson, true);

$file = fopen("./data/m&d.json", "w+");
fwrite($file, implode('',$newdata));
