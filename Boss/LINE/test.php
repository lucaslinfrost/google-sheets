<?php
//星座功能介面 (文字版)
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);

$data = file_get_contents('./exampleJson/textReply.json');
$json_arr = json_decode($data, true);
// get array index to delete
$arr_index = array();
foreach ($json_arr as $key => $value) {
$n = array ("11");
if ($value['chack'] == $n) {
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
file_put_contents('./exampleJson/textReply.json', json_encode($json_arr, JSON_UNESCAPED_UNICODE));
