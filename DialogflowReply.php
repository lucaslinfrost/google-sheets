<?php
//其他功能介面 (文字版)
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
// 取得事件(只接受文字訊息)
foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
        // 讀入訊息
    $message = $event['message'];
 // DialogFlow
    
							$client->replyMessage(array(
							'replyToken' => $event['replyToken'],
							'messages' => array(
								array(
									'type' => 'text',
									'text' => GetDialogFlowWord($m_message)
								)
							)
							));									
    
    
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
