<?php
require  'vendor/autoload.php';
require_once('./LINEBotTiny.php');
date_default_timezone_set('Asia/Taipei');
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
	$message = $event['message'];
	$keywords = explode(' ', $message['text']);
	$key = array_slice($keywords, 1, -1);
	$key1 = implode(" ",$key);
}
}

putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/My Project-aeb1d8a3a4ed.json');
		/*  SEND TO GOOGLE SHEETS */
		 $client = new Google_Client;
			try{
				$client->useApplicationDefaultCredentials();
			  $client->setApplicationName("Something to do with my representatives");
				$client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
			   if ($client->isAccessTokenExpired()) {
					$client->refreshTokenWithAssertion();
				}
				$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
				ServiceRequestFactory::setInstance(
					new DefaultServiceRequest($accessToken)
				);
			   // Get our spreadsheet
				$spreadsheet = (new Google\Spreadsheet\SpreadsheetService)
					->getSpreadsheetFeed()
					->getByTitle('sheetlog');
				// Get the first worksheet (tab)
				$worksheets = $spreadsheet->getWorksheetFeed()->getEntries();
				$worksheet = $worksheets[1];
				$listFeed = $worksheet->getListFeed();
				$listFeed->insert([
					'name' => "'". $userName,
					'message' => "'". $key1,
					'title' => "'". '公告',
					'date' => date_create('now')->format('Y-m-d H:i:s')
				]);
			}catch(Exception $e){
			  echo $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile() . ' ' . $e->getCode;
			}
			/*  SEND TO GOOGLE SHEETS */
