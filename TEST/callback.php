<?php

require_once dirname(__FILE__) . '/common.php';

//APIから送信されてきたイベントオブジェクトを取得
$json_string = file_get_contents('php://input');
$json_obj = json_decode($json_string);

//イベントオブジェクトから必要な情報を抽出
$source = $json_obj->{"events"}[0]->{"source"};
$message = $json_obj->{"events"}[0]->{"message"};
$reply_token = $json_obj->{"events"}[0]->{"replyToken"};

//グループトークからのメッセージのみ受け付け、グループIDを抽出
if ($source->{"type"} != "group") {
  exit;
}
$group_id = $source->{"groupId"};
/**
 * 誕生日情報は「誕生日,(名前),(月),(日)」の形式で受け付ける
 * 例:「誕生日,山田,11,14」
 */

//カンマを区切りとして文字列を分割する（半角スペースがある場合は除去する）
$space_ignored = str_replace(" ", "", $message->{"text"});
$exploded = explode(",", $space_ignored);

//誕生日登録の形式に沿ったメッセージならば誕生日を登録する
if ($exploded[0] == "誕生日" && count($exploded) == 4) {
  register_birthday($exploded[1], $group_id, $exploded[2], $exploded[3]);
}
else {
  //誕生日情報以外の発言には、オウム返しをする
  reply_message(
    [
      "replyToken" => $reply_token,
      "messages" => [
        [
          "type" => "text",
          "text" => $message->{"text"}
        ]
      ]
    ]
  );
}
