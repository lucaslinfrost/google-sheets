<?php
//裝備查詢頁(文字介面)
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi = getenv('googledataspi6');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $json = file_get_contents('./data/equip.json');
            $data = json_decode($json, true);
            $code = explode(' ', $message['text']);
            $alltext = "";
            $mline = "\n--------  分°Д°行  --------\n";
            foreach ($data['feed']['entry'] as $item) {
                $keywords = explode(',', $item['gsx$key']['$t']);
                foreach ($keywords as $keyword) {
                    if (strcmp($code[1], $keyword) === 0) {
if($item['gsx$atk']['$t'] === ""){
$a = "";
}else{
$a = "攻擊 : ".$item['gsx$atk']['$t'];
}
if($item['gsx$def']['$t'] === ""){
$b = "";
}else{
if($item['gsx$atk']['$t'] === ""){
$b = "防禦 : ".$item['gsx$def']['$t'];
}else{
$b = "     防禦 : ".$item['gsx$def']['$t'];
}
}
if($item['gsx$slot']['$t'] === ""){
$c = "";
}else{
$c = "
※絕對有".$item['gsx$slot']['$t']."洞";
}
if($item['gsx$remark']['$t'] === ""){
$d = "";
}else{
$d = "
".$item['gsx$remark']['$t'];
}
if($item['gsx$maxatk']['$t'] === ""){
$e = "";
}else{
$e = " - ".$item['gsx$maxatk']['$t'];
}
if($item['gsx$maxdef']['$t'] === ""){
$f = "";
}else{
$f = " - ".$item['gsx$maxdef']['$t'];
}
if($item['gsx$smith']['$t'] === ""){
$g = "";
}else{
if($item['gsx$part']['$t'] === "素材"){
$g = "
鐵匠 : ".$item['gsx$smith']['$t'];
}else{
$g = "

鐵匠 : ".$item['gsx$smith']['$t']." [".$item['gsx$smithtype']['$t']."]";
}
}
if($item['gsx$price']['$t'] === ""){
$h = "";
}else{
if (preg_match('/[0-9]+/', $item['gsx$price']['$t'])) {
$h = "
價格 : ".$item['gsx$price']['$t']." 眾神幣";
}else{
$h = "
備註 : ".$item['gsx$price']['$t'];
}
}
if($item['gsx$item1']['$t'] === ""){
$i = "";
}else{
$i = "
材料1: ".$item['gsx$item1']['$t'];
}
if($item['gsx$item2']['$t'] === ""){
$j = "";
}else{
$j = "
材料2: ".$item['gsx$item2']['$t'];
}
if($item['gsx$item3']['$t'] === ""){
$k = "";
}else{
$k = "
材料3: ".$item['gsx$item3']['$t'];
}                        
if($item['gsx$item4']['$t'] === ""){
$l = "";
}else{
$l = "
材料4: ".$item['gsx$item4']['$t'];
}
if($item['gsx$item5']['$t'] === ""){
$m = "";
}else{
$m = "
材料5: ".$item['gsx$item5']['$t'];
}  
                    
$alltext = $alltext."".$item['gsx$name']['$t']." 【".$item['gsx$part']['$t']."】
".$a."".$e."".$b."".$f."".$c."".$d."".$g."".$h."".$i."".$j."".$k."".$l."".$m;
                    $alltext = $alltext."".$mline;
                    }
                }
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
