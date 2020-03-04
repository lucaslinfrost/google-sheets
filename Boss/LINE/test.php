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
        $json = file_get_contents($googledataspi);
        $data = json_decode($json, true);
  
        $code = explode(' ', $message['text']);
        // 資料起始從feed.entry          
        
        
        //get all your data on file
        $data = file_get_contents('teste_data.json');
        // decode json to associative array
        $json_arr = json_decode($data, true);

        // get array index to delete
        $arr_index = array();
        foreach ($json_arr as $key => $value) {
        if ($value['YOUR KEY'] == SOME VALUE TO COMPARE) {
        $arr_index[] = $key;
        }
        }

        // delete data
        foreach ($arr_index as $i) {
        unset($json_arr[$i]);
        }

        // rebase array
        $json_arr = array_values($json_arr);

        // encode array to json and save to file
        file_put_contents('teste_data.json', json_encode($json_arr));
        
        
        
        
        
        
        
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
