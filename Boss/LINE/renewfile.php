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
$updatelog = "沒有可以更新的資料。\n\n--------  建議輸入  --------\n怪物\n生產\n裝備\n石頭\n星能\n地圖\n栽培\n採礦";
    
if (strcmp($code[1], "怪物") != false) {
$getfileaddress = getenv('monster_item');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/m&d.json", "w+");
fwrite($file, $update);
$updatelog = "怪物資料已更新。";
}
    
if (strcmp($code[1], "生產") != false) {
$getfileaddress = getenv('production');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/production.json", "w+");
fwrite($file, $update);
$updatelog = "生產資料已更新。";
}
    
if (strcmp($code[1], "裝備") != false) {
$getfileaddress = getenv('equip');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/equip.json", "w+");
fwrite($file, $update);
$updatelog = "裝備資料已更新。";
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
$updatelog = "星能資料已更新。";
}
    
if (strcmp($code[1], "地圖") != false) {
$getfileaddress = getenv('map');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/map.json", "w+");
fwrite($file, $update);
$updatelog = "地圖資料已更新。";
}
    
if (strcmp($code[1], "栽培") != false) {
$getfileaddress = getenv('seed');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/seed.json", "w+");
fwrite($file, $update);
$updatelog = "栽培資料已更新。";
}
    
if (strcmp($code[1], "挖礦") != false||
	       strcmp($code[1], "採礦") != false) {
$getfileaddress = getenv('drill');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/drill.json", "w+");
fwrite($file, $update);
$updatelog = "採礦資料已更新。";
}

        
    break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
