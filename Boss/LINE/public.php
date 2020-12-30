<?php
//其他功能介面 (文字版)

require_once('./LINEBotTiny.php');

$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi = getenv('googledataspi5');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);

// 取得事件(只接受文字訊息)
foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
        // 讀入訊息
        $message = $event['message'];
        $source = $event['source'];
        $groupId = $source['groupId'];
        // 將Google表單轉成JSON資料
        $json = file_get_contents($googledataspi);
        $data = json_decode($json, true); 
        $data999 = "";
        $code = explode(' ', $message['text']);
        // 資料起始從feed.entry          
        foreach ($data['feed']['entry'] as $item) {
            // 將keywords欄位依,切成陣列
            $keywords = explode(',', $item['gsx$title']['$t']);
            $grouplist = explode(',', $item['gsx$groupid']['$t']);
            // 以關鍵字比對文字內容
            foreach ($keywords as $keyword) {
                
		if($code[1] === Null) {
			if($source['type'] == "group"){
				foreach ($grouplist as $groupcheck) {
					if (strcmp($groupId, $groupcheck) === 0) {
					$data999 = "╭☆╭╧╮╭╧╮╭╧╮\n╰╮║公║║告║║欄║\n☆╰╘∞╛╘∞╛╘∞╛\n\n".$item['gsx$message']['$t']."\n\n---------發佈者---------\n".$item['gsx$name']['$t']."\n--------發佈時間--------\n".$item['gsx$date']['$t'];
					}else{
					break;
$data999 = "您所在的群組還沒有公告，
可以使用[老大note#公告內容]
這個指令來添加公告。";	
					}
				}
			}else{
				if($item['gsx$groupid']['$t'] === ""){
				$data999 = "╭☆╭╧╮╭╧╮╭╧╮\n╰╮║公║║告║║欄║\n☆╰╘∞╛╘∞╛╘∞╛\n\n".$item['gsx$message']['$t']."".$a."\n\n---------發佈者---------\n".$item['gsx$name']['$t']."\n--------發佈時間--------\n".$item['gsx$date']['$t'];
                		}
			}
		}
		    
                if (strcmp($code[1], $keyword) === 0) {
			
			if($item['gsx$groupid']['$t'] === ""){
    				if($item['gsx$history']['$t'] === ""){
				$a = "";
				}else{
$a = "
--------活動歷史--------
".$item['gsx$history']['$t'];
				}
			$data999 = "╭☆╭╧╮╭╧╮╭╧╮\n╰╮║公║║告║║欄║\n☆╰╘∞╛╘∞╛╘∞╛\n\n".$item['gsx$message']['$t']."".$a."\n\n---------發佈者---------\n".$item['gsx$name']['$t']."\n--------發佈時間--------\n".$item['gsx$date']['$t'];
                
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
