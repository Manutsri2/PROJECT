<?php

$access_token = '7E/Ub3PcomIMFVemjLJKZJqTjiPo0LgEmKL3gybU+2i4JTe/rIDpOM21XcvHVfUCnfWS/nCsoaEdSbVpGL8J2yDmpXMmk4708xxB49wY/h2G6nMEQpPJHuMz5luKXg+g/p1LnRGQFoKX+mimkVLrsgdB04t89/1O/w1cDnyilFU=';

$doc = new DomDocument;
$doc->validateOnParse = true;
$doc->Load('graduate.xml');
$announce = $doc->getElementsByTagName('object');

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			if($text == "1")
			{
			$k = 0;
			$obj1 = $announce->item($k)->getElementsByTagName('title')->item(0)->nodeValue;
			$obj1_1 = $announce->item($k)->getElementsByTagName('pic1')->item(0)->nodeValue;
			$obj1_2 = $announce->item($k)->getElementsByTagName('pic2')->item(0)->nodeValue;
			// Build message to reply back
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => $obj.\n.$obj
				
				];
			$messages2 = 
				[
				
				'type' => 'image',
    				'originalContentUrl' => $obj1_1,
    				'previewImageUrl' => $obj1_2
				
				];
				
			}
			else if($text == "2")
			{
			$k = 1;
			$obj1 = $announce->item($k)->getElementsByTagName('title')->item(0)->nodeValue;
			$obj1_1 = $announce->item($k)->getElementsByTagName('pic1')->item(0)->nodeValue;
			$obj1_2 = $announce->item($k)->getElementsByTagName('pic2')->item(0)->nodeValue;
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => $obj1
				
				];
			$messages2 = 
				[
				
				'type' => 'image',
    				'originalContentUrl' => $obj1_1,
    				'previewImageUrl' => $obj1_2
				
				];
				
			}
			else if($text == "3")
			{
			$k = 2;
			$obj1 = $announce->item($k)->getElementsByTagName('title')->item(0)->nodeValue;
			$obj1_1 = $announce->item($k)->getElementsByTagName('pic1')->item(0)->nodeValue;
			$obj1_2 = $announce->item($k)->getElementsByTagName('pic2')->item(0)->nodeValue;
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => $obj1
				
				];
			$messages2 =
				[
				
				'type' => 'image',
    				'originalContentUrl' => $obj1_1,
    				'previewImageUrl' => $obj1_2
				
				];
			}
			else if($text == "4")
			{
			$k = 3;
			$obj1 = $announce->item($k)->getElementsByTagName('title')->item(0)->nodeValue;
			$obj1_1 = $announce->item($k)->getElementsByTagName('way')->item(0)->nodeValue;
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => $obj1
				
				];
			$messages2 =
				[
				
				'type' => 'text',
    				'text' => $obj1_1
				
				];
			}
			else if($text == "000")
			{
			$k = 4;
			$obj1 = $announce->item($k)->getElementsByTagName('title')->item(0)->nodeValue;
			$obj1_1 = $announce->item($k)->getElementsByTagName('tel')->item(0)->nodeValue;
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => $obj1
				
				];
			$messages2 =
				[
				
				'type' => 'text',
    				'text' => $obj1_1
				
				];
			}
			else if($text == "?")
			{
			$k = 5;
			$obj1 = $announce->item($k)->getElementsByTagName('title')->item(0)->nodeValue;
			$obj1_1 = $announce->item($k)->getElementsByTagName('deta')->item(0)->nodeValue;
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => $obj1
				
				];
			$messages2 =
				[
				
				'type' => 'text',
    				'text' => $obj1_1
				
				];
			}
			else
			{
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => 'ไม่มีข้อมูลที่ท่านสอบถาม'
				
				];
			$messages2 =
				[
				
				'type' => 'text',
    				'text' => 'หากต้องการสอบถามข้อมูลอีกครั้งท่านสามารถพิมพ์ ?'
				
				];
			}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages,$messages2],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
