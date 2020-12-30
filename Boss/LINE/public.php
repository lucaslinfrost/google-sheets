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
	$a = "";
	$altText = "關於 ".$message['text']." 的資料";
	$result = array();
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
					//$data999 = "╭☆╭╧╮╭╧╮╭╧╮\n╰╮║公║║告║║欄║\n☆╰╘∞╛╘∞╛╘∞╛\n\n".$item['gsx$message']['$t']."\n\n---------發佈者---------\n".$item['gsx$name']['$t']."\n--------發佈時間--------\n".$item['gsx$date']['$t'];
					$data999 = array("type" => "bubble","header" => array("type" => "box","layout" => "vertical","contents" => array()),"hero" => array("type" => "image","url" => "https://i.imgur.com/jOBeMP0.jpg","size" => "full","aspectRatio" => "50:13","aspectMode" => "fit"),"body" => array("type" => "box","layout" => "vertical","spacing" => "md","contents" => array(array("type" => "text","text" => "╭☆╭╧╮╭╧╮╭╧╮\n╰╮║公║║告║║欄║\n☆╰╘∞╛╘∞╛╘∞╛\n\n","wrap" => true,"weight" => "bold","gravity" => "center","size" => "md","align" => "center"),array("type" => "box","layout" => "vertical","margin" => "lg","spacing" => "sm","contents" => array(array("type" => "box","layout" => "baseline","spacing" => "sm","contents" => array(array("type" => "text","text" => $item['gsx$message']['$t'].''.$a,"wrap" => true,"color" => "#666666","size" => "xs"))))),array("type" => "box","layout" => "vertical","contents" => array(array("type" => "box","layout" => "baseline","spacing" => "sm","contents" => array(array("type" => "text","text" => "\n\n---------發佈者---------\n".$item['gsx$name']['$t']."\n--------發佈時間--------\n".$item['gsx$date']['$t'],"wrap" => true,"size" => "md","align" => "center")))),"spacing" => "sm","margin" => "lg"))));array_push($result, $999data);
					}else{
					break;
					}
				}
			}else{
				if($item['gsx$groupid']['$t'] === ""){
				//$data999 = "╭☆╭╧╮╭╧╮╭╧╮\n╰╮║公║║告║║欄║\n☆╰╘∞╛╘∞╛╘∞╛\n\n".$item['gsx$message']['$t']."".$a."\n\n---------發佈者---------\n".$item['gsx$name']['$t']."\n--------發佈時間--------\n".$item['gsx$date']['$t'];
                		$data999 = array("type" => "bubble","header" => array("type" => "box","layout" => "vertical","contents" => array()),"hero" => array("type" => "image","url" => "https://i.imgur.com/jOBeMP0.jpg","size" => "full","aspectRatio" => "50:13","aspectMode" => "fit"),"body" => array("type" => "box","layout" => "vertical","spacing" => "md","contents" => array(array("type" => "text","text" => "╭☆╭╧╮╭╧╮╭╧╮\n╰╮║公║║告║║欄║\n☆╰╘∞╛╘∞╛╘∞╛\n\n","wrap" => true,"weight" => "bold","gravity" => "center","size" => "md","align" => "center"),array("type" => "box","layout" => "vertical","margin" => "lg","spacing" => "sm","contents" => array(array("type" => "box","layout" => "baseline","spacing" => "sm","contents" => array(array("type" => "text","text" => $item['gsx$message']['$t'].''.$a,"wrap" => true,"color" => "#666666","size" => "xs"))))),array("type" => "box","layout" => "vertical","contents" => array(array("type" => "box","layout" => "baseline","spacing" => "sm","contents" => array(array("type" => "text","text" => "\n\n---------發佈者---------\n".$item['gsx$name']['$t']."\n--------發佈時間--------\n".$item['gsx$date']['$t'],"wrap" => true,"size" => "md","align" => "center")))),"spacing" => "sm","margin" => "lg"))));array_push($result, $999data);
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
			//$data999 = "╭☆╭╧╮╭╧╮╭╧╮\n╰╮║公║║告║║欄║\n☆╰╘∞╛╘∞╛╘∞╛\n\n".$item['gsx$message']['$t']."".$a."\n\n---------發佈者---------\n".$item['gsx$name']['$t']."\n--------發佈時間--------\n".$item['gsx$date']['$t'];
                	$data999 = array("type" => "bubble","header" => array("type" => "box","layout" => "vertical","contents" => array()),"hero" => array("type" => "image","url" => "https://i.imgur.com/jOBeMP0.jpg","size" => "full","aspectRatio" => "50:13","aspectMode" => "fit"),"body" => array("type" => "box","layout" => "vertical","spacing" => "md","contents" => array(array("type" => "text","text" => "╭☆╭╧╮╭╧╮╭╧╮\n╰╮║公║║告║║欄║\n☆╰╘∞╛╘∞╛╘∞╛\n\n","wrap" => true,"weight" => "bold","gravity" => "center","size" => "md","align" => "center"),array("type" => "box","layout" => "vertical","margin" => "lg","spacing" => "sm","contents" => array(array("type" => "box","layout" => "baseline","spacing" => "sm","contents" => array(array("type" => "text","text" => $item['gsx$message']['$t'].''.$a,"wrap" => true,"color" => "#666666","size" => "xs"))))),array("type" => "box","layout" => "vertical","contents" => array(array("type" => "box","layout" => "baseline","spacing" => "sm","contents" => array(array("type" => "text","text" => "\n\n---------發佈者---------\n".$item['gsx$name']['$t']."\n--------發佈時間--------\n".$item['gsx$date']['$t'],"wrap" => true,"size" => "md","align" => "center")))),"spacing" => "sm","margin" => "lg"))));array_push($result, $999data);
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
