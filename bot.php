<?php

$access_token = '7E/Ub3PcomIMFVemjLJKZJqTjiPo0LgEmKL3gybU+2i4JTe/rIDpOM21XcvHVfUCnfWS/nCsoaEdSbVpGL8J2yDmpXMmk4708xxB49wY/h2G6nMEQpPJHuMz5luKXg+g/p1LnRGQFoKX+mimkVLrsgdB04t89/1O/w1cDnyilFU=';

$doc = new DomDocument;
$doc->validateOnParse = true;
$doc->Load('graduate.xml');
$announce = $doc->getElementsByTagName('graduate');

$obj1 = $announce->item(0)->getElementsByTagName('title')->item(0)->nodeValue;
$obj1_1 = $announce->item(0)->getElementsByTagName('pic1')->item(0)->nodeValue;
$obj1_2 = $announce->item(0)->getElementsByTagName('pic2')->item(0)->nodeValue;
$obj2 = $announce->item(1)->getElementsByTagName('title')->item(0)->nodeValue;
$obj2_1 = $announce->item(1)->getElementsByTagName('pic1')->item(0)->nodeValue;
$obj2_2 = $announce->item(1)->getElementsByTagName('pic2')->item(0)->nodeValue;

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
			// Build message to reply back
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
			else if($text == "2")
			{
			$messages = 
				[
				
    				'type' => 'text',
    				'text' => $obj2
				
				];
			$messages2 = 
				[
				
				'type' => 'image',
    				'originalContentUrl' => $obj2_1,
    				'previewImageUrl' => $obj2_2
				
				];
				
			}
			else if($text == "3")
			{
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
