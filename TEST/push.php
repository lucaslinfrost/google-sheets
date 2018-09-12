require_once dirname(__FILE__) . '/common.php';
 
//誕生日データを読み込む
$birthdays = get_birthday_data();
 
//今日の日付を取得
$today = [
  "month" => date("n"),
  "day" => date("j")
];
 
//今日誕生日の人がいたら「おめでとう」メッセージを送る
foreach ($birthdays->{"birthdays"} as $user) {
  if ($user->{"month"} == $today["month"] && $user->{"day"} == $today["day"]) {
    push_message(
      [
        "to" => $user->{"groupId"},
        "messages" => [
          [
            "type" => "text",
            "text" => $user->{"name"} . "君お誕生日おめでとう！"
          ]
        ]
      ]
    );
  }
}
