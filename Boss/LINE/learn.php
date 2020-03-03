<?php
require_once('./LINEBotTiny.php');
$access_token = getenv('LINE_CHANNEL_ACCESSTOKEN');
$secret = getenv('LINE_CHANNEL_SECRET');
$bot = new LINEBotTiny($access_token, $secret);

foreach ($bot->parseEvents() as $event) {
switch ($event['type']) {
case 'message':

$message = $event['message'];
$value = trim($message['text']);
$value = preg_replace("/\s(?=)/", "", $value);
$code = explode("#", $value);
$forbidcode1 = array("老大", "幹", "機掰", "雞掰", "洨", "姦", "中出", "內射", "奶子", "");
$forbidcode2 = array("幹", "機掰", "雞掰", "", "", "", "", "", "", "", "", "", "", "", "", "");

if($code[1] === ""){
$talkreply = "不能輸入空值。";
}else{
        if (sensitive($code[1], $forbidcode1, 1)) {
        $talkreply = "你輸入的內容包含禁止使用文字。";
        }else{
        $json = file_get_contents('./exampleJson/textReply.json');
        $file = fopen("./exampleJson/textReply.json", "w+");
        $upfile = json_decode($json, true);
        $update = array ('chack' => array ($code[1]),'text' => array ($code[2]),);
        array_push($upfile, $update);
        $upfile = json_encode($upfile, JSON_UNESCAPED_UNICODE);
        fwrite($file, $upfile);
        $talkreply = "我學會了!~";
        fclose($file); 
        }
}
    break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};

function sensitive($haystack, $needle, $offset=0) {
if(!is_array($needle)) $needle = array($needle);
foreach($needle as $query) {
if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
}
return false;
}
