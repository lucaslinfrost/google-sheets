<?php
//其他功能介面 (文字版)
require_once('./LINEBotTiny.php');
// Token in Heroku
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                	$m_message = $message['text'];
                	if($m_message != "")
                	{						
						if(preg_match("/^\抽/i", $m_message))	// 抽開頭的字樣
						{			
							$image_link = GetImgurIamge($m_message);	// 取得圖片網址
							if($image_link == "")	// 無法取得則給 DialogFlow 回應
							{
								$m_message = "聽不懂在抽什麼啦！";	// 給下方 DialogFlow 使用											
							}
							else
							{
								$client->replyMessage(array(
									'replyToken' => $event['replyToken'],
									'messages' => array(
									array(								
									'type' => 'image', 						// 訊息類型 (圖片)
									'originalContentUrl' => $image_link, 	// 回復圖片
									'previewImageUrl' => $image_link 		// 回復的預覽圖片									
									))));										
									
									return;	
							}																					
						}
						
						// DialogFlow
						{							
							$client->replyMessage(array(
							'replyToken' => $event['replyToken'],
							'messages' => array(
								array(
									'type' => 'text',
									'text' => GetDialogFlowWord($m_message)
								)
							)
							));									
						}													
                	}
                    break;                
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
	
	
function GetDialogFlowWord($Word)
{
	require_once __DIR__.'/vendor/autoload.php';
	require_once('./DialogFlow_Src/DialogFlow_Client.php');	
	// Token in Heroku
	$DialogFlow_Secret = getenv('DialogFlow_Secret');	
	try {
			$client = new DialogFlow\DialogFlow_Client($DialogFlow_Secret);
		
		    $query = $client->get('query', [
			'query' => $Word,
			'sessionId' => '1234567890',
			'lang' => 'zh-TW',
		]);
		$response = json_decode((string) $query->getBody(), true);
		return $response['result']['fulfillment']['speech'];		
	} 
	catch (\Exception $error)
	{
		echo $error->getMessage();
	}	
}

    
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
