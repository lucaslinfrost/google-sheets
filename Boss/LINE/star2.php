<?php

//星能力搜索介面(Flex面版)

require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $json = file_get_contents('./data/star.json');
            $data = json_decode($json, true);
            $code = explode(' ', $message['text']);
            $result = array();
            $altText = "關於 ".$message['text']." 的資料";
            //$altText = "關於 ".$message['text']." 的資料";
            foreach ($data['feed']['entry'] as $item) {
                $keywords = explode(',', $item['gsx$keyword']['$t']);
                foreach ($keywords as $keyword) {
                    if (strcmp($code[2], $keyword) === 0) {
                        if (strpos($code[1], $item['gsx$key']['$t']) !== false) {
                        $candidate = array(
      'type' => 'bubble',
      'size' => 'micro',
      'hero' => array(
        'type' => 'image',
        'url' => 'https://imgur.com/KQsuipD.png',
        'size' => 'full',
        'aspectMode' => 'fit',
        'aspectRatio' => '320:213'
      ),
      'body' => array(
        'type' => 'box',
        'layout' => 'vertical',
        'contents' => array(
          array(
            'type' => 'text',
            'text' => $item['gsx$name']['$t'],
            'weight' => 'bold',
            'size' => 'sm',
            'wrap' => true,
            'align' => 'center'
          ),
          array(
            'type' => 'box',
            'layout' => 'baseline',
            'contents' => array(
              array(
                'type' => 'text',
                'text' => $item['gsx$map']['$t'],
                'size' => 'xs',
                'color' => '#8c8c8c',
                'margin' => 'md',
                'align' => 'center'
              )
            )
          ),
          array(
            'type' => 'box',
            'layout' => 'vertical',
            'contents' => array(
              array(
                'type' => 'box',
                'layout' => 'baseline',
                'spacing' => 'sm',
                'contents' => array(
                  array(
                    'type' => 'text',
                    'text' => $item['gsx$equip']['$t'],
                    'wrap' => true,
                    'color' => '#252dba',
                    'size' => 'sm',
                    'align' => 'center',
                    'action' => array(
                      'type' => 'message',
                      'label' => 'action',
                      'text' => "老大D ".$item['gsx$equip']['$t'],
                    )
                  )
                )
              )
            )
          )
        ),
        'spacing' => 'sm',
        'paddingAll' => '13px',
        'backgroundColor' => '#edece8',
        'justifyContent' => 'space-evenly'
      )
    );
                        array_push($result, $candidate);
		        }
                    }else{
                        if($code[2] === null||
		        $code[2] === "") {
                        $startype = 1;
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
