<?php
//設定值
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$channelID = getenv('LINE_Channel_ID');
define("CLIENT_ID", $channelID);
define("CLIENT_SECRET", $channelSecret);
define("REDIRECT_URI", 'https://irunamuscelboss.herokuapp.com/Boss/LINE/callback');//登入後返回位置
define("SCOPE", 'openid%20profile%20email');//授權範圍以%20分隔 可以有3項openid，profile，email
