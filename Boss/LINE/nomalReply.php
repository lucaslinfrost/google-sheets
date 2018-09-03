<?php
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
	if(stristr($inputStr,'說明') != false){ 
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
	
	
	
	//更新日誌與公告，使用外聯檔案
	//可以是為一個使用外聯檔案的範例
	if(stristr($inputStr, '公告') != false) {
		
		$file = fopen("https://tx9vs5swfgjw9nqh1z3gyw-on.drv.tw/iruna%20produce/iruna/note.txt", "r");
		$reply = '';
		//輸出文本中所有的行，直到文件結束為止。
		while(! feof($file))
		{
			$reply =  $reply.fgets($file);
		}
		//當讀出文件一行後，就在後面加上 <br> 讓html知道要換行
		fclose($file);
		
		return buildTextMessage($reply);
	}
	
	//更新爬蟲
	if(stristr($inputStr, '更新') != false) {
		require_once('./new.php');
	}
	
          
    //幫我選～～
	if(stristr($inputStr, '選') != false||
		stristr($inputStr, '決定') != false||
		stristr($inputStr, '抽') != false||
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
    //查怪
	if(stristr($inputStr, '怪物') != false||
	       stristr($inputStr, 'm') != false||
	       stristr($inputStr, 'M') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		
		require_once('./bot2.php');
	}
	else   
    //查生產(旋轉木馬)
	if(stristr($inputStr, '生產') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
    
		require_once('./produce.php');
	}
	else    
    //查生產(文字)
	if(stristr($inputStr, 'p') != false||
	       stristr($inputStr, 'P') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
    
		require_once('./produce2.php');
	}
	else   
    //物品
	if(stristr($inputStr, '掉落') != false||
	       stristr($inputStr, 'd') != false||
	       stristr($inputStr, 'D') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
    
		require_once('./item1.php');
	}
	else  
    //星能
	if(stristr($inputStr, '星能') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		
		require_once('./star.php');
	}
	else 		
	//以下是運勢功能
	if(stristr($inputStr, '運勢') != false||
	       stristr($inputStr, '占卜') != false) {
		$rplyArr=Array('超大吉','大吉','大吉','中吉','中吉','中吉','小吉','小吉','小吉','小吉','凶','凶','凶','大凶','大凶','你還是，不要知道比較好','這應該不關我的事');
		return buildTextMessage(''.$userName.'，你今日的運勢是【'.$rplyArr[Dice(count($rplyArr))-1].'】喔。');
	} 
	else  
    //星座
	if(stristr($inputStr, '星座') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		
		require_once('./sign.php');
	}
	else  
    //匯率
	if(stristr($inputStr, '匯率') != false) {
		
		$rplyArr = explode(' ',$inputStr);
    
		if (count($rplyArr) == 1) {return buildTextMessage(''.$userName.'，你到底想讓我做啥?');}
		
		require_once('./currency.php');
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
