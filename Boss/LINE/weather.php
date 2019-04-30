<?php
//其他功能介面 (文字版)
require_once('./LINEBotTiny.php');
require_once('./utf8_chinese.class.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
// 取得事件(只接受文字訊息)
foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
        // 讀入訊息
        $message = $event['message'];
        $content = "";
        $code = explode(' ', $message['text']);
        $data = "theCityName=".$code[1];
    	$curlobj = curl_init();
    curl_setopt($curlobj, CURLOPT_URL, "http://www.webxml.com.cn/WebServices/WeatherWebService.asmx/getWeatherbyCityName");
    curl_setopt($curlobj, CURLOPT_HEADER, 0); // 不显示 Header
    curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, 1); // 只是下载页面内容，不直接打印
    curl_setopt($curlobj, CURLOPT_POST, 1); // 此请求为 post 请求
    curl_setopt($curlobj, CURLOPT_POSTFIELDS, $data); // 传递 post 参数
    curl_setopt($curlobj, CURLOPT_HTTPHEADER, array(
        "application/x-www-form-urlencoded;charset=utf-8",
        "Content-length: ".strlen($data)
        )); // 设置 HTTP Header
    curl_setopt($curlobj, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36'); // 伪造一个 HTTP_USER_AGENT 信息，解决为将对象引用设置到对象的实例问题
    $rtn = curl_exec($curlobj);   
    $rtn = str_replace("</string>","",$rtn);
    $rtn = str_replace(" ","",$rtn);
    $rtn = explode('<string>', $rtn);
    $rtns = explode('；', $rtn[11]);
    $rtns[0] = str_replace("实况：","实况：\n",$rtns[0]);
    $rtns[3] = str_replace("空气","\n空气",$rtns[3]);
    $content = "地區 : ".$rtn[1]."城市 : ".$rtn[2]."\n".$rtns[0]."\n".$rtns[1]."\n".$rtns[2]."\n".$rtns[3]."\n--------三日天氣--------\n".$rtn[7]."".$rtn[6]."".$rtn[8]."\n".$rtn[14]."".$rtn[13]."".$rtn[15]."\n".$rtn[19]."".$rtn[18]."".$rtn[20];
    $c = new utf8_chinese;
    $content = $c->gb2312_big5($content);
    if(!curl_errno($curlobj)) {
    } else {
    $content = "沒有。";
    }  
         
        break;
    default:
        error_log("Unsupporeted event type: " . $event['type']);
        break;
}
};
