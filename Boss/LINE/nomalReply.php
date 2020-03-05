<?php
require_once('./blacklist.php');

function KeyWordReply($inputStr,$keyWord,$manualUrl,$textReplyUrl,$userName) { 
	$inputStr = strtolower($inputStr);

	//以下是回應功能
	//讀入文字回應變數
	$content = file_get_contents($manualUrl);
	
	//如果失敗就調用預設值
	if ($content === false) {
		$content = file_get_contents('./exampleJson/manual.json');
	}
	
	//userName會回傳為使用者名稱，如果有辦法取得的話。
	$content = preg_replace("/userName/" , $userName , $content);
	//keyWord會回傳為設定的關鍵字，通常就是機器人的名字。
	$content = preg_replace("/keyWord/" , $keyWord , $content);
	$manual = json_decode($content, true);
	
	//功能說明
	if(stristr($inputStr,'說明') != false||
	       stristr($inputStr, '说明') != false) {
	foreach($manual as $systems){
		foreach($systems['Syskey'] as $chack){	
			if(stristr($inputStr, $chack) != false){
				$mutiMessage = new MutiMessage();
				$replyArr = Array();
			
				foreach($systems['about'] as $message){
					switch ($message['type']) {
						case 'text':
							array_push($replyArr, $mutiMessage->text($message['text']));							
						break;
						
						case 'carousel':
							error_log("發現旋轉木馬訊息");
							array_push($replyArr, $mutiMessage->carousel($message['altText'],$message['columns']));
						break;
						
					}	
				
				
				}
				
				return $mutiMessage->send($replyArr);
				break;
			}
		}
	}	
	}
	
	//查材料用途
	if(stristr($inputStr, 'look') != false) {
		
		$rplyArr = explode('#',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		require_once('./usagecheck.php');
		unset($json3, $data3, $keywords, $keyword, $json2, $data2);
		if ($alltext1 !== "") {
		if ($alltext2 !== "") {
		$alltext1 = substr($alltext1, 0, -1);
		$alltext2 = substr($alltext2, 0, -1);	
		if ($productionspare !== "") {
		$productionspare = substr($productionspare, 0, -1);
		if ($equipspare !== "") {
		$equipspare = substr($equipspare, 0, -1);
		$messages = new MutiMessage();
			$replyArr = Array(
				$messages->text($alltext1),
				$messages->text($productionspare),
				$messages->text($alltext2),
				$messages->text($equipspare)
			);
			return $messages->send($replyArr);
		}else{
		//$productionspare = substr($productionspare, 0, -1);
		$messages = new MutiMessage();
			$replyArr = Array(
				$messages->text($alltext1),
				$messages->text($productionspare),
				$messages->text($alltext2)
			);
			return $messages->send($replyArr);
		}
		}else{	
		if ($equipspare !== "") {
		//$equipspare = substr($equipspare, 0, -1);
		$messages = new MutiMessage();
			$replyArr = Array(
				$messages->text($alltext1),
				$messages->text($alltext2),
				$messages->text($equipspare)
			);
			return $messages->send($replyArr);
		}else{
		$messages = new MutiMessage();
			$replyArr = Array(
				$messages->text($alltext1),
				$messages->text($alltext2),
			);
			return $messages->send($replyArr);
		}
		}
		unset($json3, $data3, $keywords, $keyword, $json2, $data2);
		}else{
		$alltext = substr($alltext1, 0, -1);
		if ($productionspare !== "") {
		//$productionspare = substr($productionspare, 0, -1);
		$messages = new MutiMessage();
			$replyArr = Array(
				$messages->text($alltext1),
				$messages->text($productionspare)
			);
			return $messages->send($replyArr);
		}else{
		return buildTextMessage(''.$alltext.'');
		}
		}
		}else{
		if ($alltext2 !== "") {
		$alltext = substr($alltext2, 0, -1);	
		if ($equipspare !== "") {
		//$equipspare = substr($equipspare, 0, -1);
		$messages = new MutiMessage();
			$replyArr = Array(
				$messages->text($alltext2),
				$messages->text($equipspare)
			);
			return $messages->send($replyArr);
		}else{
		return buildTextMessage(''.$alltext.'');
		}
		}else{
       		return buildTextMessage(''.$userName.'，我查不到這個物品的用途。');
		}
		}

	}

	//地圖
	if(stristr($inputStr, '指路') != false||
	       stristr($inputStr, '導航') != false) {
	$rplyArr = explode('#',$inputStr);
	if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
	require_once('./map.php');
	return buildTextMessage(''.$maphop.'');
	}
	//基本查詢
	if(stristr($inputStr, '查') != false) {
	$rplyArr = explode('#',$inputStr);
	if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
        return buildTextMessage('http://tw.iruna-online.info/search?search='.$rplyArr[1]);
	}
	//推送
	if(stristr($inputStr, '龘') != false||
	       stristr($inputStr, '淼') != false) {
		require_once('./push.php');
		if ($usermidtext === "yes") {
		return buildTextMessage('已推送!~');
		}else{
		return buildTextMessage('推送失敗啦@3@');
		}
	}
	//創角
	if(stristr($inputStr, '創角') != false) {
		return create($inputStr,$userName);
	}
	//天氣
	if(stristr($inputStr, '天氣') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		
		require_once('./weather.php');
		return buildTextMessage(''.$content.'');
	}
	//油價
	if(stristr($inputStr, '油價') != false) {
		require_once('./oil2.php');
		return buildTextMessage(''.$dataall.'');
		unset($data0, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data, $data10, $data11, $html, $ch, $url, $result, $dom, $xPath, $datatime, $dataall, $data01, $data001, $data00);
	}
	
	//數據統計
	if(stristr($inputStr, '數據') != false) {
		require_once('./database.php');
		return buildTextMessage(''.$dataall.'');
	}

	//離開
	if(stristr($inputStr, '再見') != false||
	       stristr($inputStr, 'bye') != false||
	       stristr($inputStr, 'Bye') != false||
	       stristr($inputStr, '再见') != false) {
	require_once('./authorization.php');
	if($userId === $owner){ 		
        if($source['type'] == "room"){  
        $roomId = $source['roomId'];
	$bot->replyMessage(array(
        'replyToken' => $event['replyToken'],
        'messages' => array(
            array(
                'type' => 'text',
                'text' => '｡ﾟヽ(ﾟ´Д`)ﾉﾟ｡有緣再見。'))));
            return $bot->leaveRoom($roomId);
        }
	if($source['type'] == "group"){  
        $groupId = $source['groupId'];
        $bot->replyMessage(array(
        'replyToken' => $event['replyToken'],
        'messages' => array(
            array(
                'type' => 'text',
                'text' => '｡ﾟヽ(ﾟ´Д`)ﾉﾟ｡有緣再見。'))));
            return $bot->leaveGroup($groupId);
        }}else{return buildTextMessage('你並沒有權限使用這個指令。');}
		
	}

	//公告
	if(stristr($inputStr, '公告') != false||
	       stristr($inputStr, '活動') != false) {
		require_once('./public.php');
	if ($data999 !== "") {
	return buildTextMessage(''.$data999.'');
	}
	if ($data999 === "") {
	return buildTextMessage('找不到你所指定的公告喔。');
	}
	}
	
	//更新筆記
	if(stristr($inputStr, 'note') != false) {
		$rplyArr = explode(' ',$inputStr);
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		require_once('../../notice.php');
		return buildTextMessage(''.$userName.'，筆記已為您更新。');
	}
	
	//更新爬蟲
	if(stristr($inputStr, '更新') != false) {
		require_once('./new.php');
		return buildcarousel($altText,$result);
		unset($data0, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $html, $ch, $url, $result, $dom, $xPath);
	}

	//查怪
	if(stristr($inputStr, 'm') != false||
	       stristr($inputStr, 'M') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		require_once('./monster.php');
		if ($store_text1 !== "") {
		return buildTextMessage(''.$store_text1.'');
		unset($json, $data, $keywords, $keyword);
		}
		if ($store_text1 === "") {
		unset($json, $data, $keywords, $keyword);
		require_once('./item4.php');
		$alltext = $a."".$b."".$c."".$d."".$e."".$f."".$g;
		if ($alltext !== "") {
		$alltext = "請用下方指令再試一次吧。\n\n--------  建議指令  --------\n".$alltext;
		$alltext = substr($alltext, 0, -1);
		return buildTextMessage(''.$alltext.'');
		}else{return buildTextMessage('資料庫沒有你要找的資料
(๑•́ ₃ •̀๑)');}
		unset($json1, $data1, $keywords, $keyword, $json2, $data2, $json3, $data3, $json4, $data5, $json5, $data5, $json6, $data6);
		}	
	}
	//查生產(文字)
	if(stristr($inputStr, 'p') != false||
	       stristr($inputStr, 'P') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		require_once('./produce.php');
		if ($alltext !== "") {
		$alltext = substr($alltext, 0, -34);
		return buildTextMessage(''.$alltext.'');
		unset($json, $data, $keywords, $keyword);
		}
		if ($alltext === "") {
		unset($json, $data, $keywords, $keyword);
		require_once('./item4.php');
		$alltext = $a."".$b."".$c."".$d."".$e."".$f."".$g;
		if ($alltext !== "") {
		$alltext = "請用下方指令再試一次吧。\n\n--------  建議指令  --------\n".$alltext;
		$alltext = substr($alltext, 0, -1);
		return buildTextMessage(''.$alltext.'');
		}else{return buildTextMessage('資料庫沒有你要找的資料
(๑•́ ₃ •̀๑)');}
		unset($json1, $data1, $keywords, $keyword, $json2, $data2, $json3, $data3, $json4, $data5, $json5, $data5, $json6, $data6);
		}
	}
	//查裝備(文字)
	if(stristr($inputStr, 'e') != false||
	       stristr($inputStr, 'E') != false) {
		$rplyArr = explode(' ',$inputStr);
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		require_once('./equip.php');
		if ($alltext !== "") {
		$alltext = substr($alltext, 0, -34);
		return buildTextMessage(''.$alltext.'');
		unset($json, $data, $keywords, $keyword, $a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l, $m);
		}
		if ($alltext === "") {
		require_once('./item4.php');
		unset($json1, $data1, $keywords, $keyword, $json2, $data2, $json3, $data3, $json4, $data5, $json5, $data5, $json6, $data6);
		$alltext = $a."".$b."".$c."".$d."".$e."".$f."".$g;
		if ($alltext !== "") {
		if(stristr($wordsave, '奇襲箱E') != false) {
		unset($json1, $data1, $keywords, $keyword, $json2, $data2, $json3, $data3, $json4, $data5, $json5, $data5, $json6, $data6);
		require_once('./item1.php');
		if ($alltext !== "") {
		$alltext = substr($alltext, 0, -34);
		return buildTextMessage(''.$alltext.'');
		unset($json, $data, $keywords, $keyword);
		}
		}else{
		$alltext = "請用下方指令再試一次吧。\n\n--------  建議指令  --------\n".$alltext;
		$alltext = substr($alltext, 0, -1);
		return buildTextMessage(''.$alltext.'');
		}
		}else{return buildTextMessage('資料庫沒有你要找的資料
(๑•́ ₃ •̀๑)');}
		unset($json1, $data1, $keywords, $keyword, $json2, $data2, $json3, $data3, $json4, $data5, $json5, $data5, $json6, $data6);
		}
	 }
	//物品
	if(stristr($inputStr, 'd') != false||
	       stristr($inputStr, 'D') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		require_once('./item1.php');
		if ($alltext !== "") {
		$alltext = substr($alltext, 0, -34);
		return buildTextMessage(''.$alltext.'');
		unset($json, $data, $keywords, $keyword);
		}
		if ($alltext === "") {
		unset($json, $data, $keywords, $keyword);
		require_once('./item4.php');
		$alltext = $a."".$b."".$c."".$d."".$e."".$f."".$g;
		if ($alltext !== "") {
		$alltext = "請用下方指令再試一次吧。\n\n--------  建議指令  --------\n".$alltext;
		$alltext = substr($alltext, 0, -1);
		return buildTextMessage(''.$alltext.'');
		}else{return buildTextMessage('資料庫沒有你要找的資料
(๑•́ ₃ •̀๑)');}
		unset($json1, $data1, $keywords, $keyword, $json2, $data2, $json3, $data3, $json4, $data5, $json5, $data5, $json6, $data6);
		}
	}
   	 //星座
	if(stristr($inputStr, '星座') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		
		require_once('./sign2.php');
		return buildTextMessage(''.$dataall.'');
		unset($data0, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9, $data10, $data11, $data12, $data13, $data14, $datatime, $dataall, $ch, $url, $html, $dom, $xPath);
	}
  	  //匯率
	if(stristr($inputStr, '匯率') != false||
	       stristr($inputStr, '汇率') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		
		require_once('./currency.php');
		return buildTextMessage(''.$dataall.'');
	}
	//查石頭(文字)
	if(stristr($inputStr, 'r') != false||
	       stristr($inputStr, 'R') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		require_once('./rock.php');
		if ($alltext !== "") {
		$alltext = substr($alltext, 0, -34);
		return buildTextMessage(''.$alltext.'');
		unset($json, $data, $keywords, $keyword);
		}
		if ($alltext === "") {
		require_once('./item4.php');
		unset($json, $data, $keywords, $keyword);
		$alltext = $a."".$b."".$c."".$d."".$e."".$f."".$g;
		if ($alltext !== "") {
		$alltext = "請用下方指令再試一次吧。\n\n--------  建議指令  --------\n".$alltext;
		$alltext = substr($alltext, 0, -1);
		return buildTextMessage(''.$alltext.'');
		}else{return buildTextMessage('資料庫沒有你要找的資料
(๑•́ ₃ •̀๑)');}
		unset($json1, $data1, $keywords, $keyword, $json2, $data2, $json3, $data3, $json4, $data5, $json5, $data5, $json6, $data6);
		}
	 }
	//栽培(文字)
	if(stristr($inputStr, '種') != false||
	       stristr($inputStr, '栽培') != false) {
		$main = "《小島栽培功能一覽》\n\n每日早上9時為澆水更新時間。\n\n島屬性對收成影響 :\n\n蔬菜類→風屬性\n穀物類→地屬性\n水果類→光屬性\n降低所有作物收成量→暗屬性\n\n--------  植物類別  --------\n葉\n花\n蘑菇\n--------  蔬菜類別  --------\n馬鈴薯\n西瓜\n胡蘿蔔\n青蔥\n蕃茄\n南瓜(未開放?)\n紅豆(未開放?)\n茄子(未開放?)\n毛豆(未開放?)\n--------  穀物類別  --------\n米\n小麥\n玉米\n--------  水果類別  --------\n橘子\n蘋果\n香蕉\n檸檬\n葡萄\n芒果\n哈蜜瓜\n可可\n櫻桃(未開放?)\n鳳梨(未開放?)\n椰子(未開放?)";
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$main.'');}
		require_once('./seed.php');
		if ($alltext !== "") {
		$testMessage = new MutiMessage();
		$replyArr = Array(
		$testMessage->text(''.$alltext.''),
		$testMessage->img($pic),
		);
		return $testMessage->send($replyArr);
		}
		if ($alltext === "") {
       		return buildTextMessage(''.$main.'');
		}
	}
	//採礦(文字)
	if(stristr($inputStr, '挖') != false||
	       stristr($inputStr, '採礦') != false) {
		$main = "《採礦功能一覽》\n\n採礦需要工具[鶴嘴鋤]\n相關裝備 : 礦工的手帕\n\n--------  採礦列表  --------\n石塊\n銅礦\n鋅礦\n秘銀\n金礦\n銀礦\n白金礦\n秘銀礦\n赤鐵礦\n冰之碎片\n白色冰棒\n石頭碎片\n紅色原石\n藍色原石\n黃色原石\n綠色原石\n白色原石\n黑色原石\n堅硬的石頭\n大馬士革鋼\n點金石礦";
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$main.'');}
		require_once('./drill.php');
		if ($alltext !== "") {
		$alltext = substr($alltext, 0, -34);
		return buildTextMessage(''.$alltext.'');
		}
		if ($alltext === "") {
       		return buildTextMessage(''.$main.'');
		}
	 }
	//鐵匠一覽(文字)
	if(stristr($inputStr, 'smith') != false||
	       stristr($inputStr, '鐵匠') != false) {
		$main = "《鐵匠出沒的城鎮一覽》\n\n--------  城鎮列表  --------\n拜倫陣地\n洛庫庫街\n月之民的村子\n首都索菲亞\n維波街\n庫雷亞街\n首都薩特利卡\n首都埃魯巴\n米那烏拉街\n斯帕加斯港\n德拉夫伯格・異邦人街\n庫雷魯教堂區\n皮拉內薩街\n卡開烏拉街\n羅古拉斯街\n奧盧多加集落\n薩特利亞府街\n庫勒伊亞車站街\n首都埃魯達恩\n拜倫地下街\n伊歐里村\n邁歐斯\n迪奧斯集落\n里奧克多伯\n米歐萊塔城\n巴蘭朵小鎮\n馬爾達利歐鬧區\n阿克魯夫城\n週年慶會場";
		$rplyArr = explode('#',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$main.'');}
		require_once('./smith.php');
		if ($alltext !== "") {
		$alltext = substr($alltext, 0, -1);
		$toptitle = "《".$code[1]."鐵匠》";
		$alltext = $toptitle."\n\n--------  配方列表  --------\n".$alltext;
		return buildTextMessage(''.$alltext.'');
		}
		if ($alltext === "") {
       		return buildTextMessage(''.$main.'');
		}
	 }
	
        //幫我選～～
	if(stristr($inputStr, '選') != false||
		stristr($inputStr, '決定') != false||
		stristr($inputStr, '选') != false||
		stristr($inputStr, '决定') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
    
		$Answer = $rplyArr[Dice(count($rplyArr)-1)];
				
		if( Dice(10) ==1){
			$rplyArr = Array(
                 '人生是掌握在自己手裡的',
                 '隨便哪個都好',
                 '連這種東西都不能決定，一邊去',
                 '不要把這種東西交給'.$keyWord.'決定比較好');
		$Answer = $rplyArr[Dice(count($rplyArr)-1)];
		}
    return buildTextMessage('我覺得'.$Answer.'吧。');
	} 
	else  
    //星能
	if(stristr($inputStr, '星能') != false) {
		$starall = "《星能力一覽》\n\n請輸入 :\n老大星能 [部位] [星能力]\n\n--------  部位列表  --------\n劍\n杖\n弓\n爪\n投\n體\n附\n特\n\n--------  能力列表  --------\n生命力\n精神力\n攻撃力\n物理防禦\n魔法防禦\n魔法力\n命中\n迴避\n亂舞\n速唱\n力士\n魔導\n體力\n神速\n巧技\n必殺\n高速使用\n高速冷卻\n自癒\n節能\n挑釁\n緩和\n治療\n藥學\n技術\n自動\n比例減輕\n癒受\n火的加護\n水的加護\n風的加護\n地的加護\n光的加護\n暗的加護\n物理貫通\n固定物理\n魔法狂化\n固定魔法\n魔法貫通\n範圍減輕\n反射\n夥伴\n收集家\n努力家";
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$starall.'');}
		
		require_once('./star.php');
		if ($startype === 1) {
		return buildTextMessage(''.$starall.'');
		}else{
		if (empty($result)) {
		return buildTextMessage('資料庫找不到喔。');
		}else{
		return buildcarousel($altText,$result);
		}
		}
	}
	else 		
	//以下是運勢功能
	if(stristr($inputStr, '運勢') != false||
	       stristr($inputStr, '占卜') != false||
		stristr($inputStr, '运势') != false) {
		$rplyArr=Array('超大吉','大吉','大吉','中吉','中吉','中吉','小吉','小吉','小吉','小吉','平','平','平','平','平','平','平','平','平','平','凶','凶','凶','大凶','超大凶','你還是，不要知道比較好','這應該不關我的事');
		return buildTextMessage(''.$userName.'，你今日的運勢是【'.$rplyArr[Dice(count($rplyArr))-1].'】喔。');
	} 
	
	//更新json檔案
	if(stristr($inputStr, '上傳') != false) {
		$rplyArr = explode('#',$inputStr);
		$updatelog = "請用[#做為區隔]，\n目前沒有可以更新的資料。\n\n--------  建議輸入  --------\n怪物\n生產\n裝備\n石頭\n星能\n地圖\n栽培\n採礦";
		if (count($rplyArr) == 1) {return buildTextMessage($updatelog);}
		require_once('./authorization.php');
		if($userId === $owner){ 
		require_once('./renewfile.php');
		return buildTextMessage($updatelog);
		unset($update, $file, $updatelog, $countno);
		}else{return buildTextMessage('你並沒有權限使用這個指令。');
		unset($update, $file, $updatelog, $countno);}
	}
	//裝備公式
	if(stristr($inputStr, '公式') != false) {
		$owner = getenv('Owner');
		$rplyArr = explode('#',$inputStr);
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，中間是#喔。');}
		require_once('./equipformula.php');
		if($userId === $owner){ 
		if ($alltext !== "") {
		$alltext = substr($alltext, 0, -34);
		return buildTextMessage(''.$alltext.'');
		unset($json0, $data0, $keywords, $keyword, $json1, $data1, $keywords1, $keyword1, $a, $b);
		}
		if ($alltext === "") {
		return buildTextMessage('資料庫沒有你要找的資料
(๑•́ ₃ •̀๑)');
		unset($json0, $data0, $keywords, $keyword, $json1, $data1, $keywords1, $keyword1, $a, $b);
		}
	}else{return buildTextMessage('你並沒有權限使用這個指令。');
	     unset($json0, $data0, $keywords, $keyword, $json1, $data1, $keywords1, $keyword1, $a, $b);}
	}
	//學說話
	if(stristr($inputStr, '學') != false) {
		$rplyArr = explode('#',$inputStr);
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		require_once('./learn.php');
		return buildTextMessage($talkreply);
	}
	//忘記說話
	if(stristr($inputStr, '忘') != false) {
		$rplyArr = explode('#',$inputStr);
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		require_once('./forgetoflearn.php');
		return buildTextMessage($talkreply);
	}

    //以下是回應功能
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
	
	
	$content = json_decode($content, true);
		
	foreach($content as $txtChack){
		foreach($txtChack['chack'] as $chack){
			//if(strcmp($inputStr, $chack) === 0){ 精準
			if(stristr($inputStr, $chack) != false){
			return buildTextMessage($txtChack['text'][Dice(count($txtChack['text']))-1]);
			break;
			}
		}
	}
	
  //沒有觸發關鍵字則是這個
	$rplyArr = $content[0]['text'];
	return buildTextMessage($rplyArr[Dice(count($rplyArr))-1]);
}


function SendImg($inputStr,$imgsReplyUrl) {

	
	//讀入圖片回應變數
	$content = file_get_contents($imgsReplyUrl);
	//如果失敗就調用預設值
	if ($content === false) {
		$content = file_get_contents('./exampleJson/imgReply.json');
	}
	
	$content = json_decode($content, true);
		
	
	foreach($content as $ImgChack){
		foreach($ImgChack['chack'] as $chack){
			
			if(stristr($inputStr, $chack) != false){
				
			$imgURL = $ImgChack['img'][Dice(count($ImgChack['img']))-1];
			
			//LINE不支援非加密協定的http://，因此在這裡代換成https://
			$imgURL = str_replace("http:","https:",$imgURL);
			return buildImgMessage($imgURL);
			break;
			}
		}
	}
	
	return null;
}
