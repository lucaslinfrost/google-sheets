<?php
//星座功能介面 (文字版)
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$googledataspi = getenv('googledataspi4');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);

foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
        $message = $event['message'];
        $code = explode(' ', $message['text']);
        // 資料起始從feed.entry          
        
        
        //get all your data on file
        $json = file_get_contents('teste_data.json');
        // decode json to associative array
        $data = json_decode($json, true);

        // get array index to delete
        $arr_index = array();
        foreach ($data as $key => $value) {
        if ($value['YOUR KEY'] == SOME VALUE TO COMPARE) {
        $arr_index[] = $key;
        }
        }

        // delete data
        foreach ($arr_index as $i) {
        unset($data[$i]);
        }

        // rebase array
        $data = array_values($data);

        // encode array to json and save to file
        file_put_contents('teste_data.json', json_encode($data));
        
        
        
        
        
        
        
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
