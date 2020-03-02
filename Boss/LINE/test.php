<?php
require_once('./LINEBotTiny.php');
require_once('./test2.php');
$access_token = getenv('LINE_CHANNEL_ACCESSTOKEN');
$secret = getenv('LINE_CHANNEL_SECRET');
$bot = new LINEBotTiny($access_token, $secret);
$json_string = file_get_contents('php://input');
$file = fopen("./exampleJson/test.json", "a+");
$json_obj = json_decode($json_string);

  if (empty($json_obj->{"birthdays"})) {
    $new_id = 1;
  }
  else {
    $used_nums = [];
    foreach ($json_obj->{"birthdays"} as $user) {
      array_push($used_nums, $user->{"birthdayId"});
    }
    $new_id = max($used_nums) + 1;
  }

//***將收到的資料存到文字黨做紀錄***
fwrite($file, "第[".$new_id."]筆資料。\n"); 
fwrite($file, "\n使用者傳送資料\n");
fwrite($file, $json_string."\n"); 

$event = $json_obj->{"events"}[0];
$type  = $event->{"message"}->{"type"};
$message = $event->{"message"};
$reply_token = $event->{"replyToken"};    
//***先將使用者傳送內容存到變數$message_data***
$message_data = doType($type,$message->{"text"});
//***BOT要發送的訊息***
$post_data = doPostData($reply_token,$message_data);
//***將post_data(BOT發送訊息)存到文字黨做紀錄***
fwrite($file, "系統回復資訊\n");
fwrite($file, json_encode($post_data)."\n\n");
//***將訊息發出去然後關閉寫入***
doBotPost($post_data,$access_token,$file);
