<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

/*
 * This polyfill of hash_equals() is a modified edition of https://github.com/indigophp/hash-compat/tree/43a19f42093a0cd2d11874dff9d891027fc42214
 *
 * Copyright (c) 2015 Indigo Development Team
 * Released under the MIT license
 * https://github.com/indigophp/hash-compat/blob/43a19f42093a0cd2d11874dff9d891027fc42214/LICENSE
 */
if (!function_exists('hash_equals')) {
    defined('USE_MB_STRING') or define('USE_MB_STRING', function_exists('mb_strlen'));

    function hash_equals($knownString, $userString)
    {
        $strlen = function ($string) {
            if (USE_MB_STRING) {
                return mb_strlen($string, '8bit');
            }

            return strlen($string);
        };

        // Compare string lengths
        if (($length = $strlen($knownString)) !== $strlen($userString)) {
            return false;
        }

        $diff = 0;

        // Calculate differences
        for ($i = 0; $i < $length; $i++) {
            $diff |= ord($knownString[$i]) ^ ord($userString[$i]);
        }
        return $diff === 0;
    }
}

class LINEBotTiny
{
    public function __construct($channelAccessToken, $channelSecret)
    {
        $this->channelAccessToken = $channelAccessToken;
        $this->channelSecret = $channelSecret;
    }

    public function parseEvents()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            error_log("Method not allowed");
            exit();
        }

        $entityBody = file_get_contents('php://input');

        if (strlen($entityBody) === 0) {
            http_response_code(400);
            error_log("Missing request body");
            exit();
        }

        if (!hash_equals($this->sign($entityBody), $_SERVER['HTTP_X_LINE_SIGNATURE'])) {
            http_response_code(400);
            error_log("Invalid signature value");
            exit();
        }

        $data = json_decode($entityBody, true);
        if (!isset($data['events'])) {
            http_response_code(400);
            error_log("Invalid request body: missing events property");
            exit();
        }
        return $data['events'];
    }

    public function replyMessage($message)
    {
        $header = array(
            "Content-Type: application/json",
            'Authorization: Bearer ' . $this->channelAccessToken,
        );

        $context = stream_context_create(array(
            "http" => array(
                "method" => "POST",
                "header" => implode("\r\n", $header),
                "content" => json_encode($message),
            ),
        ));

        $response = file_get_contents('https://api.line.me/v2/bot/message/reply', false, $context);
        if (strpos($http_response_header[0], '200') === false) {
            #http_response_code(500);
            error_log("Request failed: " . $response);
        }
    }
	/*
	public function replyMessage($replyToken, MessageBuilder $messageBuilder)
    {
        return $this->httpClient->post($this->endpointBase . '/v2/bot/message/reply', [
            'replyToken' => $replyToken,
            'messages' => $messageBuilder->buildMessage(),
        ]);
    }
	
	public function getProfile($userId)
    {
        return $this->httpClient->get($this->endpointBase . '/v2/bot/profile/' . urlencode($userId));
    }*/
	
	public function getProfile($userId)
    {	$header = array(
            'Authorization: Bearer ' . $this->channelAccessToken ."\r\n",
        );

        $context = stream_context_create(array(
            "http" => array(
                "method" => "GET",
                "header" => $header,               
            ),
        ));
		$url='https://api.line.me/v2/bot/profile/'.urlencode($userId);
        $response = file_get_contents($url, false, $context);
		$response = json_decode($response,true);
        return $response;
    }
	
	public function getGroupProfile($groupId,$userId)
    {	$header = array(
            'Authorization: Bearer ' . $this->channelAccessToken ."\r\n",
        );

        $context = stream_context_create(array(
            "http" => array(
                "method" => "GET",
                "header" => $header,               
            ),
        ));

		$url='https://api.line.me/v2/bot/group/'.urlencode($groupId).'/member/'.urlencode($userId);
        $response = file_get_contents($url, false, $context);
		$response = json_decode($response,true);
        return $response;
    }
	
	public function getRoomProfile($roomId,$userId)
    {	$header = array(
            'Authorization: Bearer ' . $this->channelAccessToken ."\r\n",
        );

        $context = stream_context_create(array(
            "http" => array(
                "method" => "GET",
                "header" => $header,               
            ),
        ));

		$url='https://api.line.me/v2/bot/room/'.urlencode($roomId).'/member/'.urlencode($userId);
        $response = file_get_contents($url, false, $context);
		$response = json_decode($response,true);
        return $response;
    }
	
	public function getGroupIDs($groupId)
    {	$header = array(
            'Authorization: Bearer ' . $this->channelAccessToken ."\r\n",
        );

        $context = stream_context_create(array(
            "http" => array(
                "method" => "GET",
                "header" => $header,               
            ),
        ));		
		$url='https://api.line.me/v2/bot/group/'.$groupId.'/members/ids';
        $response = file_get_contents($url, false, $context);
		$response = json_decode($response,true);
        return $response;
    }
	
	public function getRoomIDs($roomId)
    {	$header = array(
            'Authorization: Bearer ' . $this->channelAccessToken ."\r\n",
        );

        $context = stream_context_create(array(
            "http" => array(
                "method" => "GET",
                "header" => $header,               
            ),
        ));		
		$url='https://api.line.me/v2/bot/room/'.$roomId.'/members/ids';
        $response = file_get_contents($url, false, $context);
		$response = json_decode($response,true);
        return $response;
    }
	

    private function sign($body)
    {
        $hash = hash_hmac('sha256', $body, $this->channelSecret, true);
        $signature = base64_encode($hash);
        return $signature;
    }

	
	

public function leaveRoom($roomId)
{
    $header = array(
        'Authorization: Bearer ' . $this->channelAccessToken,
    );

    $context = stream_context_create(array(
        "http" => array(
            "method" => "POST",
            "header" => implode("\r\n", $header),
            "content" => "[]",
        ),
    ));

    $response = file_get_contents('https://api.line.me/v2/bot/room/'.urlencode($roomId).'/leave', false, $context);
    if (strpos($http_response_header[0], '200') === false) {
        http_response_code(500);
        error_log("Request failed: " . $response);
    }
}

public function leaveGroup($groupId)
{
    $header = array(
        'Authorization: Bearer ' . $this->channelAccessToken,
    );

    $context = stream_context_create(array(
        "http" => array(
            "method" => "POST",
            "header" => implode("\r\n", $header),
            "content" => "[]",
        ),
    ));

    $response = file_get_contents('https://api.line.me/v2/bot/group/'.urlencode($groupId).'/leave', false, $context);
    if (strpos($http_response_header[0], '200') === false) {
        http_response_code(500);
        error_log("Request failed: " . $response);
    }
}

public function getGroupSummary($groupId)
{
    $header = array(
        'Authorization: Bearer ' . $this->channelAccessToken,
    );

    $context = stream_context_create(array(
        "http" => array(
            "method" => "POST",
            "header" => implode("\r\n", $header),
            "content" => "[]",
        ),
    ));

    $response = file_get_contents('https://api.line.me/v2/bot/group/'.urlencode($groupId).'/summary', false, $context);
    if (strpos($http_response_header[0], '200') === false) {
        http_response_code(500);
        error_log("Request failed: " . $response);
    }
}

	
}
