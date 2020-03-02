<?php
require_once('./LINEBotTiny.php');
$access_token = getenv('LINE_CHANNEL_ACCESSTOKEN');
$secret = getenv('LINE_CHANNEL_SECRET');
$bot = new LINEBotTiny($access_token, $secret);

foreach ($bot->parseEvents() as $event) {
switch ($event['type']) {
case 'message':
$message = $event['message'];
$code = explode(' ', $message['text']);
    
if (strcmp($code[1], "怪物") != false) {
$getfileaddress = getenv('monster_item');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/m&d.json", "w+");
fwrite($file, $update);
}
    
if (strcmp($code[1], "生產") != false) {
$getfileaddress = getenv('production');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/production.json", "w+");
fwrite($file, $update);
}
    
if (strcmp($code[1], "裝備") != false) {
$getfileaddress = getenv('equip');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/equip.json", "w+");
fwrite($file, $update);
}
    
if (strcmp($code[1], "石頭") != false) {
$getfileaddress = getenv('rock');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/rock.json", "w+");
fwrite($file, $update);
}
    
if (strcmp($code[1], "星能") != false) {
$getfileaddress = getenv('star');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/star.json", "w+");
fwrite($file, $update);
}
    
if (strcmp($code[1], "地圖") != false) {
$getfileaddress = getenv('map');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/map.json", "w+");
fwrite($file, $update);
}
    
if (strcmp($code[1], "栽培") != false) {
$getfileaddress = getenv('seed');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/seed.json", "w+");
fwrite($file, $update);
}
    
if (strcmp($code[1], "挖礦") != false) {
$getfileaddress = getenv('drill');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/drill.json", "w+");
fwrite($file, $update);
}

        
    break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
