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
    
if (strcmp($code[1], "全部") === 0) {
$updatelog = "全部資料已更新。\n(功能尚未實裝)";
}
		
if (strcmp($code[1], "怪物") === 0) {
$getfileaddress = getenv('monster_item');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/m&d.json", "w+");
fwrite($file, $update);
$updatelog = "怪物資料已更新。";
}
    
if (strcmp($code[1], "生產") === 0) {
$getfileaddress = getenv('production');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/production.json", "w+");
fwrite($file, $update);
$updatelog = "生產資料已更新。";
}
    
if (strcmp($code[1], "裝備") === 0) {
$getfileaddress = getenv('equip');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/equip.json", "w+");
fwrite($file, $update);
$updatelog = "裝備資料已更新。";
}
    
if (strcmp($code[1], "石頭") === 0) {
$getfileaddress = getenv('rock');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/rock.json", "w+");
fwrite($file, $update);
$updatelog = "石頭資料已更新。";
}
    
if (strcmp($code[1], "星能") === 0) {
$getfileaddress = getenv('star');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/star.json", "w+");
fwrite($file, $update);
$updatelog = "星能資料已更新。";
}
    
if (strcmp($code[1], "地圖") === 0) {
$getfileaddress = getenv('map');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/map.json", "w+");
fwrite($file, $update);
$updatelog = "地圖資料已更新。";
}
    
if (strcmp($code[1], "栽培") === 0) {
$getfileaddress = getenv('seed');
$update = file_get_contents($getfileaddress);
$file = fopen("./data/seed.json", "w+");
fwrite($file, $update);
$updatelog = "栽培資料已更新。";
}
    
if (strcmp($code[1], "採礦") === 0) {
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
