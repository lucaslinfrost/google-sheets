<?php
 
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$password = 'login';      // user login password
$dbFilePath = 'line-db.json';        // user info database file path
 
if (!file_exists($dbFilePath)) {
   file_put_contents($dbFilePath, json_encode(['user' => []]));
}
$db = json_decode(file_get_contents($dbFilePath), true);
 
$bodyMsg = file_get_contents('php://input');
 
file_put_contents('log.txt', date('Y-m-d H:i:s') . 'Recive: ' . $bodyMsg);
 
$obj = json_decode($bodyMsg, true);
 
file_put_contents('log.txt', print_r($db, true));
 
foreach ($obj['events'] as &$event) {
 
   $userId = $event['source']['userId'];
 
   // bot dirty logic
   if (!isset($db['user'][$userId])) {
       if ($event['message']['text'] === $password) {
           $db['user'][$userId] = [
               'userId' => $userId,
               'timestamp' => $event['timestamp']
           ];
           file_put_contents($dbFilePath, json_encode($db));
           $message = 'ID : '.$userId.' 已開通權限';
       } else {
           $message = '錯啦';
       }
   } else {
       if (strtolower($event['message']['text']) === 'logout') {
           unset($db['user'][$userId]);
           file_put_contents($dbFilePath, json_encode($db));
           $message = 'ID : '.$userId.' 使用權限已撤銷';
       } else {
           //指令
       }
   }
 
   // Make payload
   $payload = [
       'replyToken' => $event['replyToken'],
       'messages' => [
           [
               'type' => 'text',
               'text' => $message
           ]
       ]
   ];
 
   // Send reply API
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/bot/message/reply');
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
   curl_setopt($ch, CURLOPT_HTTPHEADER, [
       'Content-Type: application/json',
       'Authorization: Bearer ' . $channelAccessToken
   ]);
   $result = curl_exec($ch);
   curl_close($ch);
   
}