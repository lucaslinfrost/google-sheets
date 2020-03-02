<?php
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$bot = new LINEBotTiny($channelAccessToken, $channelSecret);

$json_string = file_get_contents('php://input');

$file = fopen("./exampleJson/test.json", "a+");
//***將收到的資料存到文字黨做紀錄***
fwrite($file, "\n使用者傳送資料\n");
fwrite($file, $json_string."\n"); 
$json_obj = json_decode($json_string);

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
fwrite($file, json_encode($post_data)."\n");
//***將訊息發出去然後關閉寫入***
doBotPost($post_data,$access_token,$file);

function doBotPost($post_data,$access_token,$file){
  $ch = curl_init("https://api.line.me/v2/bot/message/reply");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Authorization: Bearer '.$access_token
      //'Authorization: Bearer '. TOKEN
  ));
  $result = curl_exec($ch);
  fwrite($file, $result."\n");  
  fclose($file);
  curl_close($ch); 
}
