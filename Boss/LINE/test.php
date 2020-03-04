<?php
//星座功能介面 (文字版)
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);

        //get all your data on file
        $json = file_get_contents('./exampleJson/textReply.json');
        // decode json to associative array
        $data = json_decode($json, true);
        // get array index to delete
        $arr_index = array();
        foreach ($data as $key => $value) {
        if ($value['chack'] == "11") {
        $arr_index[] = $key;
        }
        break;
        }
        // delete data
        foreach ($arr_index as $i) {
        unset($data[$i]);
        break;
        }
        // rebase array
        $data = array_values($data);
        // encode array to json and save to file
        file_put_contents('./exampleJson/textReply.json', json_encode($data));
  
