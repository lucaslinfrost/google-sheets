<?php

//技能搜索介面(旋轉木馬版)

require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $json = file_get_contents('./data/skill.json');
            $data = json_decode($json, true);
            $code = explode(' ', $message['text']);
            $result = array();
	    $per3skill = array();
            $per3skills = array();
            $countnum = 0;
            $i = 0;
            $altText = "關於 ".$message['text']." 的資料";
            foreach ($data['feed']['entry'] as $item) {
                $keywords = explode(',', $item['gsx$job']['$t']);
		$len = count($keywords);
                foreach ($keywords as $keyword) {
		$i++;
                        if (strcmp($code[1], $keyword) === 0) {
				if($i != $len){
				$allskill =  array(array(
                                    'type' => 'message',
                                    'label' => $item['gsx$skname']['$t']."".$item['gsx$sklv']['$t'],
                                    'text' => "測試",
                                    ),);
				}
				
			
                        $candidate = array(
                            'thumbnailImageUrl' => 'https://imgur.com/KQsuipD.png',
                            'title' => $item['gsx$job']['$t'],
                            'text' => $item['gsx$job']['$t'],
                            'actions' => $allskill,
                            );
                        array_push($result, $candidate);
		   }
                }
            }

            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
