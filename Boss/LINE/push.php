<?php
$access_token = getenv('LINE_CHANNEL_ACCESSTOKEN');

$url = 'https://api.line.me/v2/bot/message/push';

// データの受信(するものないので不要?)
$raw = file_get_contents('php://input');
$receive = json_decode($raw, true);
// イベントデータのパース(不要？)
$event = $receive['events'][0];

// ヘッダーの作成
$headers = array('Content-Type: application/json',
                 'Authorization: Bearer ' . $access_token);

// 送信するメッセージ作成
$message = array('type' => 'text',
                 'text' => "@3@");

$body = json_encode(array('to' => "C61e972897c6d2880f2e7d0998a18a9e7",
                          'messages'   => array($message)));  // 複数送る場合は、array($mesg1,$mesg2) とする。


// 送り出し用
$options = array(CURLOPT_URL            => $url,
                 CURLOPT_CUSTOMREQUEST  => 'POST',
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_HTTPHEADER     => $headers,
                 CURLOPT_POSTFIELDS     => $body);
$curl = curl_init();
curl_setopt_array($curl, $options);
curl_exec($curl);
curl_close($curl);
