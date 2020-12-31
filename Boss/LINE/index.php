<?php
/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require_once('./LINEBotTiny.php');
require_once('./nomalReply.php');

//主要的全域變數，只有簡易的API，覺得難過香菇
//試著手動加入了getProfile的功能…不知道是否用得到
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$keyWord = getenv('KEY_WORD');
$manualUrl = getenv('MANUAL_URL');
$textReplyUrl = getenv('TEXT_REPLY_URL');
$imgsReplyUrl = getenv('IMGS_REPLY_URL');
$yababangUrl = getenv('YABABANG_URL');

$bot = new LINEBotTiny($channelAccessToken, $channelSecret);
$userName = '你';

//建立文字訊息的函數
function buildTextMessage($inputStr){	
	settype($inputStr, "string");
	error_log("訊息【".$inputStr."】準備以文字訊息回傳");
	$message = array
		(
		array(
            'type' => 'text',
            'text' => $inputStr
            )
        );
	return $message;
}

//建立圖片訊息的函數
function buildImgMessage($inputStr){	
	settype($inputStr, "string");
	error_log("訊息【".$inputStr."】準備以圖片訊息回傳");
	$message = array
		(
		array(
			'type' => "image", 
            'originalContentUrl' => $inputStr, 
            'previewImageUrl' => $inputStr
            )
        );
	return $message;
}

//建立貼圖訊息的函數
function buildStickerMessage($packageId, $stickerId){	
	error_log("準備回傳".$packageId."之".$stickerId."貼圖");
	$message = array
		(
		array(
			'type' => "sticker", 
            'packageId' => $packageId, 
            'stickerId' => $stickerId
            )
        );
	return $message;
}

//建立旋轉木馬的函數
function buildcarousel($altText, $result){	
		error_log("準備回傳旋轉木馬訊息。");
		$message = array
		( 
		array(
			'type'=> "template",
			'altText'=> $altText,
			'template'=> array(
				'type'=> "carousel",
				'columns'=> $result
            		)
		      ),
		);
	return $message;
}

//建立Flex面板的函數
function buildflex($altText, $result){	
		error_log("準備回傳Flex面板訊息。");
		$message = array
		( 
		array(
			'type'=> "flex",
			'altText'=> $altText,
			'contents'=> array(
				'type'=> "carousel",
				'contents'=> $result
            		)
		      ),
		);
	return $message;
}

//建立聲音訊息的函數
function buildAudioMessage($link, $second){	
	error_log("準備回傳聲音訊息。");
	$message = array
		(
		array(
            'type' => 'audio',
            'originalContentUrl' => $link,
            'duration' => $second
            )
        );
	return $message;
}


//建立複數訊息，的物件
class MutiMessage{

	public function send($inputArr){	
		//settype($inputStr, "string");
		error_log("回傳複數訊息");
		$message = $inputArr;
		return $message;
	}
	
	//建立文字訊息的函數
	public function text($inputStr){
		settype($inputStr, "string");
		error_log("訊息【".$inputStr."】準備以文字訊息回傳");
		$message = array(
            'type' => 'text',
            'text' => $inputStr
            );
		return $message;
	}
	
	//建立圖片訊息的函數
	public function img($inputStr){
		settype($inputStr, "string");
		error_log("訊息【".$inputStr."】準備以圖片訊息回傳");
		$message = array(
			'type' => "image", 
            'originalContentUrl' => $inputStr, 
            'previewImageUrl' => $inputStr
            );
		return $message;
	}
	
	//建立貼圖訊息的函數
	public function sticker($packageId, $stickerId){	
		error_log("準備回傳".$packageId."之".$stickerId."貼圖");
		$message = array(
			'type' => "sticker", 
            'packageId' => $packageId, 
            'stickerId' => $stickerId
            );
	return $message;
	}
	
	//建立旋轉木馬訊息(???)的函數
	public function carousel($altText, $columns){	
		error_log("準備回傳旋轉木馬訊息。");
		$message = array(
			'type'=> "template",
			'altText'=> $altText,
			'template'=> array(
				'type'=> "carousel",
				'columns'=> $columns
            )
		);
	return $message;
	}
	
	//建立Flex面板的函數
	public function flexmsg($altText, $result){	
		error_log("準備回傳Flex面板訊息。");
		$message = array
		( 
		array(
			'type'=> "flex",
			'altText'=> $altText,
			'contents'=> array(
				'type'=> "carousel",
				'contents'=> $result
            		)
		      ),
		);
	return $message;
	}
	
}




foreach ($bot->parseEvents() as $event) {
		
    switch ($event['type']) {
		//收到訊息的動作
        case 'message':
			$message = $event['message'];			
			$source = $event['source'];
			if($source['type'] == "group"){		
				
				$groupId = $source['groupId'];
				$userId = $source['userId'];
				error_log("群組ID：".$groupId);
				if($userId != null){
								
					$userName = $bot->getGroupProfile($groupId,$userId)['displayName'];
					error_log("訊息發送人：".$userName);
					error_log("發送人ID：".$userId);
					$table = "群組";
					$tableid = $groupId;
					//require_once('../../record.php');
					}
				else{
					error_log("訊息發送人：不明");
					$table = "群組";
					$tableid = $groupId;
					//require_once('../../record.php');
				}
				}
		    
		        if($source['type'] == "room"){		
				
				$roomId = $source['roomId'];
				$userId = $source['userId'];
				error_log("房間ID：".$roomId);
				if($userId != null){
								
					$userName = $bot->getRoomProfile($roomId,$userId)['displayName'];
					error_log("訊息發送人：".$userName);
					error_log("發送人ID：".$userId);
					$table = "房間";
					$tableid = $roomId;
					//require_once('../../record.php');
					}
				else{
					error_log("訊息發送人：不明");
					$table = "房間";
					$tableid = $roomId;
					//require_once('../../record.php');
				}
				}
		    
			if($source['type'] == "user"){
				$userName = $bot->getProfile($source['userId'])['displayName'];
				$userId = $source['userId'];
				error_log("訊息發送人：".$userName);
				error_log("發送人ID：".$userId);
				$table = "私人";
				$tableid = $userId;
				//require_once('../../record.php');
				}
			
			
			//對訊息類別做篩選
            switch ($message['type']) {				
				
				//只針對文字訊息去回應
                case 'text':
                	$m_message = $message['text'];
					
                	if($m_message!="")
                	{
											
						error_log("收到訊息：".$m_message);
						$messages = parseInput($m_message);
						
						if ($messages == null) {
							error_log("無觸發");
							break;
						}
						
						$bot->replyMessage(
							array(
							'replyToken' => $event['replyToken'],
							'messages' => $messages
							)
						);	

                	}
                    break;
                
				case 'image':
				error_log("傳送了圖片。");
				break;
				
				case 'video':
				error_log("傳送了影片。");
				break;
				
				case 'sticker':
				error_log("傳送了貼圖。");
				break;
            }
            break;
			
		//被加入聊天室的動作
		case 'join':
			error_log("被加入聊天室");
			$messages = new MutiMessage();
			$replyArr = Array(
				$messages->text("機體編號 : @svf5367e\n隸屬Iruna公會【★夢想家★】。\n工作是公會顧問和吉祥物，\n您可以輸入[老大說明]\n來了解我的所有功能。\n我的製作協力者有\n[我靴子裡有蛇]、[賢者懿雅]、[風:))]、[夜影]\n\n在遊戲裡看到他們記得表示感謝喔!!\n\n(C) ASOBIMO INC. All rights reserved."),
				$messages->sticker(4,294)
			);
			
			$bot->replyMessage(
				array(
				'replyToken' => $event['replyToken'],
				'messages' => $replyArr
				)
			);
			break;
		    	
		//被加入好友的動作
		case 'follow':
			error_log("被加入好友");
			$messages = new MutiMessage();
			$replyArr = Array(
				$messages->text("機體編號 : @svf5367e\n隸屬Iruna公會【★夢想家★】。\n工作是公會顧問和吉祥物，\n您可以輸入[老大說明]\n來了解我的所有功能。\n我的製作協力者有\n[我靴子裡有蛇]、[賢者懿雅]、[風:))]、[夜影]\n\n在遊戲裡看到他們記得表示感謝喔!!\n\n(C) ASOBIMO INC. All rights reserved."),
				$messages->sticker(4,294),
			);
			
			$bot->replyMessage(
				array(
				'replyToken' => $event['replyToken'],
				'messages' => $replyArr
				)
			);		
			break;  
 
		//成員加入的動作
		case 'memberJoined':
			error_log("成員加入");
			$source = $event['source'];
			$joined = $event['joined']['members'];
			$members = $joined[0];
	
				
				$groupId = $source['groupId'];
				$groupName = $bot->getGroupSummary($groupId)['groupName'];
				$userId = $members['userId'];
				error_log("群組ID：".$groupId);
				error_log("群組名：".$groupName);
				error_log("成員ID：".$userId);
				if($userId != null){
				$userName = $bot->getProfile($userId)['displayName'];
				error_log("訊息發送人：".$userName);
				error_log("發送人ID：".$userId);
				}else{
				error_log("訊息發送人：不明");
				$userName = "您";
				}
		    
		    		$owner = getenv('Owner');
		    		if($userId === $owner){
				$welcomemsg = '系統管理員【'.$userName.'】已加入《'.$groupName.'》!!!';
				}else{
				$welcomemsg = '熱烈歡迎'.$userName.'加入《'.$groupName.'》!!!';
				}
		    
		    	$googledataspi = getenv('googledataspi5');
			$json = file_get_contents($googledataspi);
        		$data = json_decode($json, true);
		    
		    	$altText = "歡迎👏👏👏";
			$result = array();
		    
		    	if($source['type'] == "group"){
$data999 = "您所在的群組還沒有公告，
可以使用[老大note#公告內容]
這個指令來添加公告。";
			}else{
			$data999 = "(ง •̀ω•́)ง✧ (`･ω･´)9";
			}
		    
		    	foreach ($data['feed']['entry'] as $item) {
			$grouplist = explode(',', $item['gsx$groupid']['$t']);
				foreach ($grouplist as $groupcheck) {
					if (strcmp($groupId, $groupcheck) === 0) {
					//$data999 = "╭☆╭╧╮╭╧╮╭╧╮\n╰╮║公║║告║║欄║\n☆╰╘∞╛╘∞╛╘∞╛\n\n".$item['gsx$message']['$t']."\n\n---------發佈者---------\n".$item['gsx$name']['$t']."\n--------發佈時間--------\n".$item['gsx$date']['$t'];
					$data999 = array("type" => "bubble","header" => array("type" => "box","layout" => "vertical","contents" => array()),"hero" => array("type" => "image","url" => "https://i.imgur.com/jOBeMP0.jpg","size" => "full","aspectRatio" => "50:13","aspectMode" => "fit"),"body" => array("type" => "box","layout" => "vertical","spacing" => "md","contents" => array(array("type" => "text","text" => "╭☆╭╧╮╭╧╮╭╧╮\n╰╮║公║║告║║欄║\n☆╰╘∞╛╘∞╛╘∞╛\n\n","wrap" => true,"weight" => "bold","gravity" => "center","size" => "md","align" => "center"),array("type" => "box","layout" => "vertical","margin" => "lg","spacing" => "sm","contents" => array(array("type" => "box","layout" => "baseline","spacing" => "sm","contents" => array(array("type" => "text","text" => $item['gsx$message']['$t'].''.$a,"wrap" => true,"color" => "#666666","size" => "xs"))))),array("type" => "box","layout" => "vertical","contents" => array(array("type" => "box","layout" => "baseline","spacing" => "sm","contents" => array(array("type" => "text","text" => "\n\n---------發佈者---------\n".$item['gsx$name']['$t']."\n--------發佈時間--------\n".$item['gsx$date']['$t'],"wrap" => true,"size" => "md","align" => "center")))),"spacing" => "sm","margin" => "lg"))));
					}else{
					break;
					}
				}
			}
		    	
		    	array_push($result, $data999);
		    
			$messages = new MutiMessage();
			$replyArr = Array(
			$messages->text($welcomemsg),
			$messages->text('(ノ・ω・)ノ歡迎ヾ(・ω・ヾ)'),
			//$messages->text($data999),
			$messages->flexmsg($altText, $result),	
			);

			$bot->replyMessage(
				array(
				'replyToken' => $event['replyToken'],
				'messages' => $replyArr
				)
			);		
			break;
		    
		/**成員退出的動作
		case 'memberLeft':
			error_log("成員退出");
			$source = $event['source'];
			$left = $event['left']['members'];
			$members = $left[0];
	
				
				$groupId = $source['groupId'];
				$groupName = $bot->getGroupSummary($groupId)['groupName'];
				$userId = $members['userId'];
				error_log("群組ID：".$groupId);
				error_log("群組名：".$groupName);
				error_log("成員ID：".$userId);
				if($userId != null){
				$userName = $bot->getProfile($userId)['displayName'];
				error_log("訊息發送人：".$userName);
				error_log("發送人ID：".$userId);
				}else{
				error_log("訊息發送人：不明");
				$userName = "您";
				}
			$messages = new MutiMessage();
			$replyArr = Array(
			$messages->text('很遺憾【'.$userName.'】退出了'.$groupName.'!!!'),
			$messages->text('つ´Д`)つ我們會想念您~'),
			);
		        return $messages->send($replyArr);		
			break;*/
			
        default:
            error_log("不支援的訊息: " . $event['type']);
            break;
    }
};

//這是基本判斷式
function parseInput ($inputStr){
	global $userName;
	global $keyWord;
	global $manualUrl;
	global $textReplyUrl;
	global $imgsReplyUrl;
	global $yababangUrl;
	

	//error_log("訊息【".$inputStr."】進入parseInput");
	$inputStr = strtolower($inputStr);

	//preg_match ( "/A/" , B)。A是要比對的關鍵字（正則），B是被比對的字串
	if (preg_match ("/database/i", $inputStr)){
		return DvTest ($inputStr,$userName,$textReplyUrl,$imgsReplyUrl);
		
	}else if(stristr($inputStr,$keyWord) != false){ //$keyWord
		return KeyWordReply($inputStr,$keyWord,$manualUrl,$textReplyUrl,$userName);
				
	}else if(stristr($inputStr,$keyWord) === false || stristr($inputStr,"!p") != false){
		return SendImg($inputStr,$imgsReplyUrl);

	}	
	
	else {
	return null;
	}
}

function Dice($diceSided){
	return rand(1,$diceSided);
}

//創造角色
function create($inputStr,$userName){
	error_log("生成角色資料");
	
	$bg = '{
    "A" :["結實","英俊","粗鄙","機靈","迷人","娃娃臉","聰明","蓬頭垢面","愚鈍","骯髒","耀眼","有書卷氣","青春洋溢","感覺疲憊","豐滿","粗壯","毛髮茂盛","苗條","優雅的","邋遢的","敦實","蒼白","陰沉","平庸","臉色紅潤","皮膚黝黑","滿臉皺紋","古板","有狐臭","狡猾","健壯","嬌俏","筋肉發達","魁梧","遲鈍","虛弱","小屁孩","佛系","美麗","奇怪","猥瑣","暴力","愛幻想","少女情懷","搞笑","傻傻","萌萌","邊緣","腹黑","無所事事","喪心病狂","閃閃發亮","遺失記憶","黑化"],    
    "B" :["冒險家","見習戰士","見習魔法師","戰士","魔法師","見習騎士","見習獵人","騎士","獵人","見習巫師","見習祭司","巫師","祭司","見習聖騎士","聖騎士","見習劍鬥士","劍鬥士","見習百獸騎士","百獸騎士","見習狙擊手","狙擊手","見習刺客","刺客","見習召喚師","召喚師","見習賢者","賢者","見習主教","主教","見習幻術師","幻術師","見習武鬥家","武鬥家","見習死靈法師","死靈法師","見習隨侍","隨侍","忍者","武士","吟遊詩人","鍊金術師"],
    "C" :["奇基姆","科隆","阿姨","大叔","老奶奶","老爺爺","上宮","色石","王石","爆裂魔法","工口漫畫","幼女","蘿莉","正太","男性","女性","廁所","魔王","勇士","國王","天神","禁咒","黑夜","光明","正義","邪惡","光明","黑暗","燃火","烈焰","熔炎","靜水","激流","巨濤","大地","巨岩","樹海","微風","暴風","狂風","中二病","小屁孩","巨乳","大屁屁","裝備","時裝","劍","弓","爪","投擲","杖","萬劍","狙擊槍","鐮刀","飛鏢","法杖","薩羅","襪子","胖次","會長","回憶","童貞","依露娜","屁味","SM","性感泳裝","米田共","恥毛"],
    "D" :["追求者","蒐集者","吟唱者","討伐者","殲滅者","制裁者","暗戀者","愛慕者","玩弄者","幻想者","統治者","奴役者","使用者","認可者","信賴者","發明者","脫衣者","玷汙者","勇者","狩獵者","掃除者","爆裂者","撫摸者","至上主義者","操縱者","召喚者","擁有者","鄙視者","破壞者","唾棄者","遺棄者","不忠者","謀略者","開發者","閱讀者","視察者","凝視者","觸摸者","行動者","警告者","封印者","闖入者","撼動者","擁抱者","掠奪者","發現者","保護者","使者","代言者","推銷者","販賣者","推崇者","痴狂者","狂熱者","守護者"],
    "E" :["偷奶奶的內衣","偷窺鄰居","從王的屍體挖寶","說黃色笑話","從背後偷偷的來一下","歇斯底里的狂吼","裝可愛喵喵叫","找到走失的大叔","將腋毛中分","劇烈的抖動身體某個部位","沒有任何擅長的事","將鼻屎瞄的很準","一邊吃飯一邊上廁所","幫人剪成麥當勞叔叔的髮型","性騷擾肥胖的中年大叔","放置Play","補最後一刀","煮美味的飯菜","煮暗黑料理","打掃衛生","照顧新人","當打如意算盤的奸商","交朋友","學習語言和融入環境","在惡劣的環境求生","推倒阿姨","推倒大叔","推倒爺爺","推倒奶奶","尋找遺失的物品","完成打工任務","製作奇怪的兵器"],
    "F" :["甜食","狗","貓","咖啡","胖次","吊飾","拳擊手套","鋒利的菜刀","兔子","幼女","樂器","貧乳","書本","高檔貨","色色的睡衣","光頭","醜萌的小物件","罩杯大的芭比","會發出慘叫的娃娃","薩羅的襪子","金魚的便便","和菓子","雞蛋糕","畫筆和調色盤","相機","精緻的手錶","海綿寶寶","外星人","任何穿小褲褲的生物","狒狒的紅屁屁","自言自語","抓屁股","翹二郎腿","翻白眼","發出[哦~呵呵呵]的搖晃胸部","講話句尾加上[喵]","懷念過去的事","拉仇恨","學胖虎唱歌","看有點色色的圖片","爆裂魔法","幫人算命","家裡蹲","看宮廷劇"],    
    "G" :["慷慨大方的人","對動物很友善的人","善於夢想的人","享樂主義者","甘冒風險的賭徒或冒險者", "善於料理的人", "萬人迷","忠心耿耿的人","有好名聲的人","充滿野心的人","傲嬌的人","有點古怪的阿姨","肥肥的中年男子","容易激動的腐女","天馬行空的夢想家","正義的英雄","更正職業,其實是一緊張就會亂射的....狙擊手","敗金物慾女","草食綿羊男","肥宅","健身愛好者","精力充沛的冒險家","嚴謹的長輩","固執的人","平衡感差的傢伙","人生贏家","高富帥","白富美","天然呆","長命百歲的人","少根筋的傻大姊","氣勢凶猛的大媽","帥氣的中年大叔","可口的小鮮肉"]
    
	}';
	
	$bg = json_decode($bg, true);
	
return buildTextMessage("【名字】".$userName."
【職業】".$bg["A"][Dice(count($bg["A"]))-1]."的".$bg["B"][Dice(count($bg["B"]))-1]."。
【稱號】".$bg["C"][Dice(count($bg["C"]))-1]."之".$bg["D"][Dice(count($bg["D"]))-1]."。
【擅長】".$bg["E"][Dice(count($bg["E"]))-1]."。
【喜歡】".$bg["F"][Dice(count($bg["F"]))-1]."。
【結論】".$userName."是一個".$bg["G"][Dice(count($bg["G"]))-1]."。"
		);
	
}

function DvTest ($inputStr,$userName,$textReplyUrl,$imgsReplyUrl){


	error_log("進入DvTest");
	
	if(preg_match ("/muti|複數|多重/i", $inputStr) !=false){
	$testMessage = new MutiMessage();
	$replyArr = Array(
		$testMessage->text('多重訊息演示'),
		$testMessage->text('test2'),
		$testMessage->img('https://i.imgur.com/k4QE5Py.png'),
		$testMessage->sticker(1,2)
		);
	
	return $testMessage->send($replyArr);
	}
	
	if(preg_match ("/key|關鍵/i", $inputStr) !=false){
	
	//抓文字關鍵字
	$reply = "《文字關鍵字列表》\n";
	//讀入文字回應變數
	$content = file_get_contents($textReplyUrl);
	
	//如果失敗就調用預設值
	if ($content === false) {
		$content = file_get_contents('./exampleJson/textReply.json');
	}
	
	//userName會回傳為使用者名稱，如果有辦法取得的話。
	$content = preg_replace("/userName/" , $userName , $content);
	//keyWord會回傳為設定的關鍵字，通常就是機器人的名字。
	$content = preg_replace("/keyWord/" , $keyWord , $content);
		
	$text = json_decode($content, true);
	
	
	$count = 0;
	foreach($text as $txtChack){
		$countIn = 0;
		$tempStr = "[";
		foreach($txtChack['chack'] as $chack){
			$tempStr = $tempStr . $chack ."、";
			$count++;
			$countIn++;
		}
		$tempStr = chop($tempStr,'、').']';
		if( $count >= 4){
			$reply = chop($reply ,'；');
			$tempStr = "\n".$tempStr."；";
			$count = $countIn;
		}
		else{
			$tempStr = $tempStr."；";
		}
		$reply = $reply.$tempStr;
	}	
	
	$reply = chop($reply ,'；');
	

	//抓圖片關鍵字
	$reply = $reply."\n\n《圖片關鍵字列表》\n";
	
	//讀入圖片回應變數
	$content = file_get_contents($imgsReplyUrl);
	//如果失敗就調用預設值
	if ($content === false) {
		$content = file_get_contents('./exampleJson/imgReply.json');
	}
	$img = json_decode($content, true);
	
	$count = 0;
	foreach($img as $imgChack){
		$countIn = 0;
		$tempStr = "[";
		foreach($imgChack['chack'] as $chack){
			$tempStr = $tempStr . $chack ."、";
			$count++;
			$countIn++;
		}
		$tempStr = chop($tempStr,'、').']';
		if( $count >= 4){
			$reply = chop($reply ,'；');
			$tempStr = "\n".$tempStr."；";
			$count = $countIn;
		}
		else{
			$tempStr = $tempStr."；";
		}
		$reply = $reply.$tempStr;
	}		
	$reply = chop($reply ,'；');
	
	return buildTextMessage($reply);	
	
	}
	
	
	//應聲蟲功能哦
	$input = str_replace("database ","",$inputStr);
	$finalStr = "輸入:".$input."\n字串長度:".strlen($input);
	return buildTextMessage($finalStr);
	
}
