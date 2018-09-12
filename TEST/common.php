<?php

$access_token = "ChKKj7aTRtfWOZsv71oc0ilIiOIJ91ognBajGGrjWf9WNkiHrZ5wH1xHBNEm7j7fix0cxHEdSQxt8o26O2opFlc0q1RhgAYkbKXCDMONuOQ6hHCn2TsjOgF+zewQJqd78ZqR0bJYDwlbZ7kwKmv8MQdB04t89/1O/w1cDnyilFU=";
$storage_file_path = dirname(__FILE__) . "/birthdays.json";

//メッセージに対して返信する
function reply_message($post_data){
  global $access_token;

  //curlを用いてメッセージを送信する
  $ch = curl_init("https://api.line.me/v2/bot/message/reply");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json; charser=UTF-8',
      'Authorization: Bearer ' . $access_token
  ));
  $result = curl_exec($ch);
  curl_close($ch);
}

//誕生日データを読み込む
function get_birthday_data(){
  global $storage_file_path;

  //読み込むファイルが存在しなかった場合は空の誕生日データを返す
  if (!file_exists($storage_file_path)) {
    return json_decode('{"birthdays": []}');
  }

  $json_string = file_get_contents($storage_file_path);
  return json_decode($json_string);
}

//誕生日を登録する
function register_birthday($name, $group_id, $month, $day){
  global $storage_file_path;

  $birthdays = get_birthday_data();
  
  //登録するデータにIDを割り振る
  if (empty($birthdays->{"birthdays"})) {
    $new_id = 1;
  }
  else {
    $used_nums = [];
    foreach ($birthdays->{"birthdays"} as $user) {
      array_push($used_nums, $user->{"birthdayId"});
    }
    $new_id = max($used_nums) + 1;
  }

  //新規の誕生日データを挿入
  array_push(
    $birthdays->{"birthdays"},
    [
      "birthdayId" => $new_id,
      "name" => $name,
      "groupId" => $group_id,
      "month" => $month,
      "day" => $day
    ]
  );

  //誕生日データをJSONファイルに書き込む
  return file_put_contents($storage_file_path, json_encode($birthdays));
}
//メッセージをプッシュする
function push_message($post_data){
  global $access_token;

  //curlを用いてメッセージを送信する
  $ch = curl_init("https://api.line.me/v2/bot/message/push");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charser=UTF-8',
    'Authorization: Bearer ' . $access_token
    ));
  $result = curl_exec($ch);
  curl_close($ch);
}
70
71
72
73
74
75
76
77
78
79
80
81
82
83
84
85
86
//メッセージをプッシュする
function push_message($post_data){
  global $access_token;
 
  //curlを用いてメッセージを送信する
  $ch = curl_init("https://api.line.me/v2/bot/message/push");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charser=UTF-8',
    'Authorization: Bearer ' . $access_token
    ));
  $result = curl_exec($ch);
  curl_close($ch);
}
