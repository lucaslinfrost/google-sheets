<?php
require_once('./LINEBotTiny.php');
$access_token = getenv('LINE_CHANNEL_ACCESSTOKEN');
$secret = getenv('LINE_CHANNEL_SECRET');
$bot = new LINEBotTiny($access_token, $secret);

foreach ($bot->parseEvents() as $event) {
switch ($event['type']) {
case 'message':
$talkreply = "";
$message = $event['message'];
$value = trim($message['text']);
$value = preg_replace("/\s(?=)/", "", $value);
$code = explode("#", $value);
$forbidcode1 = array("老大");
$forbidcode2 = array("幹", "機掰", "雞掰", "洨", "姦", "中出", "內射", "奶子", "三小", "尛", "雞雞", "老二", "陰莖", "吹屌", "口交", "顏射", "賤", "智障", "白癡", "白吃", "下三濫", "腦殘", "吃屌", "戇鳩", "on9", "性交", "做愛", "插入", "陰道", "陰唇", "下面癢", "下麵給你吃", "下面給你吃", "你就爛", "你娘", "去你妹", "去死", "白帶", "精液", "精子", "破處", "一夜情", "約炮", "約泡", "打泡", "打炮", "靠腰", "靠妖", "靠么");
$forbidcode1 = array_merge($forbidcode1, $forbidcode2);
if($code[1] === ""){
$talkreply = "不能輸入空值。\n格式 :\n老大學#關鍵字#回答句\n老大學#關鍵字1;關鍵字2#回答句1;回答句2\n[;]必須為半形。";
}else{
   if($code[2] === ""){
   $talkreply = "不能輸入空值。\n格式 :\n老大學#關鍵字#回答句\n老大學#關鍵字1;關鍵字2#回答句1;回答句2\n[;]必須為半形。";
   }else{
      if (sensitive($code[1], $forbidcode1)) {
      $talkreply = "你輸入的內容包含禁止使用文字。";
      }else{
         if (sensitive($code[2], $forbidcode2)) {
         $talkreply = "你輸入的內容包含禁止使用文字。";
         }else{
            $learnword = $code[1];
            $replyfromlearn = $code[2];
            $json = file_get_contents('./exampleJson/textReply.json');
            $upfile = json_decode($json, true);
            
            foreach($upfile as $txtChack){
            foreach($txtChack['chack'] as $chack){
            if(stristr($code[1], $chack) != false){
            $talkreply = "這個我已經學過了喔。";
            break;break;}}}
            
            if($talkreply === "這個我已經學過了喔。"){
            }else{
               $update = array ('chack' => array ($learnword),'text' => array ($replyfromlearn),);
               if (strpos($learnword, ";") !== false) {$learnword = explode(";", $code[1]);$update = array ('chack' => $learnword,'text' => $replyfromlearn,);$code[1] = str_replace(";", "或", $code[1]);}
               if (strpos($replyfromlearn, ";") !== false) {$replyfromlearn = explode(";", $code[2]);$update = array ('chack' => $learnword,'text' => $replyfromlearn,);$code[2] = str_replace(";", "或", $code[2]);}
               $file = fopen("./exampleJson/textReply.json", "w+");
               array_push($upfile, $update);
               $upfile = json_encode($upfile, JSON_UNESCAPED_UNICODE);
               fwrite($file, $upfile);
               $talkreply = "我已經學會了看到[".$code[1]."]\n就要回答[".$code[2]."]。";
               fclose($file);
            }
         }
      }
   }
}
    break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};

function sensitive($haystack, $needle) {
if(!is_array($needle)) $needle = array($needle);
foreach($needle as $query) {
if(strpos($haystack, $query) !== false) return true;
}
return false;
}
